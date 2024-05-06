<?php

namespace App\Filament\Resources;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return number_format(Article::query()->when(! auth()->user()->is_super, fn ($query) => $query->where('author_id', auth()->user()->author->id))->count());
    }

    public static function form(Form $form): Form
    {
        if ($form->getRecord() === null) {
            $bladeAction = <<<'BLADE'
                <x-filament::button
                    type="submit"
                    size="sm"
                >
                    Create
                </x-filament::button>
            BLADE;
        } else {
            $bladeAction = <<<'BLADE'
                <x-filament::button
                    type="submit"
                    size="sm"
                >
                    Update
                </x-filament::button>
            BLADE;
        }

        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Article Type')
                    ->options([
                        'article' => 'Article',
                        'review' => 'Review',
                    ])
                    ->required()
                    ->live()
                    ->default($form->getRecord()?->review !== null ? 'review' : 'article')
                    ->disabled($form->getRecord() !== null)
                    ->columnSpanFull(),

                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Article')
                        ->icon('heroicon-o-newspaper')
                        ->schema(Article::getForm()),
                    Forms\Components\Wizard\Step::make('Review')
                        ->icon('heroicon-o-star')
                        ->schema(Review::getForm($form->getRecord())),
                ])
                    ->hidden(fn (Get $get): bool => $get('type') !== 'review')
                    ->columnSpanFull()
                    ->skippable(fn () => $form->getRecord() !== null)
                    ->submitAction(new HtmlString(Blade::render($bladeAction))),

                Forms\Components\Section::make('Article')
                    ->schema(Article::getForm())
                    ->hidden(fn (Get $get): bool => $get('type') !== 'article')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query
                    ->when(! auth()->user()->is_super, fn ($query) => $query->where('author_id', auth()->user()->author->id))
                    ->orderByDesc('id');
            })
            ->defaultPaginationPageOption(25)
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('author.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state): string => match ($state->value) {
                        'draft' => 'gray',
                        'scheduled' => 'warning',
                        'review' => 'info',
                        'published' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ArticleStatus::toSelectOptions()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
