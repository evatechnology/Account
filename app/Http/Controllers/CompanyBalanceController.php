<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CompanyBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyBalance = CompanyBalance::orderBy('id', 'desc')->get();
        $company = Company::get();
        return view('backend.company-blance.company-balance',compact('companyBalance','company'));
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
        $request->validate([
            'type' => 'required|max:191',
            'company_id' => 'required|max:191',
            'source' => 'required|max:191',
            'amount' => 'required|max:191',
            'date' => 'date|max:191',
        ]);
            $company = Company::find($request->input('company_id'));
            if(!$company ){
                return back();
            }
            $transactionAmount=0;
            $transactionAmount = $request->input('amount');

            DB::transaction(function () use ($company, $transactionAmount, $request){
                $input = $request->all();
                $input['company_id'] = $company->id;
                $input['amount'] = $transactionAmount;
                if($document = $request->hasFile('document')){
                    $document = $request->file('document');
                    $document_name = time().'.'.$document->getClientOriginalExtension();
                    $document->move(public_path().'/backend/image/companybalance/',$document_name);
                    $input['document'] = $document_name;
                }

                if($input['type']=='income'){
                    CompanyBalance::create($input);
                    $company->current_blance += $transactionAmount;
                    $company->save();
                    return redirect()->back()->with('success', 'Created successfully!');
                    exit;
                }
                elseif($input['type']=='expense'){
                    if($company->current_blance >= $transactionAmount){
                        CompanyBalance::create($input);
                        $company->current_blance -= $transactionAmount;
                        $company->save();
                        return redirect()->back()->with('success','Expense Added Successfully');
                        exit;
                    }
                    elseif($company->current_blance <= $transactionAmount){
                        DB::rollBack();
                        return redirect()->back()->with('error', 'Please Check Balance!');
                        exit;
                    }
                }
            });
            return redirect()->back();
            // return response()->json(['success'=>'Data Add successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyBalance  $companyBalance
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyBalance $companyBalance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyBalance  $companyBalance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companyBalance = CompanyBalance::find($id);
        return view('backend.company-blance.update', compact('companyBalance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyBalance  $companyBalance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }
    // public function cancel(Request $request)
    // {
    //     $companyBalance = CompanyBalance::find($request->company_id);
    //     $company = Company::find($request->company_id);
    //     $transactionAmount=0;
    //     $transactionAmount = $companyBalance->amount;
    //     if($companyBalance->type=='income'){
    //         $company->current_blance -= $transactionAmount;
    //         $company->save();
    //         return redirect()->back()->with('success', 'Created successfully!');
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyBalance  $companyBalance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companyBalance = CompanyBalance::find($id);
        if(!is_null($companyBalance)){

            if(!is_null($companyBalance->document)){
                $document_path = public_path().'/backend/image/companybalance/'.$companyBalance->document;
                unlink($document_path);
                $companyBalance->delete();
                return response()->json(['success'=>'Data Delete successfully.']);
            }
            else{
                $companyBalance->delete();
                return response()->json(['success'=>'Data Delete successfully.']);
            }

        }
    }
}
