<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'author' => AuthorResource::make($this->whenLoaded('author')),
            'event' => EventResource::make($this->whenLoaded('event')),
            'review' => ReviewResource::make($this->whenLoaded('review')),
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'keywords' => $this->keywords,
            'sources' => $this->sources,
            'is_featured' => $this->is_featured,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
