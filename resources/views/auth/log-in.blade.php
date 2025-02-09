<x-layout class="flex max-w-xl flex-col gap-12 pt-4 md:pt-20">
    <div class="flex flex-col items-center text-xl font-bold text-slate-50">
        <x-lucide-circle-user-round class="size-12 text-indigo-400" />
        <span>Please log into your</span>
        <div class="flex items-center gap-1">
            <img src="{{ asset('images/logo.svg') }}" alt="Popco logo" />
            <span>account</span>
        </div>
    </div>

    <form
        method="post"
        action="{{ route('log-in') }}"
        class="flex flex-col gap-8"
    >
        @csrf

        <div class="flex flex-col gap-4">
            <x-input.text
                name="username"
                :value="old('username')"
                autofocus
                autocomplete="username"
                required
                :error="$errors->first('username')"
                label="Username"
                placeholder="Enter your username"
            />
            <x-input.password
                name="password"
                required
                :error="$errors->first('password')"
                label="Password"
                placeholder="Enter your password"
            />

            @if (! $errors->isEmpty())
                <x-input.error message="{{ $errors->first('credentials') }}" />
            @endif
        </div>

        <x-button>Log in</x-button>
    </form>
    <div class="flex items-center gap-2">
        <div class="h-px flex-1 bg-slate-700"></div>
        <span class="text-xs font-bold text-slate-50">or</span>
        <div class="h-px flex-1 bg-slate-700"></div>
    </div>

    <div class="flex flex-col items-center font-bold">
        <span>Don't have an account yet?</span>
        <a href="{{ route('sign-up') }}" class="flex items-center gap-1">
            <span class="text-indigo-300">Sign up</span>
            <x-lucide-move-right class="size-6 text-indigo-200" />
        </a>
    </div>
</x-layout>
