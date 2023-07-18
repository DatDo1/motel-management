<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FacilityTypeService;

class FacilityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    protected $facilityTypeService;
    public function __construct(FacilityTypeService $facilityTypeService) {
        $this->middleware('admin');
        $this->facilityTypeService = $facilityTypeService;
    }
    public function index()
    {
        $facilityTypes = [];
        $facilityTypeList = $this->facilityTypeService->getAllFacilityTypes();
        foreach($facilityTypeList as $facilityType) {
            if($facilityType->delete_flag == 0){
                array_push($facilityTypes, $facilityType);
            }
        }
        return View('admin.facility_type.facility_types', compact('facilityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        return View('admin.facility_type.create_facility_type');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(Request $request)
    {
        $data = [
            'uuid' => Str::uuid(),
            'name' => $request->facilityTypeName,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $this->facilityTypeService->createFacilityType($data);
        return redirect('admin/facility_types');
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
        $fac = $this->facilityTypeService->findFacilityTypeByID($id);
        $fac->delete_flag = "1";
        $fac->save();
        return redirect('admin/facility_types');
    }
}
