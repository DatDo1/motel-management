<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\RoomService;
use App\Services\BookingService;
use App\Services\RoomTypeService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Services\RoomBookingService;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    protected $roomService;
    protected $roomTypeService;
    protected $roomBookingService;
    public function __construct(RoomService $roomService, RoomTypeService $roomTypeService, RoomBookingService $roomBookingService) {
        $this->middleware('employee');
        $this->roomService = $roomService;
        $this->roomTypeService = $roomTypeService;
        $this->roomBookingService = $roomBookingService;
    }
    public function index()
    {   
        $roomTypes = RoomType::all();
        $roomList = [];
        $roomBookingList = [];
        $rooms = $this->roomService->getAllRooms();
        $roomBookings = $this->roomBookingService->getAllRoomBookings();
        foreach($rooms as $room){   
            if($room->delete_flag == 0){
                $roomBookeds = DB::table('room_bookings')->where('room_id', '=', $room->id)->get();
                if($roomBookeds->isNotEmpty()){
                    foreach($roomBookeds as $roomBooked){
                            if($roomBooked->checkin_date == Carbon::now()->toDateString() || $roomBooked->checkout_date == Carbon::now()->toDateString()){
                                $room->is_available = $roomBooked->is_available;
                                array_push($roomList, $room);
                                break;
                                
                            }else if($room->id == $roomBooked->room_id){
                                    array_push($roomList, $room);
                                    break;
                            }
                    }
                }else{
                    array_push($roomList, $room);
                }
                }
        } 
        return View('admin.room.rooms', compact('roomList', 'roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        $roomTypeList = [];
        $roomTypes = $this->roomTypeService->getAllRoomTypes();
        foreach ($roomTypes as $roomType) {
            if($roomType->delete_flag == 0){
                array_push($roomTypeList, $roomType);
            }
        }
        return View('admin.room.create_room', compact('roomTypeList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     */
    public function store(Request $request)
    {
        $imageArr = [];
        $des = 'admin/assets/img/rooms';
        if($request->hasFile('image')){
            foreach($request->file('image') as $image){
                $imageR = $image->getClientOriginalName();
                array_push($imageArr, $imageR);
                $image->move(public_path($des), $imageR);   
            }
        }
        // dd($imageArr);
        $imageArrr = serialize($imageArr);
        $a = unserialize($imageArrr);
        // dd($a[0]);
        $data = [
            'uuid' => Str::uuid(),	
            'name' => $request->roomName,	
            'floor' => $request->floor,	
            'is_available' => $request->room_status,	
            'image' => $imageArrr,	
            'reference_price' => $request->referencePrice,	
            'area' => $request->area,	
            'adult_quantity' => $request->adultQuantity,
            'children_quantity' => $request->childrenQuantity,
            'created_at' => Carbon::now(),	
            'updated_at' => Carbon::now(),	
            'room_type_id' => $request->room_type
        ];

        $room = $this->roomService->createRoom($data);
        if($room){
            return redirect('admin/rooms');
        }else{
            return redirect('admin/rooms/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(2);
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
     * 
     */
    public function destroy($id)
    {
        $room = $this->roomService->findById($id);
        if($room) {
            $room->delete_flag = '1';
            $room->deleted_at = Carbon::now();
            $room->save();
        }
        return redirect('admin/rooms');
    }

    public function findAllRoomByDate(Request $request){ 

        $roomBookings = $this->roomBookingService->getAllRoomBookings();
        $roomList = [];
        $rooms = $this->roomService->getAllRooms();

        switch ($request->btnType) {
            case '1':
                $roomList = [];
                $roomBookingList = [];
                $rooms = $this->roomService->getAllRooms();
                $roomBookings = $this->roomBookingService->getAllRoomBookings();
                foreach($rooms as $room){   
                    $roomBooked = $roomBookings->where('room_id', '=', $room->id)->first();
                    if($room->delete_flag == 0){
                        if(isset($roomBooked)){
                                $room->is_available = '1';
                                array_push($roomList, $room);
                            
                        }else{
                                array_push($roomList, $room);
                        }
                    }
                }
                break;
            case '2':
                if($request->checkinDate > $request->checkoutDate){
                    break;
                }else {
                    foreach($rooms as $room){
                        if($room->delete_flag == 0 ){
                            $roomBookings = DB::table('room_bookings')->where('room_id', '=', $room->id)->get();
                            // dd(($roomBookings));
                            if($roomBookings->isNotEmpty()){
                                foreach($roomBookings as $roomBooking){
                                    if($roomBooking->checkin_date <= $request->checkinDate && $request->checkoutDate <= $roomBooking->checkout_date || $roomBooking->checkout_date == $request->checkinDate || $roomBooking->checkin_date == $request->checkoutDate){
                                        continue;
                                    }else {
                                        if(count($roomBookings) > 1){
                                            if($request->adult_quantity <= $room->adult_quantity && $request->children_quantity <= $room->children_quantity){
                                                if($request->room_type == $room->room_type_id){
                                                    if($request->room_price >= $room->reference_price){
                                                        if($request->floor == $room->floor){
                                                            array_push($roomList, $room);   
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }else{
                                            if($request->adult_quantity <= $room->adult_quantity && $request->children_quantity <= $room->children_quantity){
                                                if($request->room_type == $room->room_type_id){
                                                    if($request->room_price >= $room->reference_price){
                                                        if($request->floor == $room->floor){
                                                            array_push($roomList, $room);   
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
    
                                }
                                
                                
                            }else {
                                // dk null
                                if($request->adult_quantity <= $room->adult_quantity && $request->children_quantity <= $room->children_quantity){
                                    if($request->room_type == $room->room_type_id){
                                        if($request->room_price >= $room->reference_price){
                                            if($request->floor == $room->floor){
                                                array_push($roomList, $room);   
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
    
                        }
                    }

                }

                break;
            case '3':
                foreach($roomBookings as $roomBooking){
                    if($roomBooking->delete_flag == 0 ){
                        if($request->checkinDate >= $roomBooking->checkin_date && $request->checkinDate <= $roomBooking->checkout_date || $request->checkoutDate >= $roomBooking->checkin_date && $request->checkoutDate <= $roomBooking->checkout_date){
                            $room = $rooms->where('id', '=', $roomBooking->room_id)->first();
                            if($room->delete_flag == 0){
                                $room->is_available = '1';
                                array_push($roomList, $room);
                            }
                        }
                    }
                }
                break;
            case '4':
                # code...
                break;                     
            default:
                # code...
                break;
        }

        

        return View('admin.room.findbydate', compact('roomList'));
    }
}
