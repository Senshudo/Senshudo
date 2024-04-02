<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'hashtag' => $this->hashtag,
            'website' => $this->website,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'articles' => ArticleResource::collection($this->whenLoaded('articles')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
