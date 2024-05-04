<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use App\Observers\ArticleObserver;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
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
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @mixin IdeHelperArticle
 */
#[ObservedBy(ArticleObserver::class)]
class Article extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia, Searchable;

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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'id', 'article_id');
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null;
    }

    /**
     * Determine if the model should be searchable.
     */
    public function shouldBeSearchable(): bool
    {
        return $this->isPublished();
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
                ->default(fn () => auth()->user()->author?->id)
                ->disabled(fn () => ! auth()->user()->is_super)
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
                ->disableOptionWhen(fn (string $value): bool => ($value === 'scheduled' || $value === 'published') && ! auth()->user()->is_super)
                ->required()
                ->hidden(fn (?Model $record) => $record?->status === ArticleStatus::PUBLISHED),
        ];
    }
}
