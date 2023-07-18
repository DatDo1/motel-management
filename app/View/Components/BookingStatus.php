<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BookingStatus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $routeDetail;
    public $acceptBooking;
    public $cancelBooking;
    public $acceptBookingAttr;
    public function __construct($routeDetail, $acceptBooking, $cancelBooking, $acceptBookingAttr)
    {
        $this->routeDetail = $routeDetail;
        $this->acceptBooking = $acceptBooking;
        $this->cancelBooking = $cancelBooking;
        $this->acceptBookingAttr = $acceptBookingAttr;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.booking-status');
    }
}
