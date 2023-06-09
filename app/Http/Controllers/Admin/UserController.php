<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    public function index()
    {
        $data = $this->userService->getAllUsers();
        return View('admin.user.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return View('admin.user.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(UserRequest $request)
    {
        
        $inputData = $request->all();
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
