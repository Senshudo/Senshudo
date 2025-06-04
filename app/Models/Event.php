<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $hashtag
 * @property string|null $website
 * @property string $description
 * @property string|null $keywords
 * @property string|null $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Article> $articles
 * @property-read int|null $articles_count
 *
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereHashtag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\Illuminate\Support\Facades\Event whereWebsite($value)
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
#[UseFactory(EventFactory::class)]
class Event extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'hashtag',
        'website',
        'description',
        'keywords',
        'start_date',
        'end_date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /** @return HasMany<Article, $this> */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
