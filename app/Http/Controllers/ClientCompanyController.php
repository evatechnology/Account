<?php

namespace App\Http\Controllers;

use App\Models\ClientCompany;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ClientCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = ClientCompany::get()->sortByDesc('id');
        return view('backend.company.company',compact('companies'));
    }

    public function account_receivable()
    {
        $companies = ClientCompany::get()->sortByDesc('id');
        return view('backend.receivable.receivable',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            // 'logo' => 'mimes:jpg,png|dimensions:min_width=100,min_height=010',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{
            $company = new ClientCompany;
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone_no = $request->phone_no;
            $company->website = $request->website;
            $company->work_order = $request->work_order;
            $company->start_date = $request->start_date;
            $company->received_payment = 0;
            $company->spending = 0;
            $company->status = "progress";
            // $company->received_payment = 0;
            // if($request->hasFile('logo')){
            //     $image = $request->file('logo');
            //     $image_name = time().'.'.$image->getClientOriginalExtension();
            //     $image->move(public_path().'/backend/image/company/',$image_name);
            //     $company->logo = $image_name;
            // }
            $company->save();
            return response()->json(['success'=>'Data Add successfully.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientCompany  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = ClientCompany::find($id);
        //$employees = Employee::groupBy('company_id')->selectRaw('count(*) as total, company_id')->get();
        return view('backend.company.company-details',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientCompany  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=ClientCompany::find($id);
        return view('backend.company.company-edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            // 'logo' => 'mimes:jpg,png|dimensions:min_width=100,min_height=010',
        ]);
            $company = ClientCompany::find($id);
            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->phone_no = $request->input('phone_no');
            $company->website = $request->input('website');
            $company->work_order = $request->input('work_order');
            $company->start_date = $request->input('start_date');
            $company->end_date = $request->input('end_date');
            $company->status = $request->input('status');
        //     if($request->hasFile('logo')){
        //         $destination = public_path().'/backend/image/company/'.$company->logo;
        //         if(File::exists($destination)){
        //             File::delete($destination);
        //         }
        //         $image = $request->file('logo');
        //         $image_name = time().'.'.$image->getClientOriginalExtension();
        //         $image->move(public_path().'/backend/image/company/',$image_name);
        //         $company->logo = $image_name;


        // }
         $company->update();
         $company = ClientCompany::all();
            return redirect()->route('company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientCompany  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = ClientCompany::find($id);
        if(!is_null($company)){

                $image_path = public_path().'/backend/image/company/'.$company->logo;
                unlink($image_path);
                $company->delete();
                return response()->json(['success'=>'Data Delete successfully.']);

        }

    }
}
