<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OccasionPricingService;

class OccasionPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $occasionPricingService;
    public function __construct(OccasionPricingService $occasionPricingService) {
        $this->middleware('admin');
        $this->occasionPricingService = $occasionPricingService;
    }
    public function index()
    {
        $occasionList = [];
        $occasions = $this->occasionPricingService->getAllOccasionPricings();
        foreach($occasions as $occasion){
            if($occasion->delete_flag == 0){
                array_push($occasionList, $occasion);
            }
        }
        return View('admin.occasion_pricing.occasion_pricings', compact('occasionList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return View('admin.occasion_pricing.create_occasion_pricing');
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
            'time' => $request->occasion,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $occasion = $this->occasionPricingService->createOccasionPricing($data);
        if($occasion){
            return redirect('admin/occasion_pricings');
        }else{
            return redirect('admin/occasion_pricings/create');
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
        $occ = $this->occasionPricingService->findOccasionPricingById($id);
        if($occ){
            $occ->delete_flag = '1';
            $occ->deleted_at = Carbon::now();
            $occ->save();
        }
        return redirect('admin/occasion_pricings');
    }
}
