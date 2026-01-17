<!doctype html>
<html amp lang="en">
<head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
    <title>{{ $article->title }} - Senshudo</title>
    <link rel="canonical" href="{{ config('app.url').route('news.show', $article, false) }}">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
        body {
            background-color:#f3f4f6;
            font-family:Roboto, sans-serif;
        }

        header {
            padding:1rem;
            background-color:#2A303C;
            text-align:center;
        }

        article {
            padding:1rem;
        }

        article p,
        article p span,
        article span {
            color:#000;
        }

        .article-title {
            margin-top:0;
            margin-bottom:0.5rem;
            text-align:center;
        }

        .author { text-align:center; }

        .prose,
        .prose p,
        .prose span,
        .prose p span {
            font-size:1rem;
            line-height:1.75rem;
        }

        .prose p {
            margin-top:1.25em;
            margin-bottom: 1.25em
        }

        .prose picture img {
            margin-top:0;
            margin-bottom:0
        }

        .prose li {
            margin-top:.5em;
            margin-bottom:.5em
        }

        .prose ol li,
        .prose ul li {
           padding-inline-start:.375em
       }

        .prose ul li p {
            margin-top:.75em;
            margin-bottom:.75em
        }

        .prose ul > li > p:first-child,
        .prose ol > li > p:first-child {
            margin-top:1.25em
        }

        .prose ul > li > p:last-child,
        .prose ol > li > p:last-child {
            margin-bottom:1.25em
        }

        .prose ul ul, ul ol, ol ul, ol ol {
            margin-top:.75em;
            margin-bottom:.75em
        }

        .prose dl {
            margin-top:1.25em;
            margin-bottom:1.25em
        }

        .prose dd {
            margin-top:.5em;
            padding-inline-start:1.625em}

        .prose hr+*,
        .prose h2+*,
        .prose h3+*,
        .prose h4+* {
              margin-top:0
          }

        .prose thead th:first-child {
            padding-inline-start:0
        }

        .prose thead th:last-child {
            padding-inline-end:0
        }

        .prose tbody td,
        .prose tfoot td {
            padding-top:.571429em;
            padding-inline-end:.571429em;padding-bottom:.571429em;
            padding-inline-start:.571429em}

        .prose tbody td:first-child,
        .prose tfoot td:first-child {
            padding-inline-start:0
        }

        .prose tbody td:last-child,
        .prose tfoot td:last-child {
            padding-inline-end:0
        }

        .prose figure {
            margin-top:2em;
            margin-bottom:2em
        }

        .prose:first-child {
            margin-top:0
        }

        .prose:last-child {
            margin-bottom:0
        }

        .prose:where([class~=lead]) {
            color:oklch(44.6% .03 256.802);
            margin-top: 1.2em;
            margin-bottom: 1.2em;
            font-size: 1.25em;
            line-height: 1.6
        }

        .prose a {
            color:oklch(21% .034 264.665);
            font-weight: 500;
            text-decoration: underline
        }

        .prose strong {
            color:oklch(21% .034 264.665);
            font-weight: 600
        }

        .prose a strong,
        .prose blockquote strong,
        .prose thead th strong {
            color:inherit
        }

        .prose ol {
            margin-top:1.25em;
            margin-bottom: 1.25em;
            padding-inline-start:1.625em;
            list-style-type: decimal
        }

        .prose ol[type=A] {
            list-style-type:upper-alpha
        }

        .prose ol[type=a] {
            list-style-type:lower-alpha
        }

        .prose ol[type=A s] {
            list-style-type:upper-alpha
        }

        .prose ol[type=a s] {
            list-style-type:lower-alpha
        }

        .prose ol[type=I] {
            list-style-type:upper-roman
        }

        .prose ol[type=i] {
            list-style-type:lower-roman
        }

        .prose ol[type=I s] {
            list-style-type:upper-roman
        }

        .prose ol[type=i s] {
            list-style-type:lower-roman
        }

        .prose ol[type="1"] {
            list-style-type:decimal
        }

        .prose ul {
            margin-top:1.25em;
            margin-bottom: 1.25em;
            padding-inline-start:1.625em;list-style-type: disc
        }

        .prose ol > li::marker {
            color:oklch(55.1% .027 264.364);
            font-weight: 400
        }

        .prose ul > li::marker {
            color:oklch(87.2% .01 258.338)
        }

        .prose dt {
            color:oklch(21% .034 264.665);
            margin-top: 1.25em;
            font-weight: 600
        }

        .prose hr {
            border-color:oklch(92.8% .006 264.531);
            border-top-width: 1px;
            margin-top: 3em;
            margin-bottom: 3em
        }

        .prose blockquote {
            color:oklch(21% .034 264.665);
            border-inline-start-width:.25rem;
            border-inline-start-color:oklch(92.8% .006 264.531);
            quotes: "“""”""‘""’";
            margin-top: 1.6em;
            margin-bottom: 1.6em;
            padding-inline-start:1em;font-style: italic;
            font-weight: 500
        }

        .prose blockquote p:first-of-type:before {
            content:open-quote
        }

        .prose blockquote p:last-of-type:after {
            content:close-quote
        }

        .prose h1 {
            color:oklch(21% .034 264.665);
            margin-top: 0;
            margin-bottom: .888889em;
            font-size: 2.25em;
            font-weight: 800;
            line-height: 1.11111
        }

        .prose h1 strong {
            color:inherit;
            font-weight: 900
        }

        .prose h2 {
            color:oklch(21% .034 264.665);
            margin-top: 2em;
            margin-bottom: 1em;
            font-size: 1.5em;
            font-weight: 700;
            line-height: 1.33333
        }

        .prose h2 strong {
            color:inherit;
            font-weight: 800
        }

        .prose h3 {
            color:oklch(21% .034 264.665);
            margin-top: 1.6em;
            margin-bottom: .6em;
            font-size: 1.25em;
            font-weight: 600;
            line-height: 1.6
        }

        .prose h3 strong {
            color:inherit;
            font-weight: 700
        }

        .prose h4 {
            color:oklch(21% .034 264.665);
            margin-top: 1.5em;
            margin-bottom: .5em;
            font-weight: 600;
            line-height: 1.5
        }

        .prose h4 strong {
            color:inherit;
            font-weight: 700
        }

        .prose img {
            margin-top:2em;
            margin-bottom: 2em
        }

        .prose picture {
            margin-top:2em;
            margin-bottom: 2em;
            display: block
        }

        .prose video {
            margin-top:2em;
            margin-bottom: 2em
        }

        .prose kbd {
            color:oklch(21% .034 264.665);
            padding-top: .1875em;
            padding-inline-end:.375em;padding-bottom: .1875em;
            border-radius: .3125rem;
            padding-inline-start:.375em;font-family: inherit;
            font-size: .875em;
            font-weight: 500
        }

        .prose code {
            color:oklch(21% .034 264.665);
            font-size: .875em;
            font-weight: 600
        }

        .prose code:before,
        .prose code:after {
            content:"`"
        }

        .prose a code,
        .prose h1 code {
            color:inherit
        }

        .prose h2 code {
            color:inherit;
            font-size: .875em
        }

        .prose h3 code {
            color:inherit;
            font-size: .9em
        }

        .prose h4 code,
        .prose blockquote code,
        .prose thead th code {
            color:inherit
        }

        .prose pre {
            color:oklch(92.8% .006 264.531);
            background-color: oklch(27.8% .033 256.848);
            padding-top: .857143em;
            padding-inline-end:1.14286em;padding-bottom: .857143em;
            border-radius: .375rem;
            margin-top: 1.71429em;
            margin-bottom: 1.71429em;
            padding-inline-start:1.14286em;font-size: .875em;
            font-weight: 400;
            line-height: 1.71429;
            overflow-x: auto
        }

        .prose pre code {
            font-weight:inherit;
            color: inherit;
            font-size: inherit;
            font-family: inherit;
            line-height: inherit;
            background-color: #0000;
            border-width: 0;
            border-radius: 0;
            padding: 0
        }

        .prose pre code:before,
        .prose pre code:after {
            content:none
        }

        .prose table {
            table-layout:auto;
            width: 100%;
            margin-top: 2em;
            margin-bottom: 2em;
            font-size: .875em;
            line-height: 1.71429
        }

        .prose thead {
            border-bottom-width:1px;
            border-bottom-color: oklch(87.2% .01 258.338)
        }

        .prose thead th {
            color:oklch(21% .034 264.665);
            vertical-align: bottom;
            padding-inline-end:.571429em;padding-bottom: .571429em;
            padding-inline-start:.571429em;font-weight: 600
        }

        .prose tbody tr {
            border-bottom-width:1px;
            border-bottom-color: oklch(92.8% .006 264.531)
        }

        .prose tbody tr:last-child {
            border-bottom-width:0
        }

        .prose tbody td {
            vertical-align:baseline
        }

        .prose tfoot {
            border-top-width:1px;
            border-top-color: oklch(87.2% .01 258.338)
        }

        .prose tfoot td {
            vertical-align:top
        }

        .prose th,td {
            text-align:start
        }

        .prose figure>* {
            margin-top:0;
            margin-bottom: 0
        }

        .prose figcaption {
            color:oklch(55.1% .027 264.364);
            margin-top: .857143em;
            font-size: .875em;
            line-height: 1.42857
        }

        .sources {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: calc(.25rem * 4);
        }

        .btn {
            cursor: pointer;
            text-align: center;
            font-size: var(--text-sm);
            font-weight: 500;
            border-style: solid;
            padding: calc(.25rem * 2);
            padding-inline: calc(.25rem * 4);
            border-width: 1px;
            border-radius: 0.25rem;
            background-color: #fff;
            color: oklch(21% .034 264.665);
            box-shadow: 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 1px 3px 0 #0000001a, 0 1px 2px -1px #0000001a ;
            border-color: oklch(87.2% .01 258.338);
            text-decoration: none;
        }

        .prose .btn {
            text-decoration: none;
        }

        .prose iframe[allowfullscreen] {
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
        }

        .hexagon {
            clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
            background-color: oklch(58.5% .233 277.117);
            padding: calc(.25rem * 2);
            font-weight: 600;
            color: #fff;
            justify-content: center;
            align-items: center;
            display: flex;
            font-size:3.75rem;
            line-height: 1;
            width: 200px;
            height: 180px;
            margin: 0 auto calc(.25rem * 6) auto;
        }

        .review .breakdown > p:first-child {
            font-style: italic;
            font-weight: 600;
            font-size: 1.25em;
            line-height: 28px;
            text-align: center;
        }

        .score-container {
            margin-bottom: 1rem;
        }

        .score-container > .header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.25rem;
        }

        .score-container > .header > span {
            font-weight: 500;
        }

        .score-container > .bar {
            height: calc(0.25rem * 2.5);
            background-color: oklch(92.8% .006 264.531);
            border-radius: 3.40282e38px;
            width: 100%;
        }

        .score-container > .bar > .progress {
            height: calc(0.25rem * 2.5);
            background-color: oklch(58.5% .233 277.117);
            border-radius: 3.4px;
        }
    </style>
    <script type="application/ld+json">
        @json([
            '@context' => 'http://schema.org',
            '@type' => 'Article',
            'mainEntityOfPage' => config('app.url').route('news.show', $article, false),
            'headline' => html_entity_decode($article->title),
            'datePublished' => $article->published_at->toIso8601String(),
            'dateModified' => $article->updated_at->toIso8601String(),
            'description' => $article->excerpt,
            'author' => [
                '@type' => 'Person',
                'name' => $article->author->name,
                'url' => config('app.url').route('author', $article->author, false),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Senshudo',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => config('app.url').'/images/logo-black.svg',
                    'width' => 705,
                    'height' => 237,
                ],
            ],
            'image' => [
                '@type' => 'ImageObject',
                'url' => str_replace(config('app.amp_url'), config('app.url'), $article->getFirstMediaUrl('background')),
                'height' => 630,
                'width' => 1200,
                'alt' => html_entity_decode($article->title),
            ],
        ])
    </script>
