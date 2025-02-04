<div>
    class="inline-block rounded-full px-4 py-2 font-bold text-slate-100
    {{ $size === 'small' ? 'text-sm' : 'text-md' }}
    {{ $hoverState ? "bg-slate-700 text-slate-100 hover:bg-slate-600" : }}
    transition-colors duration-200" >

    {{ $label }}
</div>
