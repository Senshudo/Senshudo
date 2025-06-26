<?php

namespace App\Actions;

class AmpContentAction
{
    public static function make(string $content): string
    {
        $content = preg_replace_callback(
            '/<img([^>]+?)\/?>/i',
            function ($matches): string {
                $imgTag = $matches[1];

                if (in_array(preg_match('/width\s*=\s*["\']?\d+["\']?/i', $imgTag), [0, false], true)) {
                    $imgTag .= ' width="600"';
                }

                if (in_array(preg_match('/height\s*=\s*["\']?\d+["\']?/i', $imgTag), [0, false], true)) {
                    $imgTag .= ' height="400"';
                }

                return sprintf('<amp-img%s layout="responsive"></amp-img>', $imgTag);
            },
            $content
        );

        return preg_replace_callback(
            '/<iframe[^>]+src=["\']https?:\/\/(?:www\.)?youtube\.com\/embed\/([a-zA-Z0-9_-]+)[^"\']*["\'][^>]*><\/iframe>/i',
            function ($matches): string {
                $videoId = $matches[1];

                return sprintf('<amp-youtube data-videoid="%s" layout="responsive" width="480" height="270"></amp-youtube>', $videoId);
            },
            (string) $content
        );
    }
}
