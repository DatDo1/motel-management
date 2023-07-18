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

class AuthenticationController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService ) {
        $this->userService = $userService;
    }
    public function login(){
        session(['link' => url()->previous()]);
        return View('login');
    }
    public function checkLogin(Request $request){
        // $users = $this->userService->getAllUsers();
        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            if(Auth::user()->user_level == 3){
                return redirect(session('link'));
            }else if(Auth::user()->user_level == 2){   
                return redirect('admin/rooms');             
            }else{
                return redirect('admin/dashboard');
            }
        }
    }
    public function logout(){
        Auth::logout();
        Session::forget('booking');       // save detail booking
        Session::forget('room_quantity'); // số lượng phòng user chọn
        Session::forget('room_bookings'); // những phòng user chọn
        
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
      
            $user = Socialite::driver('google')->user();
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
                        'user_level' => '3',
                        'updated_at' => Carbon::now(),
                        'createa_at' => Carbon::now()
                    ]
                    
                );
                // Tao them customer
       
            }else{
                
                $saveUser = User::where('email', $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
             
            }
            Auth::loginUsingId($saveUser->id);
            return redirect(session('link'));

      
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
