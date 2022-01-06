<?php

namespace App\Http\Controllers;

use App\Models\SalarySheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalarySheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.salarysheet.salarysheet');
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
        for($i=0;$i<count($request->basic);$i++){
            $salarySheet = new SalarySheet;
            $salarySheet->month = $request->month;
            $salarySheet->year = $request->year;
            $salarySheet->sheet_name = ($request->month)."-".($request->year).'('.Carbon::now()->format('d-m-Y').')';
            $salarySheet->employee_id = $request->employee_id[$i];
            $salarySheet->position_id = $request->position_id[$i];
            $salarySheet->basic = $request->basic[$i];
            $salarySheet->yearly_increment = $request->yearly_increment[$i];
            $salarySheet->working_day = $request->working_day[$i];
            $salarySheet->present = $request->present[$i];
            $salarySheet->absent = $request->working_day[$i]- ($request->present[$i] + $request->leave[$i]);
            $salarySheet->leave = $request->leave[$i];
            $salarySheet->advance = $request->advance[$i];
            $salarySheet->save();
        }
        return response()->json(['success'=>'Data Add successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalarySheet  $salarySheet
     * @return \Illuminate\Http\Response
     */
    public function sheetlistview()
    {
        $salarySheet = SalarySheet::select('sheet_name','month','year')
                                    ->groupByRaw('sheet_name , month, year')
                                    ->get();
        return view('backend.salarysheet.salarysheet-listview',compact('salarySheet'));
    }
    public function show($sheet_name)
    {
        $salarySheet = SalarySheet::find($sheet_name);

        $salarysheetname = SalarySheet::select('sheet_name','month','year')
                                    ->where('sheet_name', $sheet_name)
                                    ->groupByRaw('sheet_name , month, year')
                                    ->get();

        $monthly_salary_details = SalarySheet::where('sheet_name', $sheet_name)->get();
        return view('backend.salarysheet.detailsview',compact('salarySheet','monthly_salary_details','salarysheetname'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalarySheet  $salarySheet
     * @return \Illuminate\Http\Response
     */
    public function edit(SalarySheet $salarySheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalarySheet  $salarySheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalarySheet $salarySheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalarySheet  $salarySheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalarySheet $salarySheet)
    {
        //
    }
}
