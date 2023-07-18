<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\RoomTypeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon as SupportCarbon;


class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    protected $roomTypeService;
    public function __construct(RoomTypeService $roomTypeService) {
        $this->middleware('admin');
        $this->roomTypeService = $roomTypeService;
    }
    public function index()
    {
        $roomTypeList = [];
        $roomTypes = $this->roomTypeService->getAllRoomTypes();
        foreach ($roomTypes as $roomType) {
            if($roomType->delete_flag == 0){
                array_push($roomTypeList, $roomType);
            }
        }
        return View('admin.room_type.room_types', compact('roomTypeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return View('admin.room_type.create_room_type');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     */
    public function store(Request $request)
    {
        $data = [
            'uuid'=> Str::uuid(),	
            'name'=> $request->roomTypeName,	
            'description'=> $request->description, 	
            'created_at'=> Carbon::now(),  	
            'updated_at'=> Carbon::now() 
        ];
        $roomType = $this->roomTypeService->createRoomType($data);
        if($roomType){
            return redirect('admin/room_types');
        }else{
            return redirect('admin/room_types/create');
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
     * 
     */
    public function destroy($id)
    {
        $roomType = $this->roomTypeService->findRoomTypeById($id);
        if($roomType){
            $roomType->delete_flag = '1';
            $roomType->deleted_at = Carbon::now();
            $roomType->save();
        }
        return redirect('admin/room_types');
    }
}
