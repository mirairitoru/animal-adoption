<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnimalForm extends Component
{
    /**
     * Create a new component instance.
     */

    public $animal;
    public $action;
    public $method;
    public $buttonText;

    public function __construct($action, $method = 'POST', $animal = null, $buttonText = '登録')
    {
        $this->action = $action;
        $this->method = $method;
        $this->animal = $animal;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.animal-form');
    }
}
