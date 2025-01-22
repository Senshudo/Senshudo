<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @mixin IdeHelperAuthor
 */
class Author extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'is_active',
        'position',
        'twitter',
    ];

    protected $with = ['user'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName()
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

    public function registerMediaCollections(): void
    {
        $hash = md5(str($this->user->email ?? 'admin@senshudo.tv')->trim()->lower());

        $this->addMediaCollection('avatar')
            ->useFallbackUrl("https://www.gravatar.com/avatar/$hash?s=256&d=mp")
            ->singleFile();
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(fn () => $this->getFirstMediaUrl('avatar'));
    }

    /** @return HasMany<Article, $this> */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
