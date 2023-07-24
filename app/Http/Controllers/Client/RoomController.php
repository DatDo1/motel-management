<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\RoomService;
use App\Services\RoomTypeService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $this->roomService = $roomService;
        $this->roomTypeService = $roomTypeService;
        $this->roomBookingService = $roomBookingService;
    }
    public function index()
    {
        //
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
     * 
     */
    public function show($id)
    {
       
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
                foreach($rooms as $room){
                    if($room->delete_flag == 0 ){
                        $roomBookings = DB::table('room_bookings')->where('room_id', '=', $room->id)->get();
                        if($roomBookings->isNotEmpty()){
                            foreach($roomBookings as $roomBooking){
                                if($roomBooking->checkin_date >= $request->checkinDate || $request->checkoutDate <= $roomBooking->checkout_date || $roomBooking->checkout_date == $request->checkinDate || $roomBooking->checkin_date == $request->checkoutDate){
                                    continue;
                                }else {
                                    array_push($roomList, $room);   
                                }
                            }
                            
                        }else {
                            array_push($roomList, $room);
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

    public function roomDetail($uuid){
        $room = DB::table('rooms')->where('uuid', '=', $uuid)->first();
        $room = $this->roomService->findById($room->id);
        return View("client.room.roomDetail", compact('room'));
    }
    public function findRoom(){
        $roomList = $this->roomService->getAllRooms();
        $roomTypeList = $this->roomTypeService->getAllRoomTypes();
        return View('client.room.findRooms', compact('roomList', 'roomTypeList'));
    }
    public function filterRooms(Request $request){
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
                                            // if($request->adult_quantity <= $room->adult_quantity && $request->children_quantity <= $room->children_quantity){
                                                array_push($roomList, $room);   
                                                break;
                                            // }
                                        }else{
                                            // if($request->adult_quantity <= $room->adult_quantity && $request->children_quantity <= $room->children_quantity){
                                                array_push($roomList, $room);   
                                            // }
                                        }
                                    }
    
                                }
                                
                                
                            }else {
                                // if($request->adult_quantity <= $room->adult_quantity && $request->children_quantity <= $room->children_quantity){
                                    array_push($roomList, $room);   
                                // }
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
            case '4':   // Tìm theo giá phòng
                if($request->checkinDate > $request->checkoutDate){
                    break;
                }else {
                    foreach($rooms as $room){
                        if($room->delete_flag == 0 ){
                            $roomBookings = DB::table('room_bookings')->where('room_id', '=', $room->id)->get();
                            // dd(($roomBookings));
                            if($roomBookings->isNotEmpty()){
                                foreach($roomBookings as $roomBooking){
                                    if(count($roomBookings) > 1){
                                        if($request->adult_quantity >= $room->adult_quantity && $request->children_quantity >= $room->children_quantity){
                                            if($request->room_price >= $room->reference_price){
                                                array_push($roomList, $room);   
                                            }  
                                        }
                                    }else{
                                        if($request->adult_quantity >= $room->adult_quantity && $request->children_quantity >= $room->children_quantity){
                                            if($request->room_price >= $room->reference_price){
                                                array_push($roomList, $room);   
                                            }    
                                        }
                                    }

                                }             
                            }else {
                                if($request->adult_quantity >= $room->adult_quantity && $request->children_quantity >= $room->children_quantity){
                                    if($request->room_price >= $room->reference_price){
                                        array_push($roomList, $room);   
                                    }   
                                }
                            }

                        }
                    }
                }

                break;                  
            default:
                # code...
                break;
        }

        

        return View('client.room.findbydate', compact('roomList'));
    }
    public function findRoomsByOption(Request $request){
        // dd($request->all());
        $roomBookings = $this->roomBookingService->getAllRoomBookings();
        $roomList = [];
        $rooms = $this->roomService->getAllRooms();

        if($request->checkinDate > $request->checkoutDate){
            return;
        }else {
            foreach($rooms as $room){
                if($room->delete_flag == 0 ){
                    $roomBookings = DB::table('room_bookings')->where('room_id', '=', $room->id)->get();
     
                    if($roomBookings->isNotEmpty()){
                        foreach($roomBookings as $roomBooking){
                            if(count($roomBookings) > 1){ 
                                if($request->roomType != null){         //room type != null
                                    if($request->floor != null){        //floor != null
                                        if($request->price != null){    //price != null
                                            if($request->roomType == $room->room_type_id){
                                                if($request->floor == $room->floor){
                                                    if($request->price >= $room->reference_price){
                                                        array_push($roomList, $room);   
                                                    }  
                                                }
                                            }
                                        }else{      //price == null
                                            if($request->roomType == $room->room_type_id){
                                                if($request->floor == $room->floor){
                                                    array_push($roomList, $room);   
                                                }
                                            }
                                        }
                                    }else{    //floor == null
                                        if($request->price != null){
                                            if($request->roomType == $room->room_type_id){
                                                if($request->price >= $room->reference_price){
                                                    array_push($roomList, $room);   
                                                }  
                                            }
                                        }else{
                                            if($request->roomType == $room->room_type_id){
                                                array_push($roomList, $room);   
                                            }
                                        }
                                    }
                                }else{      //room type == null
                                    if($request->floor != null){        
                                        if($request->price != null){    
                                            if($request->floor == $room->floor){
                                                if($request->price >= $room->reference_price){
                                                    array_push($roomList, $room);   
                                                }  
                                            }
                                        }else{     
                                            if($request->floor == $room->floor){
                                                array_push($roomList, $room);   
                                            }
                                            
                                        }
                                    }else{    
                                        if($request->price != null){
                                            if($request->price >= $room->reference_price){
                                                array_push($roomList, $room);   
                                            } 
                                           
                                        }else{
                                            array_push($roomList, $room);   
                                        }
                                    }
                                }
                                     
                            }else{
                                if($request->roomType != null){         //room type != null
                                    if($request->floor != null){        //floor != null
                                        if($request->price != null){    //price != null
                                            if($request->roomType == $room->room_type_id){
                                                if($request->floor == $room->floor){
                                                    if($request->price >= $room->reference_price){
                                                        array_push($roomList, $room);   
                                                    }  
                                                }
                                            }
                                        }else{      //price == null
                                            if($request->roomType == $room->room_type_id){
                                                if($request->floor == $room->floor){
                                                    array_push($roomList, $room);   
                                                }
                                            }
                                        }
                                    }else{    //floor == null
                                        if($request->price != null){
                                            if($request->roomType == $room->room_type_id){
                                                if($request->price >= $room->reference_price){
                                                    array_push($roomList, $room);   
                                                }  
                                            }
                                        }else{
                                            if($request->roomType == $room->room_type_id){
                                                array_push($roomList, $room);   
                                            }
                                        }
                                    }
                                }else{      //room type == null
                                    if($request->floor != null){        
                                        if($request->price != null){    
                                            if($request->floor == $room->floor){
                                                if($request->price >= $room->reference_price){
                                                    array_push($roomList, $room);   
                                                }  
                                            }
                                        }else{     
                                            if($request->floor == $room->floor){
                                                array_push($roomList, $room);   
                                            }
                                            
                                        }
                                    }else{    
                                        if($request->price != null){
                                            if($request->price >= $room->reference_price){
                                                array_push($roomList, $room);   
                                            } 
                                            // dd($roomList);
                                        }else{
                                            array_push($roomList, $room);   
                                            // dd($roomList);   

                                        }
                                    }
                                }   
                                
                            }

                        }             
                    }else {
                        if($request->roomType != null){         //room type != null
                            if($request->floor != null){        //floor != null
                                if($request->price != null){    //price != null
                                    if($request->roomType == $room->room_type_id){
                                        if($request->floor == $room->floor){
                                            if($request->price >= $room->reference_price){
                                                array_push($roomList, $room);   
                                            }  
                                        }
                                    }
                                }else{      //price == null
                                    if($request->roomType == $room->room_type_id){
                                        if($request->floor == $room->floor){
                                            array_push($roomList, $room);   
                                        }
                                    }
                                }
                            }else{    //floor == null
                                if($request->price != null){
                                    if($request->roomType == $room->room_type_id){
                                        if($request->price >= $room->reference_price){
                                            array_push($roomList, $room);   
                                        }  
                                    }
                                }else{
                                    if($request->roomType == $room->room_type_id){
                                        array_push($roomList, $room);   
                                    }
                                }
                            }
                        }else{      //room type == null
                            if($request->floor != null){        
                                if($request->price != null){    
                                    if($request->floor == $room->floor){
                                        if($request->price >= $room->reference_price){
                                            array_push($roomList, $room);   
                                        }  
                                    }
                                }else{     
                                    if($request->floor == $room->floor){
                                        array_push($roomList, $room);   
                                    }
                                    
                                }
                            }else{    
                                if($request->price != null){
                                    if($request->price >= $room->reference_price){
                                        array_push($roomList, $room);   
                                    } 
                                   
                                }else{
                                    array_push($roomList, $room);   
                                    // dd($roomList);
                                }
                            }
                        } 
                    }

                }
            }
        }
        return View('client.room.findbydate', compact('roomList'));   
    }
    public function roomBookingView(){
        return View('client.room.room_selected');
    }
}
