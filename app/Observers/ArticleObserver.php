<?php

namespace App\Observers;

use App\Jobs\GenerateSocialThumbnail;

class ArticleObserver
{
    public function created($article)
    {
        GenerateSocialThumbnail::dispatch($article);
    }
}
