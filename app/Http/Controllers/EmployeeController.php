<?php

namespace App\Http\Controllers;

use App\Models\ClientCompany;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::get();
        $company = ClientCompany::get();
        return view('backend.employees.employees',compact('employees','company'));
    }

    public function getPosition(Request $request)
    {
        $position = Position::where('company_id', $request->id)->get();
        return response()->json($position);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(),[
            // 'employee_id' =>'required|max:191',
            'full_name' =>'required|max:191',
            'email' =>'required|email|max:191',
            'phone_1' =>'required|min:11|max:191',

            'gender' =>'required|max:191',
            'image' =>'required|mimes:jpg,png',
            'position_id' =>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{

                $employees = new Employee;
                // $employees->employee_id = date('ymd').rand(0,999);
                $employees->full_name = $request->full_name;
                $employees->phone_1 = $request->phone_1;
                $employees->phone_2 = $request->phone_2;
                $employees->email = $request->email;
                $employees->nid = $request->nid;
                $employees->address_present = $request->address_present;
                $employees->address_permanent = $request->address_permanent;
                $employees->education = $request->education;
                $employees->gender = $request->gender;
                $employees->position_id = $request->position_id;
                $employees->salary = $request->salary;
                $employees->dob = $request->dob;
                $employees->status = 1;
                $employees->join_date = $request->join_date;

                if($request->hasFile('image')){
                    $image = $request->file('image');
                    $image_name = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path().'/backend/image/employee/image/',$image_name);
                    $employees->image = $image_name;
                }
                if($request->hasFile('nid_copy')){
                    $image = $request->file('nid_copy');
                    $image_name = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path().'/backend/image/employee/nid_copy/',$image_name);
                    $employees->nid_copy = $image_name;
                }
                if($request->hasFile('cv')){
                    $image = $request->file('cv');
                    $image_name = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path().'/backend/image/employee/cv/',$image_name);
                    $employees->cv = $image_name;
                }
                $employees->save();

                $payroll = new Payroll;
                $payroll->employee_id = $employees->id;
                $payroll->bonous = $employees->salary;
                $payroll->position_id = $employees->position_id;
                $payroll->reason = "Basic Salary";
                $payroll->date = Carbon::now();
                $payroll->save();

                return response()->json(['success'=>'Data Add successfully.']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = Employee::find($id);
        $payroll = Payroll::find($id)->where('employee_id',$id)->get();
       return view('backend.employees.employee-details', compact('employees','payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::find($id);

        return view('backend.employees.employee-edit',compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $employees = Employee::find($id);
            $employees->full_name = $request->full_name;
            $employees->phone_1 = $request->phone_1;
            $employees->phone_2 = $request->phone_2;
            $employees->email = $request->email;
            $employees->nid = $request->nid;
            $employees->address_present = $request->address_present;
            $employees->address_permanent = $request->address_permanent;
            $employees->education = $request->education;
            $employees->gender = $request->gender;
            $employees->position_id = $request->position_id;
            $employees->salary = $request->salary;
            $employees->dob = $request->dob;
            $employees->join_date = $request->join_date;
            $employees->status = $request->status;
            if($request->hasFile('image')){
                $destination = public_path().'/backend/image/employee/image/'.$employees->image;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $image = $request->file('image');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/backend/image/employee/image/',$image_name);
                $employees->image = $image_name;
            }

            if($request->hasFile('nid_copy')){
                $destination = public_path().'/backend/image/employee/nid_copy/'.$employees->nid_copy;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $image = $request->file('nid_copy');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/backend/image/employee/nid_copy/',$image_name);
                $employees->nid_copy = $image_name;
            }

            if($request->hasFile('cv')){
                $destination = public_path().'/backend/image/employee/cv/'.$employees->cv;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $image = $request->file('cv');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/backend/image/employee/cv/',$image_name);
                $employees->cv = $image_name;
            }
            $employees->update();
            $employees = Employee::all();
            return redirect()->route('employees');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if(!is_null($employee)){

                $image_path = public_path().'/backend/image/employee/'.$employee->image;
                unlink($image_path);
                $employee->delete();
                return response()->json(['success'=>'Data Delete successfully.']);

        }

    }
}
