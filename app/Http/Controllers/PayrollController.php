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

class PayrollController extends Controller
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
        $payroll = Payroll::orderBy('id','desc')->get();
        // $employees = Employee::get();
        $company = ClientCompany::get();
        return view('backend.payroll.payroll',compact('payroll','company'));
    }

    public function getposition($id)
    {
        $position = Position::where('company_id', $id)->get();
        return response()->json($position);
    }
    public function getemployee($position_id)
    {
        $employee = Employee::where('position_id', $position_id)->get();
        return response()->json($employee);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'company_id' => 'required|max:191',
            'position_id' => 'required|max:191',
            'employee_id' => 'required|max:191',
            'reason' => 'required|max:191',
            'bonous' => 'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{

            $employee = Employee::find($request->input('employee_id'));
        if(!$employee){
            return back()->with('error', 'Employee Does Not Found');
        }
        $transactionamount = $request->input('amount');

        DB::transaction(function () use ($employee, $transactionamount, $request){
            $payroll = new Payroll;
            $payroll->employee_id = $request->employee_id;
            $payroll->position_id = $request->position_id;
            $payroll->company_id = $request->company_id;
            $payroll->reason = $request->reason;
            $payroll->bonous = $transactionamount;
            $payroll->date =$request->date;

            if($payroll->reason =='Travel_Allowance'){
                $employee->salary += $transactionamount;
                //$bankTransaction->temp_balance =$bank->balance;

                $payroll->save();
                $employee->save();
                return redirect()->back()->with('success', 'Amount Successfull Add In Your Account');
                exit;

                // exit;
            }
            // elseif($bankTransaction->type=='Travel Allowance'){
            //     if($bank->balance >= $transactionamount){
            //         $bank->balance -= $transactionamount;
            //         $bankTransaction->temp_balance =$bank->balance;

            //     $bankTransaction->save();
            //     $bank->save();
            //         return redirect()->back()->with('success','Expense Added Successfully');
            //         exit;
            //     }
            //     elseif($bank->balance <= $transactionamount){
            //         DB::rollBack();
            //         return redirect()->back()->with('error', 'Please Check Balance!');
            //         exit;
            //     }
            // }


    });
    return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|max:191',
            'position_id' => 'required|max:191',
            'employee_id' => 'required|max:191',
            'reason' => 'required|max:191',
            'bonous' => 'required|max:191',

        ]);
        $employee = Employee::find($request->input('employee_id'));
        if(!$employee){
            return back()->with('error', 'Employee Does Not Found');
        }
        $transactionamount = $request->input('bonous');

        DB::transaction(function () use ($employee, $transactionamount, $request){
            $payroll = new Payroll;
            $payroll->employee_id = $request->employee_id;
            $payroll->position_id = $request->position_id;
            $payroll->company_id = $request->company_id;
            $payroll->reason = $request->reason;
            $payroll->bonous = $transactionamount;
            $payroll->date = Carbon::now();

            if($payroll->reason =='Travel_Allowance'){
                $employee->salary += $transactionamount;
                //$bankTransaction->temp_balance =$bank->balance;

                $payroll->save();
                $employee->save();
                return redirect()->back()->with('success', 'Amount Successfull Add In Your Account');
                exit;
            }
            if($payroll->reason =='Mobile Allowance'){
                $employee->salary += $transactionamount;
                //$bankTransaction->temp_balance =$bank->balance;

                $payroll->save();
                $employee->save();
                return redirect()->back()->with('success', 'Amount Successfull Add In Your Account');
                exit;
            }
            if($payroll->reason =='Salary Gross'){
                $employee->salary += $transactionamount;
                //$bankTransaction->temp_balance =$bank->balance;

                $payroll->save();
                $employee->save();
                return redirect()->back()->with('success', 'Amount Successfull Add In Your Account');
                exit;
            }
    });
    return redirect()->back();
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
    public function salaryedit($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

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
