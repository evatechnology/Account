<?php

namespace App\Http\Controllers;

use App\Models\ClientCompany;

use App\Models\CompanyBalance;
use App\Models\MainCompany;
use Illuminate\Http\Request;


class CompanyBalanceController extends Controller
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
        $companyBalance = CompanyBalance::orderBy('id', 'desc')->get();
        $company = ClientCompany::get();
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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required|max:191',
    //         'company_id' => 'required|max:191',
    //         'source' => 'required|max:191',
    //         'amount' => 'required|max:191',
    //         'date' => 'max:191',
    //     ]);
    //         for($i=0;$i<count($request->type);$i++){
    //             $company = Company::find($request->company_id[$i]);
    //             if(!$company ){
    //                 return back();
    //             }
    //             $transactionAmount=0;
    //             $transactionAmount = $request->amount[$i];

    //             DB::transaction(function () use ($company,$i, $transactionAmount, $request){
    //                 $input = $request->all();
    //                 $input['company_id[$i]'] = $company->id;
    //                 $input['amount[$i]'] = $transactionAmount;
    //                 if($document = $request->hasFile('document[$i]')){
    //                     $document = $request->file('document[$i]');
    //                     $document_name = time().'.'.$document->getClientOriginalExtension();
    //                     $document->move(public_path().'/backend/image/companybalance/',$document_name);
    //                     $input['document[$i]'] = $document_name;
    //                 }

    //                 if($input['type']=='Income'){
    //                     CompanyBalance::create($input);
    //                     $company->current_blance[$i] += $transactionAmount;
    //                     $company->save();
    //                     return redirect()->back()->with('success', 'Created successfully!');
    //                     exit;
    //                 }
    //                 elseif($input['type']=='Expense'){
    //                     if($company->current_blance[$i] >= $transactionAmount){
    //                         CompanyBalance::create($input);
    //                         $company->current_blance[$i] -= $transactionAmount;
    //                         $company->save();
    //                         return redirect()->back()->with('success','Expense Added Successfully');
    //                         exit;
    //                     }
    //                     elseif($company->current_blance[$i] <= $transactionAmount){
    //                         DB::rollBack();
    //                         return redirect()->back()->with('error', 'Please Check Balance!');
    //                         exit;
    //                     }
    //                 }
    //             });
    //             return redirect()->back();
    //         }
    //         // return response()->json(['success'=>'Data Add successfully.']);
    // }


    public function store(Request $request){
        $this->validate($request, [
                    'type' => 'required|max:191',
                    'company_id' => 'required|max:191',
                    'account_head' => 'required|max:191',
                    'amount' => 'required|max:191',
                    'date' => 'max:191',
                ]);

                // $documents=[];
                // if($request->hasFile('document1')){
                //     foreach($request->file('document1') as $file){
                //         $document_name = time().rand(1,100).'.'.$file->extension();
                //         $file->move(public_path().'/backend/image/companybalance/',$document_name);
                //         $documents[] = $document_name;
                //     }

                // }
                // $maincompany = MainCompany::select('id')->get();
                for($i=0;$i<count($request->type);$i++){
                    $company = ClientCompany::find($request->company_id[$i]);
                        if(!$company ){
                            return back();
                        }
                        $maincompany = MainCompany::find($request->maincompany_id[$i]);
                        $companyBalance = new CompanyBalance;
                        $companyBalance->company_id = $company->id;
                        $companyBalance->maincompany_id = $maincompany->id;
                        $companyBalance->amount = abs($request->amount[$i]);
                        $companyBalance->account_head = $request->account_head[$i];
                        $companyBalance->type = $request->type[$i];
                        $companyBalance->date = $request->date[$i];
                        // $documents=[];
                        // if($document = $request->hasFile('document1')){
                        //     $document = $request->file('document1');
                        //     $document_npame = time().'.'.$document->getClientOriginalExtension();
                        //     $document->move(public_path().'/backend/image/companybalance/',$document_name);
                        //     $documents[] = $document_name;
                        //     $companyBalance->document = json_encode($documents[$i]);
                        // }

                        // $documents=[];
                        // if($request->hasFile('document1')){
                        //         $documents = $request->file('document1') ;
                        //         $document_name = time().rand(1,100).'.'.$documents->extension();
                        //         $documents->move(public_path().'/backend/image/companybalance/',$document_name);
                        //         $documents = $document_name;
                        //         $companyBalance->document = $document_name;


                        // }

                        // $companyBalance->document = json_encode($documents[$i]);
                        if($request->type[$i]=='Income'){
                            // $company->temp_balance =$request->balance;
                            $company->received_payment += abs($request->amount[$i]);
                            // $companyBalance->temp_balance = $company->current_blance;
                            $maincompany->balance += abs($request->amount[$i]);
                            $company->update();
                            $companyBalance->save();
                             $maincompany->save();

                            // return redirect()->back()->with('success', 'Created successfully!');

                        }
                        if($request->type[$i]=='Expense'){
                            $company->spending += abs($request->amount[$i]);
                            // $companyBalance->temp_balance = $company->current_blance;
                            $maincompany->balance -= abs($request->amount[$i]);
                            $company->save();
                            $companyBalance->save();
                            $maincompany->save();
                            // return redirect()->back()->with('success', 'Created successfully!');

                        }



                }
                return response()->json(['success'=>'Data Add successfully.']);
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
