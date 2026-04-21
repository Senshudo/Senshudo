<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Jobs\GenerateSocialThumbnail;
use App\Models\Article;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

class ArticleThumbnailDispatcher
{
    public function handle(MediaHasBeenAddedEvent $event): void
    {
        $media = $event->media;

        if ($media->collection_name === 'background' && $media->model instanceof Article) {
            dispatch(new GenerateSocialThumbnail($media->model));
        }
    }
}
