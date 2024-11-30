<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $text;
    public $onclick;
    public $bg;
    public $type;
    public function __construct($text = 'Button', $id = null, $onclick = null, $bg = 'bg-button', $type = null)
    {
        $this->text = $text;
        $this->id = $id;
        $this->onclick = $onclick;
        $this->bg = $bg;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
