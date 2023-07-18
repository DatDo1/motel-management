<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Role extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $userRole;
    public function __construct($userRole)
    {
        $this->userRole = $userRole;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.role');
    }
}
