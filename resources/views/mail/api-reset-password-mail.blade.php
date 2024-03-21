<x-mail::message>
    {{ $user->name }}
    # Votre code de verification
    -Code: {{ $user->apiPasswordResetToken->code }}
    {{ config('app.name') }}
</x-mail::message>
