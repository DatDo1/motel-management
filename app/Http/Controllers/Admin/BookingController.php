<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\RoomService;
use App\Services\BookingService;
use App\Services\CustomerService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\BookingMail;
use App\Services\RoomBookingService;
use App\Services\UserService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
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
    protected $userService;
    public function __construct(BookingService $bookingService = null, RoomService $roomService = null, CustomerService $customerService = null, RoomBookingService $roomBookingService = null, UserService $userService) {
        $this->middleware('employee');
        $this->bookingService = $bookingService;
        $this->roomService = $roomService;
        $this->customerService = $customerService;
        $this->roomBookingService = $roomBookingService;
        $this->userService = $userService;
    }
    public function index()
    {
        // $roomList = [];
        // $roomBookingList = [];
        // $rooms = $this->roomService->getAllRooms();
        // $roomBookings = $this->roomBookingService->getAllRoomBookings();
        // foreach($rooms as $room){   
        //     if($room->delete_flag == 0){
        //         $roomBooked = $roomBookings->where('room_id', '=', $room->id)->first();
        //         if(isset($roomBooked) && $roomBooked->checkin_date == Carbon::now() || isset($roomBooked) && $roomBooked->checkout_date == Carbon::now()){
        //             if($roomBooked->is_available == '1'){
        //                 $room->is_available = '1';
        //                 array_push($roomList, $room);
        //             }elseif($roomBooked->is_available == '2'){
        //                 $room->is_available = '2';
        //                 array_push($roomList, $room);
        //             }    
        //         }else{
        //                 array_push($roomList, $room);
        //         }
        //     }
        // }  

        $roomList = [];
        $roomBookingList = [];
        $rooms = $this->roomService->getAllRooms();
        $roomBookings = $this->roomBookingService->getAllRoomBookings();
        foreach($rooms as $room){   
            if($room->delete_flag == 0){
                $roomBookeds = DB::table('room_bookings')->where('room_id', '=', 9)->get();
                if($roomBookeds->isNotEmpty()){
                    foreach($roomBookeds as $roomBooked){
                        // dd(Carbon::now()->toDateString());
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
        
        return View('admin.booking.bookings', compact('roomList'));       
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        return View('admin.booking.bookings');
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     */
    public function store(Request $request)
    {
        $roomBookeds = $request->roomIDs;
        $customerInfor = null;
        $adminEmail = 'doducdat21122001@gmail.com';
        $roomBookingList = [];
        $bookingDetails = Session::get('booking');
        $users = $this->userService->getAllUsers();
        $customer = $this->customerService->findCustomerById($request->cusID);
        foreach ($users as $user){
            if($customer->user_id == $user->id){
                $customerInfor = $user;
            }
        }

        $booking = [
            'uuid' => Str::uuid(),
            'room_quantity' => count($roomBookeds),
            'people_quantity' => $request->peopleQuantity,
            'other_request' => $request->other_request,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'customer_id' => $request->cusID
        ];

        $booking = $this->bookingService->createBooking($booking);

        if(Session::has('booking')){
            for($i = 0; $i <count($bookingDetails); $i++){
                $room = DB::table('rooms')->where('name', '=', $bookingDetails[$i]["room"])->first();
                $roomBooking = [
                    'checkin_date' => $bookingDetails[$i]["checkin_date"],
                    'booking_id' => $booking->id,
                    'room_id' => $room->id,
                    'uuid' => Str::uuid(),
                    'checkout_date' => $bookingDetails[$i]["checkout_date"],
                    'is_available' => '2',
                    'pay_price' => $room->reference_price,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                $this->roomBookingService->createRoomBooking($roomBooking);
 
                array_push($roomBookingList, [
                    'roomBooking' => $roomBooking,
                    'roomName' => $room->name
                ]);
            }
            
            $data = [
                'customer' => $customerInfor,
                'booking' => $booking,
                'roomBookingList' => $roomBookingList
            ];

            Mail::to($customerInfor->email)
            ->bcc($adminEmail)
            ->send(new BookingMail($data));

            Session::forget('booking');
        }
        return redirect('admin/rooms');
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

    public function createBookingByRoomID($id){
        $room = $this->roomService->findById($id);
        return View('admin.booking.create_booking', compact('room'));
    }
    public function createBookingByRoomIDs(Request $request){
        $rooms = [];
        $room_ids = $request->room_id;
        $checkin_date = $request->checkinDate;
        $checkout_date = $request->checkoutDate;
        $customers = $this->customerService->getAllCustomers();

        foreach($room_ids as $room_id){
            array_push($rooms, $this->roomService->findById($room_id));

        }
        return View('admin.booking.create_booking', compact('rooms', 'customers', 'checkin_date', 'checkout_date'));
    }
    public function findInforCustomer(Request $request){
        $cus = $this->customerService->findCustomerById($request->cusID);
        return View('admin.customer.infor', compact('cus'));
    }
    public function searchCustomer(Request $request){
        if($request->ajax()){
            $output="";
            $customers = $this->customerService->getAllCustomers();
            $users = DB::table('users')
            ->where('first_name','LIKE','%'.$request->search."%")
            ->orWhere('last_name','LIKE','%'.$request->search. "%")
            ->get();
            if (count($users) > 0) {
                foreach ($users as $user) {
                    foreach($customers as $customer){
                        if($user->id == $customer->user_id) {
                            $output .= '<li class="list-group-item" onclick="clickResultSearch(this)" cusID="'.$customer->id.'" cusName="'.$user->first_name ." ". $user->last_name.'"><a href="#aa">' . $user->first_name ." ". $user->last_name  .'</a></li>';
                        }
                    }
                }
                
            }
            return $output;
        }
    }

    public function createDetailBooking(Request $request){
        $data = $request->all();
        return View("admin.booking.create_detail_booking", compact('data'));
    }
    public function storeDetailBooking(Request $request){
        // khi f5 van luu session
        Session::push('booking', $request->all());
    }
    public function bookedList(){
        $bookings = $this->bookingService->getAllBookings();
        $bookingRoomList = $this->roomBookingService->getAllRoomBookings();
        $bookingRooms = [];
        foreach($bookingRoomList as $bookingRoom){
            if($bookingRoom->is_available == '1' && $bookingRoom->delete_flag == '0'){
                array_push($bookingRooms, $bookingRoom);
            }
        }
        return View("admin.booking.booked_list", compact('bookings', 'bookingRooms'));
    }
    public function handleBooking(){
        $bookings = $this->bookingService->getAllBookings();
        $bookingRoomList = $this->roomBookingService->getAllRoomBookings();
        $bookingRooms = [];
        foreach($bookingRoomList as $bookingRoom){
            if($bookingRoom->is_available == '2' && $bookingRoom->delete_flag == '0'){
                array_push($bookingRooms, $bookingRoom);
            }
        }
        return View("admin.booking.handle_booking", compact('bookings', 'bookingRooms'));
    }
    public function canceBookingView(){
        $bookings = $this->bookingService->getAllBookings();
        $bookingRoomList = $this->roomBookingService->getAllRoomBookings();
        $bookingRooms = [];
        foreach($bookingRoomList as $bookingRoom){
            if($bookingRoom->is_available == '3' && $bookingRoom->delete_flag == '0'){
                array_push($bookingRooms, $bookingRoom);
            }
        }
        return View("admin.booking.cancel_booking", compact('bookings', 'bookingRooms'));
    }
    public function acceptBooking($uuid){
        DB::table('room_bookings')->where('uuid', '=', $uuid)->update(['is_available' => '1']);
        return redirect('admin/booking/handle-booking');
    }
    public function cancelBooking($uuid){
        DB::table('room_bookings')->where('uuid', '=', $uuid)->update(['is_available' => '3']);
        return redirect('admin/booking/handle-booking');
    }
    public function deleteBooking($uuid){
        DB::table('room_bookings')->where('uuid', '=', $uuid)->update(['delete_flag' => '1', 'deleted_at' => Carbon::now()]);
        return redirect('admin/booking/cancel-booking');
    }
}
