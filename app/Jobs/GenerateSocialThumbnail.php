<?php

namespace App\Jobs;

use App\Models\Article;
use Backstage\OgImage\Laravel\Facades\OgImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateSocialThumbnail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Article $article)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ini_set('memory_limit', '-1');

        $imageContents = $this->getBase64String();

        if (in_array($imageContents, [null, '', '0'], true)) {
            $this->fail('No image found for article '.$this->article->id);
        }

        $url = base64_encode(OgImage::createImageFromParams([
            'title' => $this->article->title,
            'score' => $this->article->review?->overall,
            'author' => $this->article->author->name,
            'image' => $imageContents,
        ], 'vendor.open-graph-image.template', true));

        $this->article->addMediaFromBase64('data:image/jpg;base64,'.$url)
            ->usingFileName($this->article->slug.'.jpg')
            ->toMediaCollection('socialThumbnail');
    }

    public function getContent(): ?string
    {
        $path = $this->article->getFirstMedia('background')?->getPathRelativeToRoot();

        if (in_array($path, [null, '', '0'], true)) {
            $this->fail('No background image found for article '.$this->article->id);
        }

        if (! Storage::disk($this->article->getFirstMedia('background')?->disk)->exists($path)) {
            $this->fail('Background image not found for article '.$this->article->id);
        }

        return Storage::disk($this->article->getFirstMedia('background')?->disk)->get($path);
    }

    private function getBase64String(): ?string
    {
        if (is_null($content = $this->getContent())) {
            return null;
        }

        $type = pathinfo(
            (string) $this->article->getFirstMedia('background')?->getPathRelativeToRoot(),
            PATHINFO_EXTENSION
        );

        return 'data:image/'.$type.';base64,'.base64_encode($content);
    }
}
