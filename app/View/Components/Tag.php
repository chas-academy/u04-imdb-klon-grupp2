<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tag extends Component
{
    public $size;

    public $label;

    public $hoverState;

    /**
     * Create a new component instance.
     */
    public function __construct($size = 'small', $label = 'Tag Label', $hoverState = false)
    {
        $this->size = $size;
        $this->label = $label;
        $this->hoverState = $hoverState;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.tag');
    }
}
