<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Option extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $routeDetail;
    public $routeEdit;
    public $routeDestroy;
    public $routeBooking;
    public $bookingClass;
    public function __construct($routeDetail ,$routeEdit, $routeDestroy, $routeBooking, $bookingClass)
    {
        $this->routeDetail = $routeDetail;
        $this->routeEdit = $routeEdit;
        $this->routeDestroy = $routeDestroy;
        $this->routeBooking = $routeBooking;
        $this->bookingClass = $bookingClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.option');
    }
}
