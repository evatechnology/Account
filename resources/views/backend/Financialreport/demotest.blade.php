@extends('backend.layout.master')
@section('title', 'Bank Ledger')
@section('content')


<form action="/search">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" name="account_number" id="account_number">
                <option selected disabled>Choose One Account</option>
            @foreach (App\Models\BankTransaction::select('account_number')->groupBy('account_number')->get() as $item)
                <option value="{{ $item->account_number }}">{{ $item->bank->account_number }}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">From Date</label>
        <input type="date" class="form-control" name="from"id="exampleFormControlInput1" placeholder="name@example.com">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">To Email address</label>
        <input type="date" class="form-control" name="to" id="exampleFormControlInput1" placeholder="name@example.com">
      </div>


      <button type="submit"  class="btn btn-dark" >Dark</button>

</form>

@endsection
