<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function __invoke(Request $request, Media $media)
    {
        abort_if(! App::isProduction() && ! Storage::disk($media->disk)->exists($media->getPathRelativeToRoot()), 404, 'Media not found');

        return $media->toInlineResponse($request);
    }
}
