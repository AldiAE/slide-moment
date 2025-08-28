<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Repeater extends Component
{
    /**
     * Create a new component instance.
     */
    public $fields;
    public $list;

    public function __construct(array $fields, array $list = [])
    {
        $this->fields = $fields;
        $this->list = $list;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.repeater');
    }
}
