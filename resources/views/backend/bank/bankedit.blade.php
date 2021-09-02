@extends('backend.layout.master')
@section('title','Bank Account')
@section('content')
    <div class="card">
        <div class="card-body" id="details">
            <div class="row mt-4">
                <div class="col-sm-8">
                    <form class="forms-sample" action="{{ url('/admin/bank/edit/'.$bank->id) }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Bank Name</label>
                            <select class="form-control" id="bank_name" name="bank_name">
                                <option  value="{{ $bank->bank_name }}" selected >{{ $bank->bank->bank_name }}</option>
                                @foreach (App\Models\Bankname::get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->bank_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Account Number<small class="text-danger">*</small></label>
                            <input type="text" value="{{ $bank->account_number }}" name="account_number"  class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Account Number<small class="text-danger">*</small></label>
                            <input type="text" value="{{ $bank->balance }} " name="balance"  class="form-control" />
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn  btn-outline-primary mr-2">Submit</button>
                            <a type="button" href="{{ route('bank') }}" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

    </div>


@endsection


