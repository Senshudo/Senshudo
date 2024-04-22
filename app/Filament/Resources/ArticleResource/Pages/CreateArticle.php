<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Review;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->model(Article::class);
    }

    protected function handleRecordCreation(array $data): Model
    {
        if (Arr::get($data, 'type') === 'article') {
            return static::getModel()::create($data);
        }

        $article = static::getModel()::create(
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

        Review::create(
            [
                'article_id' => $article->id,
                ...Arr::only(
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
            ],
        );

        return $article;
    }

    protected function getFormActions(): array
    {
        if (Arr::get($this->data, 'type') === 'article') {
            return [...parent::getFormActions()];
        }

        return [];
    }
}
