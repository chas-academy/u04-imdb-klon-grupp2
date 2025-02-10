<x-layout class="flex max-w-xl flex-col gap-12 pt-4 md:pt-20">
    <div class="flex flex-col items-center text-xl font-bold text-slate-50">
        <x-lucide-circle-user-round class="size-12 text-indigo-400" />
        <span>Fill out the form to create your</span>
        <div class="flex items-center gap-1">
            <img src="{{ asset('images/logo.svg') }}" alt="Popco logo" />
            <span>account</span>
        </div>
    </div>

    <form
        method="post"
        action="{{ route('sign-up') }}"
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
            <x-input.text
                name="email"
                :value="old('email')"
                autocomplete="email"
                required
                :error="$errors->first('email')"
                label="Email"
                placeholder="Enter your email"
            />
            <x-input.password
                name="password"
                autocomplete="new-password"
                required
                :error="$errors->first('password')"
                label="Password"
                placeholder="Enter your password"
            />
            <x-input.password
                name="password_confirmation"
                autocomplete="new-password"
                required
                :error="$errors->first('password_confirmation')"
                label="Confirm your pasword"
                placeholder="Enter your password again"
            />
        </div>
        <x-button>Sign up</x-button>
    </form>

    <div class="flex items-center gap-2">
        <div class="h-px flex-1 bg-slate-700"></div>
        <span class="text-xs font-bold text-slate-50">or</span>
        <div class="h-px flex-1 bg-slate-700"></div>
    </div>

    <div class="flex flex-col items-center font-bold">
        <span>Already have an account?</span>
        <a
            href="{{ route('log-in') }}"
            class="flex items-center gap-1 text-indigo-300 transition hover:text-indigo-400"
        >
            Log in
        </a>
    </div>
</x-layout>
