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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $bankTransaction = BankTransaction::orderBy('id', 'desc')->get();
        $bank = Bank::get();
        return view('backend.bank-transection.bank_transection',compact('bankTransaction','bank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bankaccount($id)
    {
        $account_number = Bank::find($id);
        return response()->json($account_number);
    }
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
    //         'account_number' => 'required|max:191',
    //         // 'transection_id' => 'required|max:191',
    //         'ref' => 'required|max:191',
    //         'transection_id' => 'string|max:191',
    //         'reason' => 'required|max:191',
    //         'amount' => 'required|max:191',
    //         'type' => 'required|max:191',
    //         'date' => 'date|max:191',
    //         'tempbalance' => 'max:191',
    //     ]);
    //     $bank = Bank::find($request->input('account_number'));
    //     if(!$bank){
    //         return back();
    //     }
    //     $transactionamount = 0;
    //     $transactionamount = $request->input('amount');

    //     DB::transaction(function () use ($bank, $transactionamount, $request){
    //             $bankTransaction=new BankTransaction;
    //             $bankTransaction->account_number = $bank->id;
    //             $bankTransaction->ref = $request->ref;
    //             $bankTransaction->transection_id = $request->transection_id;
    //             $bankTransaction->reason = $request->reason;
    //             $bankTransaction->amount = $transactionamount;;
    //             $bankTransaction->type = $request->type;
    //             $bankTransaction->date = $request->date;
    //             if($document = $request->hasFile('document')){
    //                 $document = $request->file('document');
    //                 $document_name = time().'.'.$document->getClientOriginalExtension();
    //                 $document->move(public_path().'/backend/image/banktransection/',$document_name);
    //                 $bankTransaction->document = $document_name;
    //             }
    //             if($bankTransaction->type =='Credit'){
    //                 $bank->balance += $transactionamount;
    //                 $bankTransaction->temp_balance =$bank->balance;

    //                 $bankTransaction->save();
    //                 $bank->save();
    //                 return redirect()->back()->with('success', 'Amount Successfull Add In Your Account');
    //                 exit;
    //             }
    //             elseif($bankTransaction->type=='Debit'){
    //                 if($bank->balance >= $transactionamount){
    //                     $bank->balance -= $transactionamount;
    //                     $bankTransaction->temp_balance =$bank->balance;

    //                 $bankTransaction->save();
    //                 $bank->save();
    //                     return redirect()->back()->with('success','Expense Added Successfully');
    //                     exit;
    //                 }
    //                 elseif($bank->balance <= $transactionamount){
    //                     DB::rollBack();
    //                     return redirect()->back()->with('error', 'Please Check Balance!');
    //                     exit;
    //                 }
    //             }


    //     });
    //     return redirect()->back();
    // }
public function store(Request $request){
    $request->validate([
                'account_number' => 'required|max:191',
                'ref' => 'required|max:191',
                'transection_id' => 'string|max:191',
                'reason' => 'required|max:191',
                'amount' => 'required|max:191',
                'type' => 'required|max:191',
                'date' => 'max:191',
            ]);

    for($i=0;$i<count($request->type);$i++){
        $bank = Bank::find($request->account_number[$i]);
        if(!$bank){
            return back();
        }
        $bankTransaction = new BankTransaction;
        $bankTransaction->account_number = $bank->id;
        $bankTransaction->ref = $request->ref[$i];
        // $bankTransaction->transection_id = $request->transection_id[$i];
        $bankTransaction->reason = $request->reason[$i];
        $bankTransaction->amount = $request->amount[$i];
        $bankTransaction->type = $request->type[$i];
        $bankTransaction->date = $request->date[$i];
        if($request->type[$i]=='Credit'){
            $bank->balance += abs($request->amount[$i]);
            $bank->update();
            $bankTransaction->save();

        }
        else if($request->type[$i]=='Debit'){
            $bank->balance -= abs($request->amount[$i]);
            $bank->update();
            $bankTransaction->save();

        }
        else if($request->type[$i]=='Pending'){
            $bank->balance += 0;
            $bank->update();
            $bankTransaction->save();

        }

        return response()->json(['success'=>'Data Add successfully.']);
    }
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
    public function destroy1($id,Request $request)
    {
        $bankTransaction = BankTransaction::find($id);

        if(!is_null($bankTransaction)){
            $bank = Bank::find($request->account_number);
            if(!$bank){
                return back();
            }
            $transactionamount = $bankTransaction->amount;
            if(!is_null($bankTransaction->document)){
                $document_path = public_path().'/backend/image/banktransection/'.$bankTransaction->document;
                unlink($document_path);
                $bankTransaction->delete();
                return response()->json(['success'=>'Data Delete successfully.']);
            }
            else{
                DB::transaction(function () use ($bank, $transactionamount,$request, $bankTransaction){
                    // $bankTransaction->account_number = $bank->id;
                    if($bankTransaction->type =='credit'){
                        $bank->balance = $bank->balance - $transactionamount;
                        // $bankTransaction->temp_balance =$bank->balance;
                        $bank->save();
                        $bankTransaction->delete();

                        return redirect()->back()->with('success', 'Amount Successfull Add In Your Account');
                        exit;
                    }
                });
                $bankTransaction->delete();
                return response()->json(['success'=>'Data Delete successfully.']);
            }

        }
    }
}


