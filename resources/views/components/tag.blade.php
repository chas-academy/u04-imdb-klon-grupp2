@props([
    'label',
    'link'
    ])
<a href="{{$link}}" class="transition ease-in-out duration-300 transform hover:scale-105">
    <div class="ease-in-out bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-bold px-4 py-2 sm:px-2.5 sm:py-0.5 w-auto h-auto flex justify-center items-center">   
        <p class="text-md sm:text-sm text-center">{{$label}}</p>
    </div>


