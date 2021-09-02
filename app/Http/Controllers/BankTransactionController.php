<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bankname;
use App\Models\BankTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankTransaction = BankTransaction::orderBy('id', 'desc')->get();
        return view('backend.bank-transection.bank_transection',compact('bankTransaction'));
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
            'account_number' => 'required|max:191',
            // 'transection_id' => 'required|max:191',
            'ref' => 'required|max:191',
            'transection_id' => 'string|max:191',
            'reason' => 'required|max:191',
            'amount' => 'required|max:191',
            'type' => 'required|max:191',
            'date' => 'date|max:191',
        ]);
        $bank = Bank::find($request->input('account_number'));
        if(!$bank){
            return back();
        }
        $transactionamount = 0;
        $transactionamount = $request->input('amount');

        DB::transaction(function () use ($bank, $transactionamount, $request){
                $input = $request->all();
                $input['account_number'] = $bank->id;
                $input['amount'] = $transactionamount;
                if($document = $request->hasFile('document')){
                    $document = $request->file('document');
                    $document_name = time().'.'.$document->getClientOriginalExtension();
                    $document->move(public_path().'/backend/image/banktransection/',$document_name);
                    $input['document'] = $document_name;
                }
                if($input['type']=='credit'){
                    BankTransaction::create($input);
                    $bank->balance += $transactionamount;
                    $bank->save();
                    return redirect()->back()->with('success', 'Amount Successfull Add In Your Account');
                    exit;

                    // exit;
                }
                elseif($input['type']=='debit'){
                    if($bank->balance >= $transactionamount){
                        BankTransaction::create($input);
                        $bank->balance -= $transactionamount;
                        $bank->save();
                        return redirect()->back()->with('success','Expense Added Successfully');
                        exit;
                    }
                    elseif($bank->balance <= $transactionamount){
                        //DB::rollBack();
                        return redirect()->back()->with('error', 'Please Check Balance!');
                        exit;
                    }
                }


        });
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankTransaction = BankTransaction::find($id);
        if(!is_null($bankTransaction)){

            if(!is_null($bankTransaction->document)){
                $document_path = public_path().'/backend/image/banktransection/'.$bankTransaction->document;
                unlink($document_path);
                $bankTransaction->delete();
                return response()->json(['success'=>'Data Delete successfully.']);
            }
            else{
                $bankTransaction->delete();
                return response()->json(['success'=>'Data Delete successfully.']);
            }

        }
    }
}


