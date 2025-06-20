<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasCreator;
use Eloquent;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

/**
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property array<array-key, mixed> $manipulations
 * @property array<array-key, mixed> $custom_properties
 * @property array<array-key, mixed> $generated_conversions
 * @property array<array-key, mixed> $responsive_images
 * @property int|null $order_column
 * @property int|null $creator_id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read mixed $extension
 * @property-read mixed $human_readable_size
 * @property-read \Illuminate\Database\Eloquent\Model|Eloquent $model
 * @property-read mixed $original_url
 * @property-read mixed $preview_url
 * @property-read mixed $type
 *
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, static> all($columns = ['*'])
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereCollectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereConversionsDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereCustomProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereGeneratedConversions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereManipulations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereResponsiveImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Media whereUuid($value)
 *
 * @mixin \Eloquent
 */
class Media extends BaseMedia
{
    public function getContent(): ?string
    {
        $path = $this->getPathRelativeToRoot();

        if (! Storage::disk($this->disk)->exists($path)) {
            return null;
        }

        return Storage::disk($this->disk)->get($path);
    }

    public function getBase64String(): ?string
    {
        if (is_null($content = $this->getContent())) {
            return null;
        }

        $type = pathinfo(
            $this->getPathRelativeToRoot(),
            PATHINFO_EXTENSION
        );

        return 'data:application/'.$type.';base64,'.base64_encode($content);
    }

    public function getMd5Hash(): ?string
    {
        if (is_null($content = $this->getContent())) {
            return null;
        }

        return md5($content);
    }
}
