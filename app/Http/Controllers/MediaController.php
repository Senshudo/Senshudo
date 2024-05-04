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
        if (! App::isProduction() && ! Storage::disk('media')->exists($media->getPathRelativeToRoot())) {
            return response()->noContent();
        }

        return $media->toInlineResponse($request);
    }
}
