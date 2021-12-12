<?php

namespace App\Http\Controllers;

use App\Models\BankTransaction;
use App\Models\CompanyBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.ledger.ledger');
    }
    public function index1()
    {
        return view('backend.ledger.ledger1');
    }
    public function companyledger()
    {
        return view('backend.ledger.company-ledger');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genarateledger(Request $request)
    {
        $data = BankTransaction::select('account_number')
                                ->groupBy('account_number')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get();

        $data1 = $request->input('from');
        $data2 = $request->input('to');

        $data3 = BankTransaction::where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get();
        $data4 = BankTransaction::where('type','credit')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get()
                                ->sum('amount');

        $data5 = BankTransaction::where('type','debit')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get()
                                ->sum('amount');

        $previousdate = Carbon::createFromDate($request->input('from'))->subDays();
        $data6 = BankTransaction::where('type','credit')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',['2000-01-01',$previousdate])
                                ->get()
                                ->sum('amount');

        $data7 = BankTransaction::where('type','debit')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',['2000-01-01',$previousdate])
                                ->get()
                                ->sum('amount');

        $data8 = $data6 - $data7;


        return view('backend.ledger.ledger-details',compact('data','data1','data2','data3','data4','data5','data8'));
    }
    public function genarate_company_ledger(Request $request)
    {
        $data = CompanyBalance::select('company_id')
                                ->groupBy('company_id')
                                ->where('company_id','like', '%'. $request->input('company_id').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get();

        $data1 = $request->input('from');
        $data2 = $request->input('to');

        $data3 = CompanyBalance::where('company_id','like', '%'. $request->input('company_id').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get();
        $data4 = CompanyBalance::where('type','Income')
                                ->where('company_id','like', '%'. $request->input('company_id').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get()
                                ->sum('amount');

        $data5 = CompanyBalance::where('type','Expense')
                                ->where('company_id','like', '%'. $request->input('company_id').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get()
                                ->sum('amount');

        $previousdate = Carbon::createFromDate($request->input('from'))->subDays();
        $data6 = CompanyBalance::where('type','Income')
                                ->where('company_id','like', '%'. $request->input('company_id').'%')
                                ->whereBetween('date',['2000-01-01',$previousdate])
                                ->get()
                                ->sum('amount');

        $data7 = CompanyBalance::where('type','Expense')
                                ->where('company_id','like', '%'. $request->input('company_id').'%')
                                ->whereBetween('date',['2000-01-01',$previousdate])
                                ->get()
                                ->sum('amount');

        $data8 = $data6 - $data7;


        return view('backend.ledger.company-ledger-details',compact('data','data1','data2','data3','data4','data5','data8'));
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
