<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use App\Observers\ArticleObserver;
use Database\Factories\ArticleFactory;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Validation\Rules\File;
use Laravel\Scout\Searchable;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int $id
 * @property int $author_id
 * @property int|null $event_id
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $content
 * @property string|null $keywords
 * @property array<array-key, mixed>|null $sources
 * @property bool $is_featured
 * @property ArticleStatus $status
 * @property \Carbon\CarbonImmutable|null $published_at
 * @property string|null $scheduled_for
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\Author $author
 * @property-read Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Event|null $event
 * @property-read bool $is_published
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Review|null $review
 *
 * @method static \Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static Builder<static>|Article newModelQuery()
 * @method static Builder<static>|Article newQuery()
 * @method static Builder<static>|Article query()
 * @method static Builder<static>|Article whereAuthorId($value)
 * @method static Builder<static>|Article whereContent($value)
 * @method static Builder<static>|Article whereCreatedAt($value)
 * @method static Builder<static>|Article whereEventId($value)
 * @method static Builder<static>|Article whereExcerpt($value)
 * @method static Builder<static>|Article whereId($value)
 * @method static Builder<static>|Article whereIsFeatured($value)
 * @method static Builder<static>|Article whereKeywords($value)
 * @method static Builder<static>|Article wherePublishedAt($value)
 * @method static Builder<static>|Article whereScheduledFor($value)
 * @method static Builder<static>|Article whereSlug($value)
 * @method static Builder<static>|Article whereSources($value)
 * @method static Builder<static>|Article whereStatus($value)
 * @method static Builder<static>|Article whereTitle($value)
 * @method static Builder<static>|Article whereUpdatedAt($value)
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
#[ObservedBy(ArticleObserver::class)]
#[UseFactory(ArticleFactory::class)]
class Article extends Model implements HasMedia, Sitemapable
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;
    use Searchable;

    protected $fillable = [
        'author_id',
        'event_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'keywords',
        'sources',
        'is_featured',
        'status',
        'published_at',
        'scheduled_for',
    ];

    /** @return array{status: 'App\Enums\ArticleStatus', sources: 'array', is_featured: 'boolean', published_at: 'datetime', scheduled_at: 'datetime'} */
    protected function casts(): array
    {
        return [
            'status' => ArticleStatus::class,
            'sources' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
            'scheduled_at' => 'datetime',
        ];
    }

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
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('background')
            ->useFallbackUrl('https://via.placeholder.com/800x400')
            ->singleFile();

        $this->addMediaCollection('thumbnail')
            ->useFallbackUrl('https://via.placeholder.com/800x400')
            ->singleFile();

        $this->addMediaCollection('socialThumbnail')
            ->singleFile();

        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->format('webp');
    }

    /** @return BelongsToMany<Category, $this> */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /** @return BelongsTo<Author, $this> */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /** @return BelongsTo<\App\Models\Event, $this> */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /** @return BelongsTo<Review, $this> */
    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'id', 'article_id');
    }

    /** @return Attribute<bool, never> */
    protected function isPublished(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->published_at !== null,
        );
    }

    /** @return Attribute<string, string> */
    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value): string => trim(strip_tags(html_entity_decode($value))).'...',
            set: fn (string $value): string => $value,
        );
    }

    protected function content(): attribute
    {
        return Attribute::make(
            get: fn (string $value): string => preg_replace('/<p\b[^>]*>\s*&nbsp;\s*<\/p>/i', '', $value),
            set: fn (string $value): string => $value,
        );
    }

    /**
     * Determine if the model should be searchable.
     */
    public function shouldBeSearchable(): bool
    {
        return $this->is_published;
    }

    /**
     * Modify the query used to retrieve models when making all of the models searchable.
     */
    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with([
            'categories',
            'author',
            'review',
            'media',
        ]);
    }

    /**
     * Modify the collection of models being made searchable.
     */
    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load([
            'categories',
            'author',
            'review',
            'media',
        ]);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => (string) $this->id,
            'author' => $this->author->name,
            'title' => $this->title,
            'content' => strip_tags(html_entity_decode($this->content)),
            'created_at' => $this->created_at->timestamp,
            'published_at' => $this->published_at->timestamp,
        ];
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('title')
                ->required()
                ->minLength(3)
                ->maxLength(255)
                ->columnSpanFull(),

            Select::make('author_id')
                ->default(fn () => user()->author?->id)
                ->disabled(fn (): bool => ! user()->is_super)
                ->relationship('author', 'name')
                ->required(),

            Select::make('event_id')
                ->relationship('event', 'name'),

            SpatieMediaLibraryFileUpload::make('thumbnail')
                ->collection('thumbnail')
                ->hint('Recommended size: 800x400, must be no larger than 2MB')
                ->image()
                ->disk(config('media-library.disk_name'))
                ->rules([
                    File::image()->max('2mb'),
                ])
                ->required()
                ->columnSpanFull(),

            SpatieMediaLibraryFileUpload::make('background')
                ->collection('background')
                ->hint('Recommended size: 1920x1080, must be no larger than 5MB')
                ->image()
                ->disk(config('media-library.disk_name'))
                ->rules([
                    File::image()->max('5mb'),
                ])
                ->required()
                ->columnSpanFull(),

            TinyEditor::make('content')
                ->setConvertUrls(false)
                ->required()
                ->columnSpanFull(),

            TagsInput::make('keywords')
                ->separator()
                ->columnSpanFull(),

            Repeater::make('sources')
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('url')
                        ->required(),
                ])
                ->default([])
                ->columnSpanFull(),

            Toggle::make('is_featured'),

            Select::make('status')
                ->options(ArticleStatus::toSelectOptions())
                ->default(ArticleStatus::DRAFT->value)
                ->disableOptionWhen(fn (string $value): bool => ($value === 'scheduled' || $value === 'published') && ! user()->is_super)
                ->required()
                ->hidden(fn (?Article $record): bool => $record?->status === ArticleStatus::PUBLISHED),
        ];
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('news.show', $this))
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.8);
    }
}
