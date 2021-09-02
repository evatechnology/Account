@extends('backend.layout.master')
@section('title','Company Trasection Update')
@section('content')
<div class="card">
    <div class="card-body">
        <form class="forms-sample" id="companybalanceForm" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}

            <div class="form-group">
                <label for="exampleFormControlSelect1">Type<small class="text-danger">*</small></label>
                <select class="form-control"id="type" name="type">
                    <option selected disabled>Choose One</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Company</label>
                <select class="form-control"id="company_id" name="company_id">
                    <option selected disabled>Choose One</option>
                    @foreach (App\Models\Company::get() as $item )
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Source<small class="text-danger">*</small></label>
                <input type="text" name="source" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Amount<small class="text-danger">*</small></label>
                <input type="text" name="amount" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Document<small class="text-danger">(Optional)</small></label>
                <br>
                <input type="file" name="document"/>
            </div>
            <div class="float-right">
                <button type="submit" class="btn  btn-sm btn-gradient-primary mr-2">Submit</button>
                <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection
