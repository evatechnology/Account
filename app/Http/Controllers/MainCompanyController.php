<?php

namespace App\Http\Controllers;

use App\Models\MainCompany;
use Illuminate\Http\Request;

class MainCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mainCompany = MainCompany::get();
        return view('backend.maincompany.maincompany');
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
            $company = new MainCompany;
            $company->id = 1;
            $company->companyname = $request->companyname;
            $company->email = $request->email;
            $company->phone_no = $request->phone_no;
            $company->website = $request->website;
            $company->foundation_date = $request->foundation_date;
            $company->trade_licence = $request->trade_licence;
            $company->reg_no = $request->reg_no;
            $company->headoffice_address = $request->headoffice_address;
            $company->siteoffice_address = $request->siteoffice_address;
            $company->balance = 0;
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/backend/image/company/',$image_name);
                $company->logo = $image_name;
            }
            $company->save();
            return response()->json(['success'=>'Data Add successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainCompany  $mainCompany
     * @return \Illuminate\Http\Response
     */
    public function show(MainCompany $mainCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainCompany  $mainCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(MainCompany $mainCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainCompany  $mainCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainCompany $mainCompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainCompany  $mainCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainCompany $mainCompany)
    {
        //
    }
}
