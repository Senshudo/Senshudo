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
            background-color:#f3f4f6;
            font-family:Roboto, sans-serif !important;
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
            color:#000 !important;
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
            font-size:1rem !important;
            line-height:1.75rem !important;
        }

        .prose p {
            margin-top:1.25em!important;
            margin-bottom: 1.25em!important
        }

        .prose picture img {
            margin-top:0!important;
            margin-bottom:0!important
        }

        .prose li {
            margin-top:.5em!important;
            margin-bottom:.5em!important
        }

        .prose ol li,
        .prose ul li {
           padding-inline-start:.375em!important
       }

        .prose ul li p {
            margin-top:.75em!important;
            margin-bottom:.75em!important
        }

        .prose ul > li > p:first-child,
        .prose ol > li > p:first-child {
            margin-top:1.25em!important
        }

        .prose ul > li > p:last-child,
        .prose ol > li > p:last-child {
            margin-bottom:1.25em!important
        }

        .prose ul ul, ul ol, ol ul, ol ol {
            margin-top:.75em!important;
            margin-bottom:.75em!important
        }

        .prose dl {
            margin-top:1.25em!important;
            margin-bottom:1.25em!important
        }

        .prose dd {
            margin-top:.5em!important;
            padding-inline-start:1.625em!important}

        .prose hr+*,
        .prose h2+*,
        .prose h3+*,
        .prose h4+* {
              margin-top:0!important
          }

        .prose thead th:first-child {
            padding-inline-start:0!important
        }

        .prose thead th:last-child {
            padding-inline-end:0!important
        }

        .prose tbody td,
        .prose tfoot td {
            padding-top:.571429em!important;
            padding-inline-end:.571429em!important;padding-bottom:.571429em!important;
            padding-inline-start:.571429em!important}

        .prose tbody td:first-child,
        .prose tfoot td:first-child {
            padding-inline-start:0!important
        }

        .prose tbody td:last-child,
        .prose tfoot td:last-child {
            padding-inline-end:0!important
        }

        .prose figure {
            margin-top:2em!important;
            margin-bottom:2em!important
        }

        .prose:first-child {
            margin-top:0!important
        }

        .prose:last-child {
            margin-bottom:0!important
        }

        .prose:where([class~=lead]) {
            color:oklch(44.6% .03 256.802)!important;
            margin-top: 1.2em!important;
            margin-bottom: 1.2em!important;
            font-size: 1.25em!important;
            line-height: 1.6!important
        }

        .prose a {
            color:oklch(21% .034 264.665)!important;
            font-weight: 500!important;
            text-decoration: underline!important
        }

        .prose strong {
            color:oklch(21% .034 264.665)!important;
            font-weight: 600!important
        }

        .prose a strong,
        .prose blockquote strong,
        .prose thead th strong {
            color:inherit!important
        }

        .prose ol {
            margin-top:1.25em!important;
            margin-bottom: 1.25em!important;
            padding-inline-start:1.625em!important;
            list-style-type: decimal!important
        }

        .prose ol[type=A] {
            list-style-type:upper-alpha!important
        }

        .prose ol[type=a] {
            list-style-type:lower-alpha!important
        }

        .prose ol[type=A s] {
            list-style-type:upper-alpha!important
        }

        .prose ol[type=a s] {
            list-style-type:lower-alpha!important
        }

        .prose ol[type=I] {
            list-style-type:upper-roman!important
        }

        .prose ol[type=i] {
            list-style-type:lower-roman!important
        }

        .prose ol[type=I s] {
            list-style-type:upper-roman!important
        }

        .prose ol[type=i s] {
            list-style-type:lower-roman!important
        }

        .prose ol[type="1"] {
            list-style-type:decimal!important
        }

        .prose ul {
            margin-top:1.25em!important;
            margin-bottom: 1.25em!important;
            padding-inline-start:1.625em!important;list-style-type: disc!important
        }

        .prose ol > li::marker {
            color:oklch(55.1% .027 264.364)!important;
            font-weight: 400!important
        }

        .prose ul > li::marker {
            color:oklch(87.2% .01 258.338)!important
        }

        .prose dt) {
            color:oklch(21% .034 264.665)!important;
            margin-top: 1.25em!important;
            font-weight: 600!important
        }

        .prose hr {
            border-color:oklch(92.8% .006 264.531)!important;
            border-top-width: 1px!important;
            margin-top: 3em!important;
            margin-bottom: 3em!important
        }

        .prose blockquote {
            color:oklch(21% .034 264.665)!important;
            border-inline-start-width:.25rem!important;
            border-inline-start-color:oklch(92.8% .006 264.531)!important;
            quotes: "“""”""‘""’"!important;
            margin-top: 1.6em!important;
            margin-bottom: 1.6em!important;
            padding-inline-start:1em!important;font-style: italic!important;
            font-weight: 500!important
        }

        .prose blockquote p:first-of-type:before {
            content:open-quote!important
        }

        .prose blockquote p:last-of-type:after {
            content:close-quote!important
        }

        .prose h1 {
            color:oklch(21% .034 264.665)!important;
            margin-top: 0!important;
            margin-bottom: .888889em!important;
            font-size: 2.25em!important;
            font-weight: 800!important;
            line-height: 1.11111!important
        }

        .prose h1 strong {
            color:inherit!important;
            font-weight: 900!important
        }

        .prose h2 {
            color:oklch(21% .034 264.665)!important;
            margin-top: 2em!important;
            margin-bottom: 1em!important;
            font-size: 1.5em!important;
            font-weight: 700!important;
            line-height: 1.33333!important
        }

        .prose h2 strong {
            color:inherit!important;
            font-weight: 800!important
        }

        .prose h3 {
            color:oklch(21% .034 264.665)!important;
            margin-top: 1.6em!important;
            margin-bottom: .6em!important;
            font-size: 1.25em!important;
            font-weight: 600!important;
            line-height: 1.6!important
        }

        .prose h3 strong {
            color:inherit!important;
            font-weight: 700!important
        }

        .prose h4 {
            color:oklch(21% .034 264.665)!important;
            margin-top: 1.5em!important;
            margin-bottom: .5em!important;
            font-weight: 600!important;
            line-height: 1.5!important
        }

        .prose h4 strong {
            color:inherit!important;
            font-weight: 700!important
        }

        .prose img {
            margin-top:2em!important;
            margin-bottom: 2em!important
        }

        .prose picture {
            margin-top:2em!important;
            margin-bottom: 2em!important;
            display: block!important
        }

        .prose video {
            margin-top:2em!important;
            margin-bottom: 2em!important
        }

        .prose kbd {
            color:oklch(21% .034 264.665)!important;
            padding-top: .1875em!important;
            padding-inline-end:.375em!important;padding-bottom: .1875em!important;
            border-radius: .3125rem!important;
            padding-inline-start:.375em!important;font-family: inherit!important;
            font-size: .875em!important;
            font-weight: 500!important
        }

        .prose code {
            color:oklch(21% .034 264.665)!important;
            font-size: .875em!important;
            font-weight: 600!important
        }

        .prose code:before,
        .prose code:after {
            content:"`"!important
        }

        .prose a code,
        .prose h1 code {
            color:inherit!important
        }

        .prose h2 code {
            color:inherit!important;
            font-size: .875em!important
        }

        .prose h3 code {
            color:inherit!important;
            font-size: .9em!important
        }

        .prose h4 code,
        .prose blockquote code,
        .prose thead th code {
            color:inherit!important
        }

        .prose pre {
            color:oklch(92.8% .006 264.531)!important;
            background-color: oklch(27.8% .033 256.848)!important;
            padding-top: .857143em!important;
            padding-inline-end:1.14286em!important;padding-bottom: .857143em!important;
            border-radius: .375rem!important;
            margin-top: 1.71429em!important;
            margin-bottom: 1.71429em!important;
            padding-inline-start:1.14286em!important;font-size: .875em!important;
            font-weight: 400!important;
            line-height: 1.71429!important;
            overflow-x: auto!important
        }

        .prose pre code {
            font-weight:inherit!important;
            color: inherit!important;
            font-size: inherit!important;
            font-family: inherit!important;
            line-height: inherit!important;
            background-color: #0000!important;
            border-width: 0!important;
            border-radius: 0!important;
            padding: 0!important
        }

        .prose pre code:before,
        .prose pre code:after {
            content:none!important
        }

        .prose table {
            table-layout:auto!important;
            width: 100%!important;
            margin-top: 2em!important;
            margin-bottom: 2em!important;
            font-size: .875em!important;
            line-height: 1.71429!important
        }

        .prose thead {
            border-bottom-width:1px!important;
            border-bottom-color: oklch(87.2% .01 258.338)!important
        }

        .prose thead th {
            color:oklch(21% .034 264.665)!important;
            vertical-align: bottom!important;
            padding-inline-end:.571429em!important;padding-bottom: .571429em!important;
            padding-inline-start:.571429em!important;font-weight: 600!important
        }

        .prose tbody tr {
            border-bottom-width:1px!important;
            border-bottom-color: oklch(92.8% .006 264.531)!important
        }

        .prose tbody tr: last-child):not([class~=not-prose],[class~=not-prose] *)) {
            border-bottom-width:0!important
        }

        .prose tbody td {
            vertical-align:baseline!important
        }

        .prose tfoot {
            border-top-width:1px!important;
            border-top-color: oklch(87.2% .01 258.338)!important
        }

        .prose tfoot td {
            vertical-align:top!important
        }

        .prose th,td {
            text-align:start!important
        }

        .prose figure>* {
            margin-top:0!important;
            margin-bottom: 0!important
        }

        .prose figcaption {
            color:oklch(55.1% .027 264.364)!important;
            margin-top: .857143em!important;
            font-size: .875em!important;
            line-height: 1.42857!important
        }

        .sources {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: wrap !important;
            gap: calc(.25rem * 4) !important;
        }

        .btn {
            cursor: pointer !important;
            text-align: center !important;
            font-size: var(--text-sm) !important;
            font-weight: 500 !important;
            border-style: solid !important;
            padding: calc(.25rem * 2) !important;
            padding-inline: calc(.25rem * 4) !important;
            border-width: 1px !important;
            border-radius: 0.25rem !important;
            background-color: #fff !important;
            color: oklch(21% .034 264.665) !important;
            box-shadow: 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 1px 3px 0 #0000001a, 0 1px 2px -1px #0000001a  !important;
            border-color: oklch(87.2% .01 258.338) !important;
            text-decoration: none !important;
        }

        .prose .btn {
            text-decoration: none !important;
        }

        .prose iframe[allowfullscreen] {
            width: 100% !important;
            height: auto !important;
            aspect-ratio: 16/9 !important;
        }

        .hexagon {
            clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
            background-color: oklch(58.5% .233 277.117) !important;
            padding: calc(.25rem * 2) !important;
            font-weight: 600 !important;
            color: #fff !important;
            justify-content: center !important;
            align-items: center !important;
            display: flex !important;
            font-size:3.75rem;
            line-height: 1!important;
            width: 200px !important;
            height: 180px !important;
            margin: 0 auto calc(.25rem * 6) auto !important;
        }

        .review .breakdown > p:first-child {
            font-style: italic !important;
            font-weight: 600 !important;
            font-size: 1.25em !important;
            line-height: 28px !important;
            text-align: center !important;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('images/logo-white.svg') }}" height="40" width="117" loading="lazy" decoding="async" alt="Senshudo" />
    </header>
    <amp-img src="{{ str_replace(config('app.amp_url'), config('app.url'), $article->getFirstMediaUrl('background')) }}" layout="responsive" width="390" height="200" alt="{{ $article->title }}"></amp-img>
    <article class="prose">
        <h1 class="article-title">{{ $article->title }}</h1>
        <p class="author">By <strong>{{ $article->author->name }}</strong></p>
        {!! $article->content !!}

        @if(count($article->sources) > 0)
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
                    <div></div>
                </div>
            </div>
        @endif
    </article>
</body>
</html>
