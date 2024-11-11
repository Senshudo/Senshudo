<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <head>
        <link rel="preconnect" href="//embed.twitch.tv" />
        <link rel="preconnect" href="//platform.twitter.com" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        @vite('resources/js/app.mjs')
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
