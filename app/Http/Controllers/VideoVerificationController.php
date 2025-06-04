<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgeVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class VideoVerificationController extends Controller
{
    public function index(Request $request): Response|RedirectResponse
    {
        if ($request->cookie('ageVerified')) {
            return redirect()->route('video_verification.show', ['video' => $request->query('vid')]);
        }

        return inertia('embed/age-verification', [
            'video' => $request->query('vid'),
        ]);
    }

    public function store(AgeVerificationRequest $request): RedirectResponse
    {
        abort_if(! $request->has('video'), 404, 'No video ID provided');

        return redirect()
            ->route('video_verification.show', ['video' => $request->input('video')])
            ->withCookie(cookie('ageVerified', 'true', 10080));
    }

    public function show(Request $request, string $video): Response
    {
        return inertia('embed/video', [
            'video' => $video,
        ]);
    }
}
