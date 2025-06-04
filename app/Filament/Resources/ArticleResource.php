<?php

namespace App\Filament\Resources;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource\Pages\CreateArticle;
use App\Filament\Resources\ArticleResource\Pages\EditArticle;
use App\Filament\Resources\ArticleResource\Pages\ListArticles;
use App\Models\Article;
use App\Models\Review;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
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
        return number_format(Article::query()->when(! user()->is_super, fn ($query) => $query->where('author_id', user()->author->id))->count());
    }

    public static function form(Form $form): Form
    {
        /** @var ?Article $article */
        $article = $form->getRecord();

        if ($article === null) {
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
                Select::make('type')
                    ->label('Article Type')
                    ->options([
                        'article' => 'Article',
                        'review' => 'Review',
                    ])
                    ->required()
                    ->live()
                    ->default($article?->review !== null ? 'review' : 'article')
                    ->disabled($article !== null)
                    ->columnSpanFull(),

                Wizard::make([
                    Step::make('Article')
                        ->icon('heroicon-o-newspaper')
                        ->schema(Article::getForm()),
                    Step::make('Review')
                        ->icon('heroicon-o-star')
                        ->schema(Review::getForm($article?->review)),
                ])
                    ->hidden(fn (Get $get): bool => $get('type') !== 'review')
                    ->columnSpanFull()
                    ->skippable(fn (): bool => $article !== null)
                    ->submitAction(new HtmlString(Blade::render($bladeAction))),

                Section::make('Article')
                    ->schema(Article::getForm())
                    ->hidden(fn (Get $get): bool => $get('type') !== 'article')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query): void {
                $query
                    ->unless(user()->is_super, fn ($query) => $query->where('author_id', user()->author->id))
                    ->orderByDesc('id');
            })
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                IconColumn::make('is_featured')
                    ->boolean(),
                TextColumn::make('author.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (ArticleStatus $state): string => match ($state->value) {
                        'draft' => 'gray',
                        'scheduled' => 'warning',
                        'review' => 'info',
                        'published' => 'success',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ArticleStatus::toSelectOptions()),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }
}
