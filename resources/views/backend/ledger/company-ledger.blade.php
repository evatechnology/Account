@extends('backend.layout.master')
@section('title','Company Ledger Book')
@section('content')

<section>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="/admin/company/ledger/details">
                        {{-- <div class="form-group">
                            <label for="exampleFormControlSelect1" class="text-dark">Client</label>
                            <select class="form-control border border-primary" name="company_id" id="company_id">
                                    <option selected disabled>Choose Account number</option>
                                @foreach (App\Models\CompanyBalance::select('company_id')->groupBy('company_id')->get() as $item)
                                    <option value="{{ $item->company_id }}">{{ $item->company->name }}</option>
                                @endforeach
                            </select>
                          </div> --}}

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
