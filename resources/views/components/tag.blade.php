@props([
    'label',
    'link'
    ])
<a href="{{$link}}" class="transition ease-in-out duration-300 transition hover:scale-105">
    <div class="ease-in-out bg-slate-700 hover:bg-slate-600 rounded-[4px] text-white font-bold w-18.25 h-10 sm:w-12.75 sm:h-5  px-4 py-2 sm:px-2.5 sm:py-0.5 w-auto h-auto flex justify-center items-center">   
        <p class="text-md sm:text-sm text-center">{{$label}}</p>
    </div>
</a>


