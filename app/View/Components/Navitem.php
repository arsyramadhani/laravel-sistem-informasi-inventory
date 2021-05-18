<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navitem extends Component
{
    public $to;
    public $active;
    public $icon;
    public $judul;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($to, $active, $icon, $judul)
    {
        //
        $this->to = $to;
        $this->active = $active;
        $this->icon = $icon;
        $this->judul = $judul;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navitem');
    }
}
