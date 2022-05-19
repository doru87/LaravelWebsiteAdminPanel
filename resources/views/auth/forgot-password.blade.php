<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="files/logo.png" alt="">
            </a>
        </x-slot>

        <div class="card-body">
            <div class="mb-4">
                {{ __('Ti-ai uitat parola? Nici o problema. Doar spuneți-ne adresa dvs. de e-mail și vă vom trimite prin e-mail un link de resetare a parolei care vă va permite să alegeți una nouă.') }}
            </div>

            <div class="card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-3" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-3" :errors="$errors" />

                <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                    <div class="mb-3">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <x-button>
                            {{ __('Link de resetare a parolei de e-mail') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
