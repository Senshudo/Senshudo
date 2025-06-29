<x-mail::message>
    # Article Rejected

    Hi {{ $user->name }},

    <strong>{{ $article->title }}</strong> has been rejected, please communicate via Discord regarding this rejection.

    <x-mail::button :url="$url">
        View Article
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
