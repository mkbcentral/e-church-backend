<x-mail::message>
    {{ $apiPasswordResetToken->user->name }}
    # Votre code de verification
    -Code: {{ $apiPasswordResetToken->code }}
    {{ config('app.name') }}
</x-mail::message>
