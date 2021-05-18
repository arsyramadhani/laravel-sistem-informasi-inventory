<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Ribbon extends Component
{
    public $type;
    public $text;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $text)
    {
        //
        $this->type = $type;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ribbon');
    }
}
