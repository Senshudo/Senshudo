<!doctype html>
<html amp lang="en">
<head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <title>{{ $article->title }} - Senshudo</title>
    <link rel="canonical" href="{{ config('app.url').route('news.show', $article, false) }}">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        body {
            background-color: #f3f4f6;
            font-family: Roboto, sans-serif !important;
        }

        header {
            padding: 1rem;
            background-color: #2A303C;
            text-align: center;
        }

        article {
            padding: 1rem;
            font-size: 1rem;
            line-height: 1.75rem;
        }

        article p,
        article p span,
        article span {
            color: #000 !important;
        }

        .article-title {
            margin-top: 0;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .author { text-align: center; }
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('images/logo-white.svg') }}" height="40" width="117" loading="lazy" decoding="async" alt="Senshudo" />
    </header>
    <amp-img src="{{ str_replace(config('app.amp_url'), config('app.url'), $article->getFirstMediaUrl('background')) }}" layout="responsive" width="390" height="200" alt="{{ $article->title }}"></amp-img>
    <article>
        <h1 class="article-title">{{ $article->title }}</h1>
        <p class="author">By <strong>{{ $article->author->name }}</strong></p>
        {!! $article->content !!}

        @if(count($article->sources) > 0)
        <h2>Sources</h2>
        @endif
    </article>
</body>
</html>
