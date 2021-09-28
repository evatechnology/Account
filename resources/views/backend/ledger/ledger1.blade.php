@extends('backend.layout.master')
@section('title','Bank Statement')
@section('content')

<section>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="/admin/ledger/details">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1" class="text-dark">Account Number</label>
                            <select class="form-control border border-primary" name="account_number" id="account_number">
                                    <option selected disabled>Choose Account number</option>
                                @foreach (App\Models\BankTransaction::select('account_number')->groupBy('account_number')->get() as $item)
                                    <option value="{{ $item->account_number }}">{{ $item->bank->bank_name }} ====> {{ $item->bank->account_number }}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="form-group ">
                            <label for="datepicker" class="text-dark">From Date</label>
                            <input type="text" class="form-control border border-primary" name="from" id="from">
                          </div>
                          <div class="form-group">
                            <label for="datepicker" class="text-dark">To Date</label>
                            <input type="text" class="form-control border border-primary" name="to" id="to">
                          </div>


                          <div class="text-right">
                            <button type="submit"  class="btn btn-dark" >Report</button>
                          </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
