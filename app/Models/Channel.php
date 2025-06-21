<?php

namespace App\Models;

use Database\Factories\ChannelFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $twitch_id
 * @property string $channel_name
 * @property bool $is_online
 * @property string|null $online_webhook_id
 * @property string|null $offline_webhook_id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 *
 * @method static \Database\Factories\ChannelFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel whereChannelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel whereIsOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel whereOfflineWebhookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel whereOnlineWebhookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel whereTwitchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Channel whereUpdatedAt($value)
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
#[UseFactory(ChannelFactory::class)]
class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'twitch_id',
        'channel_name',
        'is_online',
        'online_webhook_id',
        'offline_webhook_id',
    ];

    protected $casts = [
        'is_online' => 'boolean',
    ];
}
