@props([
    'label',
    'link'
    ])

<a href="{{$link}}" class="transition ease-in-out duration-300 transform hover:scale-105">
    <div class="ease-in-out bg-slate-700 hover:bg-slate-600 rounded-lg text-md md:text-sm text-white font-bold px-4 py-2 md:text-sm">   
        <p>{{$label}}</p>
    </div>

