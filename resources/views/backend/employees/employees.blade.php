@extends('backend.layout.master')
@section('title','Employee')
@section('content')

<div class="card">
    <h4 class="text-center mt-3 mb-3"><u>Filter</u></h4>
    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Designation</label>
                        <div class="col-sm-8">
                          <div id="company"></div>
                        </div>
                      </div>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="type_filter">
                                <option value="">All Type</option>
                                <option value="Active">Active</option>
                                <option value="Deactive">Deactive</option>
                              </select>
                        </div>
                      </div>
                </div>

                {{-- <div class="col-sm-4">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">From</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="min" name="min" placeholder="yyyy-mm-dd">
                        </div>
                      </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">To</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="max" name="max" placeholder="yyyy-mm-dd">
                        </div>
                      </div>
                </div> --}}

            </div>

            <div id="buttons"></div>
        </div>
    </div>
</div>

<div class="card">
    <h4 class="text-center mt-3 mb-3"><u>Employee List</u></h4>
    <div class="card-body">
        <div class="text-center">
            <a type="button" href="#" class="btn   btn-outline-success mb-5 btn-sm" data-toggle="modal"
                data-target="#employeeAddModal">
                <i class="mdi mdi-plus-circle"></i> New Employee
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
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $item )
                        <tr>
                            <td></td>
                            <td>{{ $item->full_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone_1 }}</td>
                            <td>{{ $item->position->position_name }}</td>
                            <td>{{ number_format($item->salary,2) }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">Deactive</span>
                                @endif
                            </td>
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
                        <th>Position Name</th>
                        <th>Salary</th>
                        <th>Status</th>
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
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name<span class="text-danger">*</span></label>
                                    <input type="text" name="full_name" class="form-control" placeholder="John doe"/>
                                </div>
                            </div>
                            <div class="col-md-6"></div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number 1<small class="text-danger">*</small></label>
                                    <input type="text" name="phone_1" class="form-control" placeholder="Phone Number"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number 2<small class="text-danger">(optional)</small></label>
                                    <input type="text" name="phone_2" class="form-control" placeholder="Phone Number"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email<small class="text-danger">*</small></label>
                                    <input type="text" name="email" class="form-control"placeholder=" hello@someting.com"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NID<small class="text-danger">*</small></label>
                                    <input type="text" name="nid" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Present Address<small class="text-danger">*</small></label>
                                    <textarea name="address_present" class="form-control" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Permanent Address<small class="text-danger">*</small></label>
                                    <textarea name="address_permanent" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Education<small class="text-danger">*</small></label>
                                    <input type="text" name="education" class="form-control summernote"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" id="sel1" name="gender">
                                        <option selected disabled>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="position">Position: </label>
                                    <select name="position_id" id="position_id" class="form-control">
                                        <option selected disabled>Please Select One</option>
                                        @foreach (App\Models\Position::get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->position_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Salary<small class="text-danger">*</small></label>
                                    <input type="text" name="salary" class="form-control" placeholder="250000.00"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Date Of Birth<small class="text-danger">*</small></label>
                                    <input type="date" name="dob" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Join Date<small class="text-danger">*</small></label>
                                    <input type="date" name="join_date" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control ">
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

    <script>
        // DataTable filter
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    //debugger;
                    var index = iDisplayIndexFull + 1;
                    $("td:first", nRow).html(index);
                    return nRow;
                },
                initComplete: function() {
                    var column = this.api().column(4);
                    var select = $('<select class="form-control"><option value="">All Designation</option></select>')
                        .appendTo($('#company').empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                }
            });
                $('#type_filter').on('change', function () {
                table.columns(6).search( this.value ).draw();
            });
        });


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

    <script>

    </script>
@endsection
