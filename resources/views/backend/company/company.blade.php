@extends('backend.layout.master')
@section('title','Company')
@section('content')
<div class="card">
    <h4 class="text-center mt-3 mb-3"><u>Client List</u></h4>
    <div class="card-body">
        <div class="float-right">
            <a type="button" href="#" class="btn   btn-outline-success mb-5 btn-sm" data-toggle="modal"
                data-target="#companyAddModal">
                <i class="mdi mdi-plus-circle"></i> New Client
            </a>
        </div>
        <div>
            <table id="example" class="table table-responsive table-borderd border-0 table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Web Link</th>
                        <th>Work Order Amount</th>
                        <th>Received Amount</th>
                        <th>Pending Amount</th>
                        <th>Spend Amount</th>
                        <th>Profit/Loss</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach ($companies as $item )
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone_no }}</td>
                            <td>{{ $item->email }}</td>
                            <td><a href="http://{{ $item->website }}" target="_blank" rel="noopener noreferrer">{{ $item->website }}</a></td>
                            <td>{{ number_format($item->work_order,2)}}</td>
                            <td>{{ number_format($item->received_payment,2)}}</td>
                            <td>{{ number_format(($item->work_order)-($item->received_payment),2)}}</td>
                            <td>{{ number_format($item->spending,2)}}</td>
                            <td>{{ number_format(($item->received_payment)-($item->spending),2)}}</td>
                            <td>{{ $item->start_date}}</td>
                            <td>{{ $item->end_date}}</td>
                            <td>{{ $item->status}}</td>
                            {{-- <td>
                                <img class="img-fluid" src="{{ asset('/backend/image/company/'.$item->logo ) }}" style="width: 100px; height:100px">
                            </td> --}}
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h fa-lg"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('company.details', $item->id) }}"><i class="fas fa-eye text-primary"></i> View</a>
                                        <a class="dropdown-item" href="{{ route('company.edit', $item->id) }}"><i class="fas fa-pencil-alt text-warning"></i> Edit</a>
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
                        <th>Company Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Web Link</th>
                        <th>Work Order Amount</th>
                        <th>Received Amount</th>
                        <th>Pending Amount</th>
                        <th>Spend Amount</th>
                        <th>Profit/Loss</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>


            </table>

        </div>

    </div>
</div>


    {{-- Data add Model Start --}}
    <div class="modal fade bd-example-modal-lg" id="companyAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3 class="modal-title" id="exampleModalLabel">Add Client Company Details</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="companyForm_errorlist"></ul>
                    <form class="forms-sample" id="companyForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Company Name"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email<small class="text-danger">*</small></label>
                                    <input type="text" name="email" class="form-control" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number<small class="text-danger">*</small></label>
                                    <input type="phone" name="phone_no" class="form-control" placeholder="+880171********"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Work Order Amount<small class="text-danger">*</small></label>
                                    <input type="text" name="work_order" class="form-control" placeholder="1500000.00"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Work Start Date<small class="text-danger">*</small></label>
                                    <input type="date" name="start_date" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="image">Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div> --}}




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
    $(".modal").draggable({
  handle: ".modal-header"
});
</script>

    <script>
        var table = $('#example').DataTable({
        });
        $('#companyForm').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var myformData = new FormData($('#companyForm')[0]);
            $.ajax({
                type: "post",
                url: "{{ route('company-add') }}",
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

                    $("#companyForm").find('input').val('');
                    $('#companyAddModal').modal('hide');
                    location.reload();
                    }

                },
                error: function(error) {
                    console.log(error);
                    alert("Data Not Save");
                }
            });
        });

        $('body').on('click', '.deletebtn', function() {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/company/delete/" + id,
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
