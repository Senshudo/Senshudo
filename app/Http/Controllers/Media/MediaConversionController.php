<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Laravel\ImageResponseFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaConversionController extends Controller
{
    public function __invoke(Request $request, Media $media, string $conversionName): Response
    {
        abort_if(! App::isProduction() && ! Storage::disk($media->disk)->exists($media->getPathRelativeToRoot($conversionName)), 404, 'Media not found');

        /** @var InterventionImage $image */
        $image = Image::read(Storage::disk($media->disk)->path($media->getPathRelativeToRoot($conversionName)));

        $mimeType = $image->origin()->mimetype();

        return ImageResponseFactory::make($image, $mimeType);
    }
}
