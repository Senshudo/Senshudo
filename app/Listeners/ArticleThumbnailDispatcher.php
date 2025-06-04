<?php

namespace App\Listeners;

use App\Jobs\GenerateSocialThumbnail;
use App\Models\Article;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArticleThumbnailDispatcher
{
    public function handle(MediaHasBeenAddedEvent $event): void
    {
        /** @var Media $media */
        $media = $event->media;

        if ($media->collection_name === 'background' && $media->model instanceof Article) {
            GenerateSocialThumbnail::dispatch($media->model);
        }
    }
}
