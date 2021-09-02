<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
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
        $companies = Company::get()->sortByDesc('id');
        return view('backend.company.company',compact('companies'));
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
            'logo' => 'mimes:jpg,png|dimensions:min_width=100,min_height=010',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{
            $company = new Company;
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/backend/image/company/',$image_name);
                $company->logo = $image_name;
            }
            $company->save();
            return response()->json(['success'=>'Data Add successfully.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        //$employees = Employee::groupBy('company_id')->selectRaw('count(*) as total, company_id')->get();
        return view('backend.company.company-details',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=Company::find($id);
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
            'logo' => 'mimes:jpg,png|dimensions:min_width=100,min_height=010',
        ]);
            $company = Company::find($id);
            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->website = $request->input('website');
            if($request->hasFile('logo')){
                $destination = public_path().'/backend/image/company/'.$company->logo;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $image = $request->file('logo');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/backend/image/company/',$image_name);
                $company->logo = $image_name;


        }
         $company->update();
         $company = Company::all();
            return redirect()->route('company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if(!is_null($company)){

                $image_path = public_path().'/backend/image/company/'.$company->logo;
                unlink($image_path);
                $company->delete();
                return response()->json(['success'=>'Data Delete successfully.']);

        }

    }
}
