<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow">
        <style>
        @font-face {
            font-family: ui-sans-serif;
            font-weight: 100;
            src: url("https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-ultralight-webfont.woff");
        }
        @font-face {
            font-family: ui-sans-serif;
            font-weight: 200;
            src: url("https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-thin-webfont.woff");
        }
        @font-face {
            font-family: ui-sans-serif;
            font-weight: 400;
            src: url("https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-regular-webfont.woff");
        }
        @font-face {
            font-family: ui-sans-serif;
            font-weight: 500;
            src: url("https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-medium-webfont.woff");
        }
        @font-face {
            font-family: ui-sans-serif;
            font-weight: 600;
            src: url("https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-semibold-webfont.woff");
        }
        @font-face {
            font-family: ui-sans-serif;
            font-weight: 700;
            src: url("https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-bold-webfont.woff");
        }

        .hexagon {
            clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
        }
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="m-0 p-0">
        <div
            class="relative isolate h-[630px] w-[1200px] overflow-hidden bg-cover bg-center"
            style="
                background-image: url('{{ $image }}');
            "
        >
            <div class="relative flex h-full w-full bg-gradient-to-t from-[#2A303C]/90 p-4">
                @if (isset($score))
                    <div class="hexagon flex items-center justify-center bg-indigo-500 p-2 font-semibold text-white absolute bottom-10 left-10 h-[80px] w-[100px]">
                        <div class="text-4xl">{{ $score }}</div>
                    </div>
                @endif

                <div class="absolute bottom-10 {{ isset($score) ? 'left-[180px]' : 'left-10' }} max-w-full">
                    <h1 class="truncate text-5xl font-semibold text-white">
                        {{ $title }}
                    </h1>
                    <p class="text-xl text-gray-100">{{ $author }}</p>
                </div>
            </div>
        </div>
    </body>
</html>