</head>
<body>
    <header>
        <amp-img src="{{ asset('images/logo-white.svg') }}" height="40" width="117" alt="Senshudo"></amp-img>
    </header>
    <amp-img src="{{ str_replace(config('app.amp_url'), config('app.url'), $article->getFirstMediaUrl('background')) }}" layout="responsive" width="390" height="200" alt="{{ $article->title }}"></amp-img>
    <article class="prose">
        <h1 class="article-title">{{ $article->title }}</h1>
        <p class="author">By <strong>{{ $article->author->name }}</strong></p>
        {!! $article->amp_content !!}

        @if(count($article->sources ?? []) > 0)
            <hr />
            <h2>Sources</h2>
            <div class="sources">
                @foreach($article->sources as $source)
                    <a href="{{ $source['url'] }}" target="_blank" rel="noopener noreferrer" class="btn">{{ $source['name'] }}</a>
                @endforeach
            </div>
        @endif

        @if($article->review)
            <hr />
            <div class="review">
                <div class="hexagon">{{ $article->review->overall }}</div>
                <div class="breakdown">
                    <p>{{ $article->review->oneliner }}</p>
                    <div class="prose">
                        {!! $article->review->quote !!}
                    </div>
                    <div class="score-container">
                        <div class="header">
                            <span>Story</span>
                            <span>{{ ((100 * $article->review->story) / 10) }}%</span>
                        </div>
                        <div class="bar">
                            <div class="progress" style="width: {{ ((100 * $article->review->story) / 10) }}%;"></div>
                        </div>
                    </div>
                    <div class="score-container">
                        <div class="header">
                            <span>Gameplay</span>
                            <span>{{ ((100 * $article->review->gameplay) / 10) }}%</span>
                        </div>
                        <div class="bar">
                            <div class="progress" style="width: {{ ((100 * $article->review->gameplay) / 10) }}%;"></div>
                        </div>
                    </div>
                    <div class="score-container">
                        <div class="header">
                            <span>Graphics</span>
                            <span>{{ ((100 * $article->review->graphics) / 10) }}%</span>
                        </div>
                        <div class="bar">
                            <div class="progress" style="width: {{ ((100 * $article->review->graphics) / 10) }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </article>
</body>
</html>
