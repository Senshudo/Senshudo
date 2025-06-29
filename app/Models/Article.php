<?php

namespace App\Models;

use App\Actions\AmpContentAction;
use App\Enums\ArticleApprovalStatus;
use App\Enums\ArticleStatus;
use App\Observers\ArticleObserver;
use Database\Factories\ArticleFactory;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
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
use Overtrue\LaravelVersionable\Versionable;
use Overtrue\LaravelVersionable\VersionStrategy;
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
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property array<array-key, mixed>|null $sources
 * @property bool $is_featured
 * @property ArticleStatus $status
 * @property ArticleApprovalStatus|null $approval_status
 * @property \Carbon\CarbonImmutable|null $published_at
 * @property \Carbon\CarbonImmutable|null $scheduled_for
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read string $amp_content
 * @property-read \App\Models\Author $author
 * @property-read Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Event|null $event
 * @property-read \Overtrue\LaravelVersionable\Version|null $firstVersion
 * @property-read bool $is_published
 * @property-read bool $is_scheduled
 * @property-read \Overtrue\LaravelVersionable\Version|null $lastVersion
 * @property-read \Overtrue\LaravelVersionable\Version|null $latestVersion
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Review|null $review
 * @property-read Collection<int, \Overtrue\LaravelVersionable\Version> $versions
 * @property-read int|null $versions_count
 *
 * @method static \Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static Builder<static>|Article newModelQuery()
 * @method static Builder<static>|Article newQuery()
 * @method static Builder<static>|Article query()
 * @method static Builder<static>|Article whereApprovalStatus($value)
 * @method static Builder<static>|Article whereAuthorId($value)
 * @method static Builder<static>|Article whereContent($value)
 * @method static Builder<static>|Article whereCreatedAt($value)
 * @method static Builder<static>|Article whereEventId($value)
 * @method static Builder<static>|Article whereExcerpt($value)
 * @method static Builder<static>|Article whereId($value)
 * @method static Builder<static>|Article whereIsFeatured($value)
 * @method static Builder<static>|Article whereKeywords($value)
 * @method static Builder<static>|Article whereMetaDescription($value)
 * @method static Builder<static>|Article whereMetaKeywords($value)
 * @method static Builder<static>|Article whereMetaTitle($value)
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
    use Versionable;

    protected $versionable = [
        'title',
        'content',
        'keywords',
        'sources',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $versionStrategy = VersionStrategy::SNAPSHOT;

    protected $fillable = [
        'author_id',
        'event_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'keywords',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'sources',
        'is_featured',
        'status',
        'approval_status',
        'published_at',
        'scheduled_for',
    ];

    /** @return array{status: 'App\Enums\ArticleStatus', approval_status: 'App\Enums\ArticleApprovalStatus', sources: 'array', is_featured: 'boolean', published_at: 'datetime', scheduled_for: 'datetime'} */
    protected function casts(): array
    {
        return [
            'status' => ArticleStatus::class,
            'approval_status' => ArticleApprovalStatus::class,
            'sources' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
            'scheduled_for' => 'datetime',
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

    public function authorUser(): User
    {
        return $this->author->user;
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
            get: fn (string $value): string => trim(html_entity_decode($value)).'...',
            set: fn (string $value): string => $value,
        );
    }

    /** @return Attribute<string, string> */
    protected function content(): attribute
    {
        return Attribute::make(
            get: fn (string $value): string => preg_replace('/<p\b[^>]*>\s*&nbsp;\s*<\/p>/i', '', $value),
            set: fn (string $value): string => $value,
        );
    }

    /** @return Attribute<string, never> */
    protected function ampContent(): Attribute
    {
        return Attribute::make(
            get: fn (): string => AmpContentAction::make($this->content),
        );
    }

    /** @return Attribute<string, string> */
    protected function metaTitle(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): string => $value === null || $value === '' || $value === '0' ? trim(html_entity_decode($this->title)) : $value,
            set: fn (string $value): string => trim(html_entity_decode($value)),
        );
    }

    /** @return Attribute<string, string> */
    protected function metaDescription(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): string => $value === null || $value === '' || $value === '0' ? trim(html_entity_decode($this->excerpt)) : $value,
            set: fn (string $value): string => trim(html_entity_decode($value)).'...',
        );
    }

    /** @return Attribute<string, string> */
    protected function metaKeywords(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): string => $value === null || $value === '' || $value === '0' ? trim(html_entity_decode((string) $this->keywords)) : $value,
            set: fn (string $value) => collect(explode(',', $value))
                ->map(fn ($keyword): string => trim(html_entity_decode($keyword)))
                ->filter()
                ->unique()
                ->implode(',')
        );
    }

    /** @return Attribute<bool, never> */
    protected function isScheduled(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->status === ArticleStatus::SCHEDULED,
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
            'keywords' => $this->keywords,
            'created_at' => $this->created_at->timestamp,
            'published_at' => $this->published_at->timestamp,
        ];
    }

    public static function getForm(?self $article = null): array
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
                ->minHeight(500)
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

            TagsInput::make('keywords')
                ->hint('These will be used for the site search.')
                ->nullable()
                ->separator()
                ->columnSpanFull(),

            TextInput::make('meta_title')
                ->hint('This will be used as the title in search engines and social media. (Leave empty to use the article title.)')
                ->nullable()
                ->maxLength(255)
                ->columnSpanFull(),

            TextInput::make('meta_description')
                ->hint('This will be used as the description in search engines and social media. (Leave empty to use the article excerpt.)')
                ->maxLength(150)
                ->nullable()
                ->columnSpanFull(),

            TagsInput::make('meta_keywords')
                ->hint('These will be used for search engines and social media. (Leave empty to use the article keywords.)')
                ->separator()
                ->nullable()
                ->columnSpanFull(),

            Toggle::make('is_featured'),

            Select::make('status')
                ->options(ArticleStatus::toSelectOptions())
                ->default(ArticleStatus::DRAFT->value)
                ->disableOptionWhen(fn (Get $get): bool => ($get('status') === 'scheduled' || $get('status') === 'published') && ! user()->is_super)
                ->hidden(fn (Get $get): bool => $get('status') === ArticleStatus::PUBLISHED)
                ->live()
                ->required(),

            DateTimePicker::make('scheduled_at')
                ->label('Scheduled For')
                ->nullable()
                ->hint('This will be used to schedule the article for publication.'),
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
