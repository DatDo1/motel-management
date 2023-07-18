<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\FacilityService;
use App\Http\Controllers\Controller;
use App\Services\FacilityTypeService;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    protected $facilityService; 
    protected $facilityTypeService;
    public function __construct(FacilityService $facilityService, FacilityTypeService $facilityTypeService) {
        $this->middleware('admin');
        $this->facilityService = $facilityService;
        $this->facilityTypeService = $facilityTypeService;
    }
    public function index()
    {
        $facilities = [];
        $facilityList = $this->facilityService->getAllFacilitys();
        foreach($facilityList as $facility) {
            if($facility->delete_flag == 0){
                array_push($facilities, $facility);
            }
        }
        return View('admin.facility.facilities', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        $facilityTypes = $this->facilityTypeService->getAllFacilityTypes();
        return View('admin.facility.create_facility', compact('facilityTypes'));
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
