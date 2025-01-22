<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Channel */
class ChannelResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'twitch_id' => $this->twitch_id,
            'channel_name' => $this->channel_name,
            'is_online' => $this->is_online,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
