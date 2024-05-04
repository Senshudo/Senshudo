<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource;
use App\Models\Review;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        if (($data['status'] === ArticleStatus::PUBLISHED->value || $data['status'] === ArticleStatus::SCHEDULED->value) && auth()->user()->is_super === false) {
            $data['status'] = ArticleStatus::REVIEW->value;
        }

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
