<?php

namespace App\Spatie;

use Illuminate\Support\Facades\URL;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class UrlGenerator extends DefaultUrlGenerator
{
    public function getUrl(): string
    {
        return URL::route(
            'media.show',
            ['media' => $this->media->uuid, 'filename' => $this->media->file_name],
        );
    }
}
