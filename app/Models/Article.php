<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'author_id',
        'event_id',
        'review_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'keywords',
        'sources',
        'is_featured',
        'published_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sources' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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
        return $this->belongsTo(Review::class);
    }
}
