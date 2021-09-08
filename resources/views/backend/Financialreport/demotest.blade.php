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
        <label for="datepicker">From Date</label>
        <input type="text" class="form-control datepicker" name="from" id="from">
      </div>
      <div class="form-group">
        <label for="datepicker">To Date</label>
        <input type="text" class="form-control datepicker" name="to" id="to">
      </div>


      <button type="submit"  class="btn btn-dark" >Dark</button>

</form>
<script>
$(document).ready(function () {
    minDate = new DateTime($('#from'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#to'), {
                format: 'YYYY-MM-DD'
            });
});
</script>
@endsection
