@extends('backend.layout.master')
@section('title','Employee')
@section('content')
    <div class="card">
        <div class="card-body" id="details">
            <div>
                <div class="text-center">
                 <img src="{{ asset('/backend/image/employee/image/'.$employees->image) }}" style="width: 200px; height: 200px" class="img-fluid shadow rounded-circle" alt="">
                </div>
             </div>


                    <form class="forms-sample" action="{{ url('employees-update/'.$employees->id) }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" value="{{ $employees->full_name }}" name="full_name" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6"></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number 1<small class="text-danger">*</small></label>
                                <input type="text" name="phone_1" value="{{ $employees->phone_1 }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number 2<small class="text-danger">(optional)</small></label>
                                <input type="text" name="phone_2" value="{{ $employees->phone_2 }}"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email<small class="text-danger">*</small></label>
                                <input type="text" name="email" class="form-control" value="{{ $employees->email }}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NID<small class="text-danger">*</small></label>
                                <input type="text" name="nid" value="{{ $employees->nid }}" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Present Address<small class="text-danger">*</small></label>
                                <textarea name="address_present"  value="{{ $employees->address_present }}" class="form-control" >{{ $employees->address_present }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Permanent Address<small class="text-danger">*</small></label>
                                <textarea name="address_permanent" class="form-control" value="{{ $employees->address_permanent }}">{{ $employees->address_permanent }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Education<small class="text-danger">*</small></label>
                                <textarea  name="education" class="form-control summernote" value="{{ $employees->education }}">{{ $employees->education }}</textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" id="sel1" name="gender">
                                    <option value="{{ $employees->gender }}" selected>{{ $employees->gender }}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="sel1" name="status">
                                    <option value="{{ $employees->status }}" selected>
                                        @if ($employees->status == 1)
                                            Active
                                        @else
                                            Deactive
                                        @endif
                                    </option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" id="sel1" name="position_id">
                                    <option value="{{ $employees->position_id }}" selected>{{ $employees->position->position_name }}</option>
                                    @foreach (App\Models\Position::get() as $item )
                                        <option value="{{ $item->id }}">{{ $item->position_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Salary<small class="text-danger">*</small></label>
                                <input type="text" value="{{ $employees->salary}}" name="salary" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" >
                                <label>Date Of Birth<small class="text-danger">*</small></label>
                                <input type="date" value="{{ $employees->dob}}" name="dob" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" >
                                <label>Join Date<small class="text-danger">*</small></label>
                                <input type="date" value="{{ $employees->join_date}}" name="join_date" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nid">NID Copy</label>
                                <input type="file" name="nid_copy" class="form-control ">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cv">CV</label>
                                <input type="file" name="cv" class="form-control ">
                            </div>
                        </div>

                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn  btn-outline-primary mr-2">Submit</button>
                        <a type="button" href="{{ route('employees') }}" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</a>
                    </div>
                    </form>




    </div>

<script>
    $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
</script>
@endsection
