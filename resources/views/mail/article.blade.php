<x-mail::message>
# Article Ready For Review

Hi {{ $user->name }},

<strong>{{ $article->author->name }}</strong> has just submitted {{ $article->title }} for review.

<x-mail::button :url="$url">
    View Article
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
