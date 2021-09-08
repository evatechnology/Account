@extends('backend.layout.master')
@section('title','Bank Account')
@section('content')

<section>
    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="text-center mt-3 mb-1"><u>Bank List</u></h4>
            <div class="text-right">
                <a type="button" href="#" class="btn  btn-outline-success mb-2 btn-sm" data-toggle="modal"
                    data-target="#BankAddModal">
                    <i class="mdi mdi-plus-circle"></i>Add Bank Account
                </a>
            </div>
        </div>
    </div>
    <div class="row">

@foreach ($bank as $item )
<div class="col-sm-4">
    <div class="card shadow-lg" id="bank-card">
        <div class="card-body">
            <h4 class="text-light text-center">{{ $item->bank_name }}</h4>
            <hr class="text-light">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="text-light text-center">Account Number</h6>
                    <h5 class="text-light text-center">{{ $item->account_number }} </h5>
                </div>
                <div class="col-sm-6">
                    <h6 class="text-light text-center">Current Balance</h6>
                    <h4 class="text-light text-center">{{ $item->balance }}<small>&nbsp;tk</small></h4>
                </div>
            </div>
            <hr class="text-light">
            <div class="row">
                <div class="col-sm-8"><small class="text-light">Last update {{ $item->updated_at->diffForHumans() }}</small></div>
                <div class="col-sm-4">
                    <a type="button" class="btn btn-outline-warning btn-sm" href="{{ route('bank.edit', $item->id) }}"><i class="fas fa-pencil-alt"></i></a>
                    <a type="button" class="btn btn-outline-danger btn-sm deletebtn" href="javascript:void(0);" data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach



    </div>
</section>

<div class="card" style="display: none">
    <h4 class="text-center mt-3 mb-1"><u>Bank List</u></h4>
    <div class="card-body">
        <div class="float-right">
            <a type="button" href="#" class="btn  btn-outline-success mb-2 btn-sm" data-toggle="modal"
                data-target="#BankAddModal">
                <i class="mdi mdi-plus-circle"></i>Add Bank Account
            </a>
        </div>
        <div class="table-responsive">
            <table id="example" class=" table display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach ($bank as $item )
                        <tr id="bank{{ $item->id }}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->bank_name }}</td>
                            <td>{{ $item->account_number }}</td>
                            <td>{{ $item->balance }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h fa-lg"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('bank.edit', $item->id) }}"><i class="fas fa-pencil-alt text-warning"></i> Edit</a>
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
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                </tfoot>


            </table>

        </div>

    </div>
</div>







{{-- Data add Model Start --}}
<div class="modal fade" id="BankAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3 class="modal-title" id="exampleModalLabel">Add Bank Details</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="BankForm_errorlist"></ul>
                    <form class="forms-sample" id="BankForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}

                        {{-- <div class="form-group">
                            <label>Bank Name<span class="text-danger">*</span></label>
                            <input type="text" name="bank_name" class="form-control" placeholder="Bank Name"
                                  />
                        </div> --}}

                        <div class="form-group">
                            <label>Bank Name<small class="text-danger">*</small></label>
                            <input type="text" name="bank_name" class="form-control" placeholder="Bank name"/>
                        </div>
                        <div class="form-group">
                            <label>Account Number<small class="text-danger">*</small></label>
                            <input type="text" name="account_number" class="form-control" placeholder="Account Number"/>
                        </div>
                        <div class="form-group" style="display:none">
                            <label>Balance<small class="text-danger">(Optional)</small></label>
                            <input type="text" name="balance" value="0" class="form-control" placeholder="Balance"/>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn  btn-sm btn-gradient-primary mr-2">Submit</button>
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
{{-- Data Add Modal End --}}










    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });

        $('#BankForm').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var myformData = new FormData($('#BankForm')[0]);
            $.ajax({
                type: "post",
                url: "{{ route('bank-add') }}",
                data: myformData,
                cache: false,
                //enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.status == 400){
                        $('#BankForm_errorlist').html("");
                        $.each(response.errors, function (key, err_values) {
                            $("#BankForm_errorlist").append('<li class="text-danger">'+err_values+'</li>');
                        });
                    }else{

                    $("#BankForm").find('input').val('');
                    $('#BankAddModal').modal('hide');
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
                    url: "/admin/bank/delete/" + id,
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
