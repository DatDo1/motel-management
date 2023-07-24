<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\RoomBookingController;
use App\Http\Controllers\Admin\FacilityTypeController;
use App\Http\Controllers\Admin\OccasionPricingController;
use App\Http\Controllers\Admin\HomeController as AHomeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Client\HomeController as CHomeController;
use App\Http\Controllers\Client\RoomController as CRoomController;
use App\Http\Controllers\Client\BookingController as CBookingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Authentication
Route::get('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('login', [AuthenticationController::class, 'checkLogin'])->name('checkLogin');
Route::get('logout', [AuthenticationController::class, 'logout'])->name('logoutPost'); //?
Route::get('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('register', [AuthenticationController::class, 'checkRegister'])->name('checkRegister');

//Guest Home
Route::get('', [CHomeController::class, 'index'])->name('cusHome');
Route::post('rooms/findRooms', [CRoomController::class, 'findAllRoomByDate'])->name('cus.rooms.findAllRoomByDate');
Route::get('room-detail/{room}', [CRoomController::class, 'roomDetail'])->name('cus.rooms.roomDetail');
Route::resource('user_rooms', CRoomController::class);
Route::resource('user-bookings', CBookingController::class);


Route::get('room-selected', [CRoomController::class, 'roomBookingView'])->name('cus.room.room-booking');
Route::get('create-booking', [CBookingController::class, 'createBooking'])->name('cus.bookings.create');
Route::post('create-detail-booking', [CBookingController::class, 'createDetailBooking'])->name('cus.bookings.createDetail');
Route::post('check-date-booking', [CBookingController::class, 'checkDate'])->name('cus.bookings.checkDate');

Route::post('user/room_detail_bookings', [CBookingController::class, 'storeDetailBookings'])->name('users.room_detail_bookings');
Route::get('user/find-rooms', [CRoomController::class, 'findRoom'])->name('users.rooms.findRoom');
Route::post('user/find-rooms', [CRoomController::class, 'filterRooms'])->name('users.rooms.filterRooms');
Route::post('user/find-rooms-options', [CRoomController::class, 'findRoomsByOption'])->name('users.rooms.findRoomsByOption');

Route::post('user/add-rooms', [CBookingController::class, 'addBookingtoCart'])->name('users.rooms.addBookingtoCart');
Route::post('user/remove-rooms', [CBookingController::class, 'removeBookingtoCart'])->name('users.rooms.removeBookingtoCart');

Route::post('create-booking/room-total-price', [CBookingController::class, 'roomTotalPrice'])->name('users.bookings.roomTotalPrice');


Route::group(['middleware' => 'auth'], function (){
    // Admin
    Route::get('admin/dashboard', [AHomeController::class, 'index'])->name('adminDasboard');

    Route::resource('admin/customers', CustomerController::class);
    Route::resource('admin/employees', EmployeeController::class);
    Route::resource('admin/rooms', RoomController::class);
    Route::resource('admin/room_types', RoomTypeController::class);
    Route::resource('admin/occasion_pricings', OccasionPricingController::class);
    Route::resource('admin/facilities', FacilityController::class);
    Route::resource('admin/facility_types', FacilityTypeController::class);
    Route::resource('admin/bookings', BookingController::class);
    Route::resource('admin/room_bookings', RoomBookingController::class);

    Route::post('admin/rooms/find-rooms', [RoomController::class, 'findAllRoomByDate'])->name('rooms.findAllRoomByDate');
    Route::get('admin/booking/create/{id}', [BookingController::class, 'createBookingByRoomID'])->name('bookings.createBookingByRoomID');
    Route::post('admin/booking/create/', [BookingController::class, 'createBookingByRoomIDs'])->name('bookings.createBookingByRoomIDs');
    Route::post('admin/booking/create-booking', [BookingController::class, 'findInforCustomer'])->name('bookings.findInforCustomer'); 
    Route::get('admin/booking/create-booking', [BookingController::class, 'searchCustomer'])->name('bookings.searchCustomer');  
    Route::post('admin/booking/click-booking', [BookingController::class, 'clickCustomer'])->name('bookings.clickCustomer');  
    Route::post('admin/booking/create-detail-booking', [BookingController::class, 'createDetailBooking'])->name('bookings.createDetailBooking'); 
    Route::post('admin/booking/detail-booking', [BookingController::class, 'storeDetailBooking'])->name('bookings.storeDetailBooking'); 
    Route::get('admin/booking/booking-list', [BookingController::class, 'bookedList'])->name('bookings.bookedList'); 

    Route::get('admin/booking/handle-booking', [BookingController::class, 'handleBooking'])->name('bookings.handleBooking'); 
    Route::get('admin/booking/cancel-booking', [BookingController::class, 'canceBookingView'])->name('bookings.canceBookingView'); 


    Route::post('admin/booking/accept-booking/{booking}', [BookingController::class, 'acceptBooking'])->name('bookings.acceptBooking'); 
    Route::post('admin/booking/cancel-booking/{booking}', [BookingController::class, 'cancelBooking'])->name('bookings.cancelBooking'); 
    Route::post('admin/booking/delete-booking/{booking}', [BookingController::class, 'deleteBooking'])->name('bookings.deleteBooking'); 

    // User
    
});


Route::get('authorized/google', [AuthenticationController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [AuthenticationController::class, 'handleGoogleCallback']);







Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
