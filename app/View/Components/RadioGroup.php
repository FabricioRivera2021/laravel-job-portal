<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options,
        public ?bool $allOptions = true,
        public ?string $value = null
    )
    {
        //
    }

    public function optionsWithLabels(): array
    {
        // array_is_list return if an array is an asociative array or not
        return array_is_list($this->options) //true if array is [0 => 'something']
            ? array_combine($this->options, $this->options) //return the array in asociative format
            : $this->options; // return the array

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group');
    }
}
