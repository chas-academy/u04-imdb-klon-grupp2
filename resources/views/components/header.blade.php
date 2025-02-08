<header
    class="fixed z-50 flex h-16 w-full max-w-5xl items-center justify-between bg-slate-800/90 px-6 backdrop-blur-sm sm:h-20"
>
    <a href="/">
        <img src="{{ asset('images/logo.svg') }}" alt="Popco logo" />
    </a>

    <nav class="flex items-center gap-4">
        <x-button variant="icon" srLabel="Open search" class="sm:hidden">
            <x-lucide-search class="size-6 text-slate-50" />
        </x-button>
        <x-search placeholder="Search..." class="hidden w-80 sm:flex" />

        @auth
            <a
                href="{{ route('profile', ['username' => auth()->user()->username]) }}"
            >
                <x-avatar size="sm" :image="auth()->user()->image" />
            </a>
        @endauth

        @guest
            <x-button size="sm" href="{{ route('log-in') }}" class="sm:hidden">
                Log in
            </x-button>
            <x-button
                size="md"
                href="{{ route('log-in') }}"
                class="hidden sm:flex"
            >
                Log in
            </x-button>
        @endguest
    </nav>
</header>
