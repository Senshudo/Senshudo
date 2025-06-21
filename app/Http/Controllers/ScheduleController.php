<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use Inertia\Response;

class ScheduleController extends Controller
{
    public function __invoke(): Response
    {
        $liveStream = Channel::query()->where('is_online', true)->inRandomOrder()->first();

        return inertia('schedule', ['liveStream' => $liveStream ? ChannelResource::make($liveStream) : null]);
    }
}
