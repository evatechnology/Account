@extends('backend.layout.master')
@section('title','Company')
@section('content')
    <div class="card">
        <div class="card-body" id="details">
            <div class="row mt-4">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <form class="forms-sample" action="{{ url('company-update/'.$company->id) }}" id="companyForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}

                        <div class="form-group">
                            <label>Client Name<span class="text-danger"></span></label>
                            <input type="text" value="{{ $company->name }}" name="name" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Email<small class="text-danger"></small></label>
                            <input type="text" value="{{ $company->email }}" name="email" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Phone<small class="text-danger"></small></label>
                            <input type="text" value="{{ $company->phone_no }}" name="phone_no" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Web Site<span class="text-danger"></span></label>
                            <input type="text" value="{{ $company->website }}" name="website" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label>Work Order Amount<span class="text-danger"></span></label>
                            <input type="text" value="{{ $company->work_order }}" name="work_order" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label>Work Start Date<small class="text-danger">*</small></label>
                            <input type="date" value="{{ $company->start_date }}" name="start_date" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label>Work End Date<small class="text-danger">*</small></label>
                            <input type="date" value="{{ $company->end_date }}" name="end_date" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label>Status<small class="text-danger">*</small></label>
                            <select name="status" class="form-control" id="status">
                                <option selected value="{{ $company->status }}">{{ $company->status }}</option>
                                <option value="progress">Progress</option>
                                <option value="Complete">Complete</option>
                            </select>
                        </div>
                        {{-- <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"> Remember me </label>
                </div> --}}
                        <div class="float-right">

                            <button type="button" class="btn btn-sm btn-light">Back</button>
                            <button type="submit" class="btn  btn-outline-primary mr-2">Update</button>
                        </div>
                    </form>
                </div>

            </div>

    </div>


@endsection
