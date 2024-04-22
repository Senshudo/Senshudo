<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form->statePath('data')
            ->model(Article::class);
    }

    protected function fillForm(): void
    {
        if ($this->getRecord()->review === null) {
            $extraData = ['type' => 'article'];
        } else {
            $extraData = [
                'type' => 'review',
                ...$this->getRecord()->review->toArray(),
            ];
        }

        $this->fillFormWithDataAndCallHooks($this->getRecord(), $extraData);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (Arr::get($data, 'type') === 'article') {
            return $record->update($data);
        }

        $record->update(
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

        $record->review->update(
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

        return $record;
    }

    protected function getFormActions(): array
    {
        if (Arr::get($this->data, 'type') === 'article') {
            return [...parent::getFormActions()];
        }

        return [];
    }
}
