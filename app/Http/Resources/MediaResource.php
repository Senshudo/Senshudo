<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Support\UrlGenerator\UrlGeneratorFactory;

/**
 * @mixin \App\Models\Media
 */
class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->file_name,
            'size' => $this->size,
            'mime_type' => $this->mime_type,
            'collection_name' => $this->collection_name,
            'human_size' => humanFileSize($this->size),
            'url' => $this->getUrl(),
            'conversions' => $this->getConversions(),
            'path' => $this->getPath(),
            'created_at' => $this->created_at,
        ];
    }

    private function getConversions(): Collection
    {


        return $this->getGeneratedConversions()
            ->filter()
            ->map(function (bool $value, string $conversion) {
                return [
                    [
                        'name' => $conversion,
                        'url' => UrlGeneratorFactory::createForMedia($this->getModel(), $conversion)->getUrl(),
                    ],
                ];
            })
            ->flatten(1);
    }
}
