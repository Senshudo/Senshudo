<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Review */
class ReviewResource extends JsonResource
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
            'article' => ArticleResource::make($this->whenLoaded('article')),
            'oneliner' => $this->oneliner,
            'quote' => $this->quote,
            'overall' => $this->overall,
            'graphics' => $this->graphics,
            'gameplay' => $this->gameplay,
            'story' => $this->story,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
