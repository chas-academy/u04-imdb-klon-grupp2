<header
    class="fixed flex h-16 w-full max-w-5xl items-center justify-between bg-slate-800/90 px-6 backdrop-blur-sm has-[.search-open]:px-4 sm:h-20"
>
    <a href="/">
        <img src="{{ asset('images/logo.svg') }}" alt="Popco logo" />
    </a>

    <nav class="flex items-center gap-4">
        {{-- mobile --}}
        <x-button variant="icon" srLabel="Open search" class="sm:hidden">
            <x-lucide-search class="size-6 text-slate-50" />
        </x-button>
        <x-button size="sm" href="{{ route('log-in') }}" class="sm:hidden">
            Log in
        </x-button>

        {{-- desktop --}}
        <x-search placeholder="Search..." class="hidden w-80 sm:flex" />
        <x-button size="md" href="{{ route('log-in') }}" class="hidden sm:flex">
            Log in
        </x-button>
    </nav>
</header>
