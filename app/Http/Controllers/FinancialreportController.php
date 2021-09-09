<?php

namespace App\Http\Controllers;

use App\Models\BankTransaction;
use Illuminate\Http\Request;

class FinancialreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financialreport = BankTransaction::get();
        return view('backend.Financialreport.financialreport', compact('financialreport'));
    }
    public function search()
    {

        $data = BankTransaction::get();
        return view('backend.Financialreport.demotest',compact('data'));

    }
    public function search1(Request $request)
    {

        $data1 = BankTransaction::select('account_number')
                                  ->groupBy('account_number')
                                  ->where('account_number','like', '%'. $request->input('account_number').'%')
                                  ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                  ->get();

        $data = BankTransaction::where('type','credit')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get();

        $data3 = BankTransaction::where('type','credit')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get()
                                ->sum('amount');

        $data2 = BankTransaction::where('type','debit')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get();

        $data4 = BankTransaction::where('type','debit')
                                ->where('account_number','like', '%'. $request->input('account_number').'%')
                                ->whereBetween('date',[$request->input('from'),$request->input('to')])
                                ->get()
                                ->sum('amount');

        $data7= $request->input('from');
        $data8= $request->input('to');

        return view('backend.Financialreport.detailsreport',compact('data','data1','data2', 'data3','data4','data7','data8'));

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
