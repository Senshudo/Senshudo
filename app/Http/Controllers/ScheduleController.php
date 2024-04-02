<?php

namespace App\Http\Controllers;

use Inertia\Response;

class ScheduleController extends Controller
{
    public function __invoke(): Response
    {
        return inertia('schedule');
    }
}
