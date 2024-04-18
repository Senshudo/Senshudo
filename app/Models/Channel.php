<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperChannel
 */
class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'twitch_id',
        'channel_name',
        'is_online',
    ];

    protected $casts = [
        'is_online' => 'boolean',
    ];
}
