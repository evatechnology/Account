@extends('backend.layout.master')
@section('title','Employee')
@section('content')
<div class="card">
    <h4 class="text-center mt-3 mb-3"><u>Employee List</u></h4>
    <div class="card-body">
        <div class="float-right">
            <a type="button" href="#" class="btn   btn-outline-success mb-5 btn-sm" data-toggle="modal"
                data-target="#employeeAddModal">
                <i class="mdi mdi-plus-circle"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table id="example" class=" table display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company Name</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach ($employees as $item )
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->companyname->name }}</td>
                            <td>{{ $item->position->name }}</td>
                            <td>{{ $item->salary }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h fa-lg"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('employee.details', $item->id) }}"><i class="fas fa-eye text-primary"></i> View</a>
                                        <a class="dropdown-item" href="{{ route('employee.edit', $item->id) }}"><i class="fas fa-pencil-alt text-warning"></i> Edit</a>
                                        <a class="dropdown-item deletebtn" href="javascript:void(0);" data-id="{{ $item->id }}"><i class="fas fa-trash-alt text-danger"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company Name</th>
                        <th>Position Name</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                </tfoot>


            </table>

        </div>

    </div>
</div>

    {{-- Data add Model Start --}}
    <div class="modal fade" id="employeeAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3 class="modal-title" id="exampleModalLabel">Employee Registration</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="Form_errorlist"></ul>
                    <form class="forms-sample" id="employeeForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}


                        <div class="form-group">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="John doe"/>
                        </div>
                        <div class="form-group">
                            <label>Email<small class="text-danger">*</small></label>
                            <input type="text" name="email" class="form-control"placeholder=" hello@someting.com"/>
                        </div>
                        <div class="form-group">
                            <label>Phone Number<small class="text-danger">*</small></label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number"/>
                        </div>
                        <div class="form-group">
                            <label>Address<small class="text-danger">*</small></label>
                            <input type="text" name="address" class="form-control" placeholder="123, South Mugda New York, 1214"/>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" id="sel1" name="gender">
                                <option selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Company List</label>
                            <select class="form-control" id="company_id" name="company_id">
                                <option selected disabled>Please Select Company</option>
                                @foreach ($company as $item )
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="position">Position: </label>
                            <select name="position_id" id="position_id" class="form-control">
                                <option selected disabled>Please Select Company First</option>
                            </select>
                        </div>

                        <div class="form-group" >
                            <label>Salary<small class="text-danger">*</small></label>
                            <input type="text" name="salary" class="form-control" placeholder="250000.00"/>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>


                        {{-- <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input"> Remember me </label>
                </div> --}}
                        <div class="float-right">
                            <button type="submit" class="btn  btn-sm btn-primary mr-2">Submit</button>
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Data Add Modal End --}}
    <script>
        // when country dropdown changes
        $('#company_id').change(function() {

            var companyID = $(this).val();

            if (companyID) {
                //console.log(companyID);
                $.ajax({
                    type: "GET",
                    url: "/admin/employees/position/" + companyID,
                    success: function(res) {
                        //console.log(res);
                        if (res) {

                            $("#position_id").empty();
                            $("#position_id").append('<option>Select Position</option>');
                            $.each(res, function(key, value) {
                                $("#position_id").append('<option value="' + value.id + '">' + value.name +
                                    '</option>');
                                    //console.log(value);
                            });

                        } else {

                            $("#position_id").empty();
                        }
                    }
                });
            } else {

                $("#position_id").empty();
            }
        });

    </script>

    <script>
        var table = $('#example').DataTable();
        $('#employeeForm').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var myformData = new FormData($('#employeeForm')[0]);
            $.ajax({
                type: "post",
                url: "{{ route('employee-add') }}",
                data: myformData,
                cache: false,
                //enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.status == 400){
                        $('#Form_errorlist').html("");
                        $.each(response.errors, function (key, err_values) {
                            $("#Form_errorlist").append('<li class="text-danger">'+err_values+'</li>');
                        });
                    }else{

                    $("#employeeForm").find('input').val('');
                    $('#employeeAddModal').modal('hide');
                    location.reload();
                    }

                },
                error: function(error) {
                    // $('#employeeAddModal').modal('hide');
                    // location.reload();
                    console.log(error);
                    alert("Data Save");
                }
            });
        });

        $('body').on('click', '.deletebtn', function() {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/employees/delete/" + id,
                    data: {
                        "id": id,
                        "_token": token,
                        },
                    success: function(data) {
                        location.reload();
                        console.log(data);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
                }
        });
    </script>
@endsection
