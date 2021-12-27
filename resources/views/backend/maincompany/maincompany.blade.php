@extends('backend.layout.master')
@section('title','Main Company')
@section('content')
<div class="card">
    @if (App\Models\MainCompany::get()->count() == 0)
        <h4 class="text-center mt-3 mb-3"><u>Register Main Company</u></h4>
        <div class="card-body">
            <form class="forms-sample" id="maincompanyForm" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Name<span class="text-danger">*</span></label>
                            <input type="text" name="companyname" class="form-control" placeholder="Company Name"/>
                        </div>
                    </div>

                    <div class="col-md-6"></div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email<small class="text-danger">*</small></label>
                            <input type="text" name="email" class="form-control" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number<small class="text-danger">*</small></label>
                            <input type="text" name="phone_no" class="form-control" placeholder="+880125456565"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Web Link<span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">http://</div>
                                </div>
                                <input type="text" name="website" class="form-control" placeholder="Web Link"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Logo<small class="text-danger">*</small></label>
                            <input type="file" name="logo" class="form-control border-0"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foundation Date<small class="text-danger">*</small></label>
                            <input type="date" name="foundation_date" class="form-control" placeholder="+880171********"/>
                        </div>
                    </div>

                    <div class="col-md-6"></div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Trad Licence<small class="text-danger">*</small></label>
                            <input type="text" name="trade_licence" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Registration No<small class="text-danger">*</small></label>
                            <input type="text" name="reg_no" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Head Office<small class="text-danger">*</small></label>
                            <textarea id="summernote" name="headoffice_address" class="form-control summernote"></textarea>
                            {{-- <input type="text" name="reg_no" class="form-control"/> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Office<small class="text-danger">*</small></label>
                            <textarea id="summernote" name="siteoffice_address" class="form-control summernote"></textarea>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn  btn-sm btn-primary mr-2">Save</button>
                </div>
            </form>
        </div>
    @else
        <div class="card-body">
            @foreach (App\Models\MainCompany::get() as $item)
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <img src="{{ asset('/backend/image/company/'.$item->logo) }}" class="img-fluid" style="width: 100px; height: 100px" alt="">
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <h1 class="text-center pt-5"><u>{{ $item->companyname }}</u></h1>
                        </div>

                        <div class="col-md-12">
                            <table class="table display table-borderless mt-5">
                                <tbody>
                                    <tr>
                                        <td class="h4">Phone No:</td>
                                        <td>{{ $item->phone_no }}</td>
                                    </tr>
                                    <tr>
                                        <td class="h4">Email:</td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="h4">Web Site:</td>
                                        <td>{{ $item->website }}</td>
                                    </tr>
                                    <tr>
                                        <td class="h4">Current Balance:</td>
                                        <td>{{ $item->balance }}</td>
                                    </tr>
                                    <tr>
                                        <td class="h4">Foundation Date:</td>
                                        <td>{{ $item->foundation_date }}</td>
                                    </tr>
                                    <tr>
                                        <td class="h4">Trade Licence:</td>
                                        <td>{{ $item->trade_licence }}</td>
                                    </tr>
                                    <tr>
                                        <td class="h4">Registration Number:</td>
                                        <td>{{ $item->reg_no }}</td>
                                    </tr>
                                    <tr>
                                        <td class="h4">Head Office Address:</td>
                                        <td>{!! $item->headoffice_address !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="h4">Site Office Address:</td>
                                        <td>{!! $item->siteoffice_address !!}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            focus: true
        });
    });
</script>
<script>
    $('#maincompanyForm').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var myformData = new FormData($('#maincompanyForm')[0]);
            $.ajax({
                type: "post",
                url: "{{ route('maincompany-add') }}",
                data: myformData,
                cache: false,
                //enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.status == 400){
                        $('#companyForm_errorlist').html("");
                        $.each(response.errors, function (key, err_values) {
                            $("#companyForm_errorlist").append('<li class="text-danger">'+err_values+'</li>');
                        });
                    }else{

                    $("#maincompanyForm").find('input').val('');
                    // $('#companyAddModal').modal('hide');
                    location.reload();
                    }

                },
                error: function(error) {
                    console.log(error);
                    alert("Data Not Save");
                }
            });
        });
</script>
@endsection
