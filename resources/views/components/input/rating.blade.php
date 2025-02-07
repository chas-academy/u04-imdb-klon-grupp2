<div class="flex items-center space-x-2">
    <span class="font-semibold text-slate-50">{{ $label }}</span>
    <div class="flex space-x-1">
        @for ($i = 1; $i <= 10; $i++)
            <x-lucide-star
                class="w-6 h-6 {{ $i <= $rating ? 'fill-indigo-400 text-indigo-400' : 'text-slate-400 fill-transparent' }}"
            />
        @endfor
    </div>
</div>
