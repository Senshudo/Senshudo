<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Mansoor\FilamentVersionable\Page\RevisionsAction;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->label('Approve')
                ->color('success')
                ->icon('heroicon-o-check')
                ->hidden(function (): bool {
                    /** @var Article $article */
                    $article = $this->getRecord();

                    return $article->approval_status !== null;
                }),

            Action::make('reject')
                ->label('Reject')
                ->color('danger')
                ->icon('heroicon-o-x-mark')
                ->hidden(function (): bool {
                    /** @var Article $article */
                    $article = $this->getRecord();

                    return $article->approval_status !== null;
                }),

            RevisionsAction::make(),

            DeleteAction::make()
                ->icon('heroicon-o-trash'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var Article $article */
        $article = $this->getRecord();

        if ($article->review === null) {
            $data['type'] = 'article';
        } else {
            $data = [
                ...$data,
                'type' => 'review',
                ...$article->review->toArray(),
            ];
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        /** @var Article $article */
        $article = $record;

        if (Arr::get($data, 'type') === 'article' || $article->review === null) {
            $article->update(Arr::except($data, ['type']));

            return $article;
        }

        $article->update(
            Arr::except(
                $data,
                [
                    'type',
                    'oneliner',
                    'quote',
                    'overall',
                    'graphics',
                    'story',
                    'gameplay',
                ],
            ),
        );

        $article->review->update(
            Arr::only(
                $data,
                [
                    'oneliner',
                    'quote',
                    'overall',
                    'graphics',
                    'story',
                    'gameplay',
                ],
            ),
        );

        return $article;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        if (Arr::get($this->data, 'type') === 'article') {
            return [...parent::getFormActions()];
        }

        return [];
    }
}
