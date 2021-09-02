@extends('backend.layout.master')
@section('title','Company')
@section('content')
    <div class="card">
        <div class="card-body" id="details">
            <div class="row mt-4">
                <div class="col-sm-8">
                    <form class="forms-sample" action="{{ url('company-update/'.$company->id) }}" id="companyForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}

                        <div class="form-group">
                            <label for="image">Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Company Name<span class="text-danger"></span></label>
                            <input type="text" value="{{ $company->name }}" name="name" class="form-control"
                                 required />
                        </div>
                        <div class="form-group">
                            <label>Email<small class="text-danger"></small></label>
                            <input type="text" value="{{ $company->email }}" name="email" class="form-control"
                                  />
                        </div>
                        <div class="form-group">
                            <label>Web Link<span class="text-danger"></span></label>
                            <input type="text" value="{{ $company->website }}" name="website" class="form-control"
                                 required />
                        </div>

                        {{-- <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"> Remember me </label>
                </div> --}}
                        <div class="float-right">
                            <button type="submit" class="btn  btn-outline-primary mr-2">Submit</button>
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                   <div class="text-center">
                    <img src="{{ asset('/backend/image/company/'.$company->logo) }}" style="width: 300px; height: 300px" class="img-fluid" alt="">
                   </div>
                </div>
            </div>

    </div>


@endsection
