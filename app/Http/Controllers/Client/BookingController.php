<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\BookingMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\RoomService;
use App\Services\UserService;
use App\Services\BookingService;
use App\Services\CustomerService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\RoomBookingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Event\RequestEvent;

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
        $this->bookingService = $bookingService;
        $this->roomService = $roomService;
        $this->customerService = $customerService;
        $this->roomBookingService = $roomBookingService;
        $this->userService = $userService;
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
     */
    public function store(Request $request)
    {
        $roomBookeds = $request->roomIDs;
        $customerInfor = null;
        $adminEmail = 'doducdat21122001@gmail.com';
        $roomBookingList = [];
        $bookingDetails = Session::get('booking');
        // $users = $this->userService->getAllUsers();
        // $customer = $this->customerService->findCustomerById($request->cusID);
        // foreach ($users as $user){
        //     if($customer->user_id == $user->id){
        //         $customerInfor = $user;
        //     }
        // }
        $user = DB::table('users')->where('email', '=', $request->email)->first();
        // dd($user->id);
        $user = User::find($user->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->citizen_identification = $request->citizen_identification;
        $user->address = $request->address;
        $saveUser = $user->save();
        // if($saveUser){     
        //      update credit customer
        // }
        $customer = DB::table('customers')->where('user_id', '=', $user->id)->first();
        // dd($customer);
        $booking = [
            'uuid' => Str::uuid(),
            'room_quantity' => count($roomBookeds),
            'people_quantity' => $request->peopleQuantity,
            'other_request' => $request->other_request,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'customer_id' => $customer->id,
        ];

        $booking = $this->bookingService->createBooking($booking);

        if(Session::has('booking')){
            for($i = 0; $i <count($bookingDetails); $i++){
                $room = DB::table('rooms')->where('name', '=', $bookingDetails[$i]["room"])->first();
    
                $roomBooking = [
                    'checkin_date' => date('Y-m-d', strtotime($bookingDetails[$i]["checkin_date"])),
                    'booking_id' => $booking->id,
                    'room_id' => $room->id,
                    'uuid' => Str::uuid(),
                    'checkout_date' => date('Y-m-d', strtotime($bookingDetails[$i]["checkout_date"])),
                    'is_available' => '2',
                    'pay_price' => $room->reference_price,   // giá phòng 1 ngày
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
                'customer' => $user,
                'booking' => $booking,
                'roomBookingList' => $roomBookingList
            ];

            Mail::to($user->email)
            ->bcc($adminEmail)
            ->send(new BookingMail($data));

            Session::forget('booking');
            Session::forget('room_quantity');
            Session::forget('room_bookings');

        }

        // Thiếu invoice
        return redirect('/find-rooms');
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
    public function createBookingByRoomIDs(Request $request){
        $rooms = [];
        $room_ids = $request->room_id;
        $checkin_date = $request->checkinDate;
        $checkout_date = $request->checkoutDate;
        $customers = $this->customerService->getAllCustomers();

        foreach($room_ids as $room_id){
            array_push($rooms, $this->roomService->findById($room_id));

        }
        return View('client.booking.create_booking', compact('rooms', 'customers', 'checkin_date', 'checkout_date'));
    }
    public function createBooking(){
        
        return View('client.booking.create_booking');
    }
    public function createDetailBooking(Request $request){
        $data = $request->all();
        $room = DB::table('rooms')->where('name', '=', $data['room'])->first();
        $room = $this->roomService->findById($room->id);
        return View("client.booking.create_detail_booking", compact('data', 'room'));
    }
    public function checkDate(Request $request){
        $room = $request->all();
        $output = "";
        $arrCheckinDate = [];
        $arrCheckoutDate = [];

        $roomBookings = DB::table('room_bookings')->where('room_id', '=', $room['room'])->get();
        if($roomBookings->isEmpty()){
            return "";
        }else{
            foreach($roomBookings as $roomBooking){
                $dateCheckin = new Carbon( $roomBooking->checkin_date);
                $dayCheckin = $dateCheckin->day;
                $monthCheckin = $dateCheckin->month;
                $yearCheckin = $dateCheckin->year;

                $dateCheckout = new Carbon( $roomBooking->checkout_date);
                $dayCheckout = $dateCheckout->day;
                $monthCheckout = $dateCheckout->month;
                $yearCheckout = $dateCheckout->year;

                // $output .= "{ from: [$yearCheckin, $monthCheckin, $dayCheckin], to: [$yearCheckout, $monthCheckout, $dayCheckout] }, ";
                array_push($arrCheckinDate, $roomBooking->checkin_date);
                array_push($arrCheckoutDate, $roomBooking->checkout_date);

            }
            

        }
        // dd($output);
        return [$arrCheckinDate, $arrCheckoutDate];
    }
    public function storeDetailBookings(Request $request){
        if(Auth::user()){
            Session::push('booking', $request->all());
            
        }else{
            return '/login';
        }
    }

    public function addBookingtoCart(Request $request){
        $room = $this->roomService->findById($request->room_id);
        $room_quantity = Session::get('room_quantity')!=null?Session::get('room_quantity'):0;
        $room_bookings = Session::get('room_bookings')!=null?Session::get('room_bookings'):0;
        if($room_bookings != null){
            foreach($room_bookings as $room_booking){
                if(in_array($room, $room_bookings)){
                    break;  
                }else{
                    $room_quantity += 1;
                    array_push($room_bookings, $room);     
                }
                  
            }
        }else{
            $room_bookings = [];
            $room_quantity += 1;
            array_push($room_bookings, $room);
        }
    
        Session::put('room_quantity', $room_quantity);
        Session::put('room_bookings', $room_bookings);
        // dd([$room_quantity, $room_bookings]);
        return [$room_quantity, $room_bookings];
    }
    public function removeBookingtoCart(Request $request){
        $room = $this->roomService->findById($request->room_id);
        $room_quantity = Session::get('room_quantity');
        $room_bookings = Session::get('room_bookings');
        if($room_bookings != null){
            if(in_array($room, $room_bookings)){
                $room_quantity -= 1;
                unset($room_bookings[array_search($room, $room_bookings)]);
            }   
        }
        Session::put('room_quantity', $room_quantity);
        Session::put('room_bookings', $room_bookings);
        // dd([$room_quantity, $room_bookings]);
        return View('client.booking.room_booking', compact('room_bookings'));
    }
}
