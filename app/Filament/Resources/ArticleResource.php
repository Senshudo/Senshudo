<?php

namespace App\Filament\Resources;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource\Pages\CreateArticle;
use App\Filament\Resources\ArticleResource\Pages\EditArticle;
use App\Filament\Resources\ArticleResource\Pages\ListArticles;
use App\Models\Article;
use App\Models\Review;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
                        ->schema(Article::getForm($article)),
                    Step::make('Review')
                        ->icon('heroicon-o-star')
                        ->schema(Review::getForm($article?->review)),
                ])
                    ->hidden(fn (Get $get): bool => $get('type') !== 'review')
                    ->columnSpanFull()
                    ->skippable(fn (): bool => $article !== null)
                    ->submitAction(new HtmlString(Blade::render($bladeAction))),

                Section::make('Article')
                    ->schema(Article::getForm($article))
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
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (ArticleStatus $state): string => match ($state->value) {
                        'draft' => 'gray',
                        'scheduled' => 'warning',
                        'review' => 'info',
                        'published' => 'success',
                    }),

                IconColumn::make('is_featured')
                    ->boolean(),

                IconColumn::make('is_scheduled')
                    ->label('Scheduled')
                    ->tooltip(function (Model $model): string {
                        /** @var Article $article */
                        $article = $model;

                        return $article->status === ArticleStatus::SCHEDULED
                            ? ($article->scheduled_for > now() ? 'Scheduled for '.$article->scheduled_for->format('d/m/Y H:i') : 'Published at '.$article->scheduled_for->format('d/m/Y H:i'))
                            : 'Not scheduled';
                    })
                    ->boolean()
                    ->sortable(),

                TextColumn::make('author.name')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('title')
                    ->grow(false)
                    ->searchable(),

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

                SelectFilter::make('author_id')
                    ->relationship('author', 'name')
                    ->label('Author')
                    ->hidden(fn (): bool => ! user()->is_super),

                Filter::make('published_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query
                        ->when(
                            $data['from'],
                            fn (Builder $query, string $date): Builder => $query->whereDate('published_at', '>=', $date),
                        )
                        ->when(
                            $data['until'],
                            fn (Builder $query, string $date): Builder => $query->whereDate('published_at', '<=', $date),
                        )),
            ])
            ->actions([
                EditAction::make()
                    ->hidden(),
            ])
            ->bulkActions([
                BulkAction::make('approve')
                    ->label('Mark as approved')
                    ->requiresConfirmation()
                    ->color('success')
                    ->hidden(fn () => ! user()->is_super)
                    ->action(function (Collection $records): void {
                       $records = $records
                           ->filter(function (Model $record): bool {)
                               /** @var Article $article */
                               $article = $record;

                               return $article->status === ArticleStatus::REVIEW;
                           })
                           ->groupBy(function (Model $record): string {
                               /** @var Article $article */
                               $article = $record;

                               return $article->scheduled_for ? 'scheduled' : 'publish';
                           });


                    })
                    ->deselectRecordsAfterCompletion(),
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
