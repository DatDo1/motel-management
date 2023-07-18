<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\RoomService;
use App\Services\BookingService;
use App\Services\CustomerService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\RoomBookingService;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    protected $bookingService;
    protected $roomService;
    protected $customerService;
    protected $roomBookingService;
    public function __construct(BookingService $bookingService = null, RoomService $roomService = null, CustomerService $customerService = null, RoomBookingService $roomBookingService = null) {
        $this->bookingService = $bookingService;
        $this->roomService = $roomService;
        $this->customerService = $customerService;
        $this->roomBookingService = $roomBookingService;
    }
    public function index()
    {
        $roomList = [];
        $roomBookingList = [];
        $rooms = $this->roomService->getAllRooms();
        $roomBookings = $this->roomBookingService->getAllRoomBookings();
        // foreach($rooms as $room){   
        //     if($room->delete_flag == 0){
        //         $roomBookeds = DB::table('room_bookings')->where('room_id', '=', $room->id)->get();
        //         if($roomBookeds->isNotEmpty()){
        //             foreach($roomBookeds as $roomBooked){
        //                     if($roomBooked->checkin_date == Carbon::now()->toDateString() || $roomBooked->checkout_date == Carbon::now()->toDateString()){
        //                         $room->is_available = $roomBooked->is_available;
        //                         array_push($roomList, $room);
        //                         break;
        //                     }else if($room->id == $roomBooked->room_id){
        //                             array_push($roomList, $room);
        //                             break;
        //                     }
        //             }
        //         }else{
        //             array_push($roomList, $room);
        //         }
        //     }
        // }
        
        foreach($rooms as $room){
            if($room->delete_flag == '0'){
                array_push($roomList, $room);
            }
        }
        // dd($roomList[0]->image);
        return View('client.index', compact('roomList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
