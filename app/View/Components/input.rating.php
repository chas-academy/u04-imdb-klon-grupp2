<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class rating extends Component
{

    public function __construct(
        public int $rating = 0,
        public string $label = 'Rating'
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.rating');
    }
}
