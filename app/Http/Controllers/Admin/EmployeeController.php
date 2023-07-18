<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Employee\StoreEmployeeRequest;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    protected $employeeService;
    protected $userService;
    public function __construct(EmployeeService $employeeService, UserService $userService) {
        $this->middleware('admin');
        $this->employeeService = $employeeService;
        $this->userService = $userService;
    }
    public function index()
    {
        $empList = [];
        $emps = $this->employeeService->getAllEmployees();
        foreach ($emps as $emp) {
            if($emp->delete_flag == 0){
                array_push($empList, $emp);
            }
        }
        return View('admin.employee.employees', compact('empList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return View('admin.employee.create_employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = [
            'uuid' => Str::uuid(),
            'first_name' => $request['firstName'],
            'last_name' => $request['lastName'],
            'phone_number' => $request['phoneNumber'],
            'user_level' => $request['role'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $user = $this->userService->createUser($data);
        if($user){
            $data = $this->userService->findByEmail($request['email']);

            $empData = [
                'uuid' => Str::uuid(),
                'basic_salary' => $request['basicSalary'],
                'start_date' => $request['startDate'],
                'user_id' => $data->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $employee = $this->employeeService->createEmployee($empData);
            if($employee){
                Alert::success('Thông báo', 'Thêm tài khoản nhân viên thành công!');
                return redirect('admin/employees/create')->with('status', 'Thêm tài khoản nhân viên thành công!');
            }else{
                $this->userService->deleteUser($data->id);
                return redirect('admin/employees/create')->with('status', 'Thêm tài khoản nhân viên thất bại!');
            }
        }else {
            return redirect('admin/employees/create')->with('status', 'Thêm tài khoản nhân viên thất bại!')->withInput();
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
        $employee = $this->employeeService->findEmployeeById($id);
        if($employee) {
            $employee->delete_flag = '1';
            $employee->deleted_at = Carbon::now();
            $employee->save();
        }
        return redirect('admin/employees');
    }
}
