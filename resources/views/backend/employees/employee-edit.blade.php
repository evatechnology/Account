@extends('backend.layout.master')
@section('title','Employee')
@section('content')
    <div class="card">
        <div class="card-body" id="details">
            <div class="row mt-4">
                <div class="col-sm-8">
                    <form class="forms-sample" action="{{ url('employees-update/'.$employees->id) }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}


                        <div class="form-group">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" value="{{ $employees->name }}" name="name" class="form-control" placeholder="John doe"/>
                        </div>
                        <div class="form-group">
                            <label>Email<small class="text-danger">*</small></label>
                            <input type="text" value="{{ $employees->email }}" name="email" class="form-control"placeholder=" hello@someting.com"/>
                        </div>
                        <div class="form-group">
                            <label>Phone Number<small class="text-danger">*</small></label>
                            <input type="text" value="{{ $employees->phone }}" name="phone" class="form-control" placeholder="Phone Number"/>
                        </div>
                        <div class="form-group">
                            <label>Address<small class="text-danger">*</small></label>
                            <input type="text" value="{{ $employees->address }}" name="address" class="form-control" placeholder="123, South Mugda New York, 1214"/>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" id="sel1" name="gender">
                                <option value="{{ $employees->gender }}" selected>{{ $employees->gender }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Company List</label>
                            <select class="form-control" id="sel1" value="{{ $employees->company_id }}" name="company_id">
                                <option value="{{ $employees->company_id }}" selected>{{ $employees->companyname->name }}</option>
                                @foreach (App\Models\Company::get() as $item )
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Position<small class="text-danger">*</small></label>
                            <input type="text"value="{{ $employees->position}}" name="position" class="form-control" placeholder="Assistant Manager"/>
                        </div>
                        <div class="form-group">
                            <label>Salary<small class="text-danger">*</small></label>
                            <input type="text" value="{{ $employees->salary}}" name="salary" class="form-control" placeholder="250000.00"/>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn  btn-outline-primary mr-2">Submit</button>
                            <a type="button" href="{{ route('employees') }}" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</a>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <div class="text-center">
                     <img src="{{ asset('/backend/image/employee/'.$employees->image) }}" style="width: 300px; height: 300px" class="img-fluid" alt="">
                    </div>
                 </div>
            </div>

    </div>


@endsection
