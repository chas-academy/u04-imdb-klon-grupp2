<x-layout class="flex max-w-xl flex-col gap-12 pt-4 md:pt-20">
    <div class="flex flex-col items-center text-xl font-bold text-slate-50">
        <x-lucide-circle-user-round class="size-12 text-indigo-400" />
        <span>Fill out the form to create your</span>
        <div class="flex items-center gap-1">
            <img src="{{ asset('images/logo.svg') }}" alt="Popco logo" />
            <span>account</span>
        </div>
    </div>

    <form class="flex flex-col gap-8">
        <div class="flex flex-col gap-4">
            <x-input.text
                name="username"
                label="Username"
                placeholder="Enter your username"
            />
            <x-input.text
                name="email"
                label="Email"
                placeholder="Enter your email"
            />
            <x-input.password
                name="password"
                label="Password"
                placeholder="Enter your password"
            />
            <x-input.password
                name="confirm-password"
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
        <a href="{{ url('/log-in') }}" class="flex items-center gap-1">
            <span class="text-indigo-300">Log in</span>
            <x-lucide-move-right class="size-6 text-indigo-200" />
        </a>
    </div>
</x-layout>
