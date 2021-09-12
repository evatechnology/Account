<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bankname;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Connection;

class BankController extends Controller
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
        $bank = Bank::get();
        return view('backend.bank.bank',compact('bank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $validator = Validator::make($request->all(),[
            'bank_name' => 'required|max:191',
            'account_number' => 'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else{
            $bank = new Bank;
            $bank->bank_name = $request->bank_name;
            $bank->account_number = $request->account_number;
            $bank->balance = $request->balance;
            $bank->save();
            return response()->json(['success'=>'Data Add successfully.']);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);
        return response()->json($bank);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $bank = Bank::find($request->id);
        $bank->bank_name = $request->bank_name;
        $bank->account_number = $request->account_number;
        // $bank->balance = $request->balance;
        $bank->update();
        return response()->json($bank);
        // return redirect()->route('bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        return response()->json(['success'=>'Data Delete successfully.']);
    }
}
