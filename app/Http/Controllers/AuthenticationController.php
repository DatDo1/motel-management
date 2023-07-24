<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;

class AuthenticationController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService ) {
        $this->userService = $userService;
        
    }
    public function login(){
        Session::put('link', url()->previous());

        return View('login');
    }
    public function checkLogin(Request $request){

        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            if(Auth::user()->user_level == 3){
                return redirect(session('link'));
            }else if(Auth::user()->user_level == 2){   
                return redirect('admin/rooms');             
            }else{
                return redirect('admin/dashboard');
            }
        }else {
            return redirect('login');
        }
    }
    public function logout(){
        Auth::logout();
        Session::forget('booking');       // save detail booking
        Session::forget('room_quantity'); // số lượng phòng user chọn
        Session::forget('room_bookings'); // những phòng user chọn
        Session::forget('date_booking');
        Session::forget('booking_total_price');
        
        return redirect('/');
    }
    public function register(){
        return View('register');
    }
    public function checkRegister(Request $request){
        $userList = $this->userService->getAllUsers();
        foreach($userList as $user){
            if($user->delete_flag == '0'){
                if($request->email == $user->email){
                    return redirect('/register');
                }else{
                    if($request->password != $request->confirm_password){
                        return redirect('/register');
                    }else{
                        $data = [
                            'uuid' => Str::uuid(),
                            'user_level' => '3',
                            'email' => $request->email,
                            'password' => Hash::make($request->password)
                        ];

                        $this->userService->createUser($data);
                        return redirect('/login');
                    }
                }
            }
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {
      
            $user = Socialite::driver('google')->stateless()->user();
            $is_user = User::where('email', $user->getEmail())->first();
    
            if(!$is_user){
       
                $saveUser = User::updateOrCreate(
                    [
                        'google_id' => $user->getId(),
                    ],
                    [
                        'uuid' => Str::uuid(),
                        'last_name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'password'=> '123',
                        'user_level' => '3',
                        'updated_at' => Carbon::now(),
                        'created_at' => Carbon::now()
                    ]
                    
                );
                // Tao them customer
                $customer = Customer::updateOrCreate([
                    'uuid' => Str::uuid(),
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'user_id' => $saveUser->id
                ]);
       
            }else{
                
                $saveUser = User::where('email', $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
             
            }

            Auth::loginUsingId($saveUser->id);
         
            $previousUrl = Session::get('link', '/');
            // dd(Session::has('link'));
            return redirect()->to($previousUrl);

      
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
