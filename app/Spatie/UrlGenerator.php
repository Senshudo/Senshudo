<?php

namespace App\Spatie;

use Illuminate\Support\Facades\URL;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class UrlGenerator extends DefaultUrlGenerator
{
    public function getUrl(): string
    {
        if ($this->conversion instanceof \Spatie\MediaLibrary\Conversions\Conversion) {
            return URL::route('media.conversion', [
                'media' => $this->media,
                'conversionName' => $this->conversion->getName(),
                'filename' => last(explode('/', $this->getPathRelativeToRoot())),
            ]);
        }

        return URL::route(
            'media.show',
            ['media' => $this->media->uuid, 'filename' => $this->media->file_name],
        );
    }
}
