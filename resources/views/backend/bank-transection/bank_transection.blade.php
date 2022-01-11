@extends('backend.layout.master')
@section('title', 'AMS || Bank Transaction')
@section('content')

<div>
    <section class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Bank Transaction</h4>

                    <div class="default-tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">New Transaction</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile">Transaction History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#message">Balance Summery</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                <div class="pt-4">
                                    <form class="form-group" id="BankTransactionForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <table class="table table-borderless " id="table_field">
                                            <thead>
                                                <tr>
                                                    <th>Bank Name</th>
                                                    <th>Voucher Type</th>
                                                    <th>Cheque/Receipt Number</th>
                                                    <th>Account Head</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    {{-- <th>Document (Optional)</th> --}}
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" id="account_number_" name="account_number[]">
                                                                <option selected disabled>Choose One</option>
                                                                @foreach ($bank as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->bank_name }} ===> {{ $item->account_number }}</option>
                                                                @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control" id="type" name="type[]">
                                                            <option selected disabled>Choose One</option>
                                                            <option value="Debit">Debit</option>
                                                            <option value="Credit">Credit</option>
                                                            <option value="Pending">Pending</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="ref[]" class="form-control" />
                                                    </td>
                                                    <td>
                                                        <input type="text" name="reason[]" class="form-control" />
                                                    </td>
                                                    <td>
                                                        <input type="date" name="date[]" class="form-control" />
                                                    </td>
                                                    <td>
                                                        <input type="text" name="amount[]" id="amount" class="form-control" required>
                                                    </td>
                                                    {{-- <td>
                                                        <input type="file" name="document[]" id="document">
                                                    </td> --}}
                                                    <td>
                                                        <button type="button" class="btn btn-sm" style="background-color: #3a86ff;color:#FFF" id="add1"><i class="fas fa-plus"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="float-right">
                                            <button type="submit" class="btn  btn-sm btn-primary mr-2">Submit</button>
                                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="profile">
                                <div class="pt-4">

                                    <div class="card">
                                        <h4 class="text-center mt-3 mb-3"><u>Filter</u></h4>
                                        <div class="card-body">
                                            <div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Account Number</label>
                                                            <div class="col-sm-8">
                                                            <div id="account_number"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Type</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" id="type__">
                                                                    <option value="">All Type</option>
                                                                    <option value="Debit">Debit</option>
                                                                    <option value="Credit">Credit</option>
                                                                    <option value="Pending">Pending</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Account Head</label>
                                                            <div class="col-sm-8">
                                                                <div id="source"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">From</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="min" name="min" placeholder="mm/dd/yyyy">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">To</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="max" name="max" placeholder="mm/dd/yyyy">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <h4 class="text-center mt-3 mb-3"><u>Bank Transaction List</u></h4>
                                        <div class="card-body">
                                            <div class="float-right">
                                                <a type="button" href="#" class="btn   btn-outline-success mb-5 btn-sm" data-toggle="modal"
                                                    data-target="#BankTransactionAddModal">
                                                    <i class="mdi mdi-plus-circle"></i>New Transaction
                                                </a>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="BankTransaction_transection" class=" table display" style="min-width: 845px">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Bank Name</th>
                                                            <th>Account Number</th>
                                                            <th>Account Head</th>
                                                            <th>Referance/Cheque No</th>
                                                            <th>Date</th>
                                                            <th>Voucher Type</th>
                                                            <th>Amount</th>
                                                            {{-- <th>Action</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        @foreach ($bankTransaction as $item)
                                                            <tr id="editcompanybalance{{ $item->id }}">
                                                                <td>{{ ++$i }}</td>
                                                                <td>{{ $item->bank->bank_name }}</td>
                                                                <td>{{ $item->bank->account_number }}</td>
                                                                <td>{{ $item->reason }}</td>
                                                                <td>{{ $item->ref }}</td>
                                                                <td>{{ $item->date }}</td>
                                                                <td>
                                                                    @if ($item->type == 'Credit')
                                                                        <div class="font-weight-bold" style="color: #00AF91">Credit</div>
                                                                    @elseif( $item->type == 'Debit')
                                                                        <div class="font-weight-bold" style="color: #F05454">Debit</div>
                                                                    @elseif( $item->type == 'Pending')
                                                                        <div class="font-weight-bold text-info">Pending</div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->type == 'Credit')
                                                                        <div class="font-weight-bold" style="color: #00AF91">+{{ number_format($item->amount,2) }}</div>
                                                                    @elseif( $item->type == 'Debit')
                                                                        <div class="font-weight-bold" style="color: #F05454">-{{ number_format($item->amount,2) }}</div>
                                                                    @elseif( $item->type == 'Pending')
                                                                        <div class="font-weight-bold text-info">{{ number_format($item->amount,2) }}</div>
                                                                    @endif
                                                                </td>
                                                                {{-- <td>
                                                                    <a type="button" class="btn btn-outline-danger btn-sm deletebtn" href="javascript:void(0);"
                                                                                data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </td> --}}
                                                            </tr>

                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Bank Name</th>
                                                            <th>Account Number</th>
                                                            <th>Account Head</th>
                                                            <th>Referance/Cheque No</th>
                                                            <th>Date</th>
                                                            <th>Voucher Type</th>
                                                            <th>Amount</th>
                                                            {{-- <th>Action</th> --}}
                                                        </tr>
                                                    </tfoot>


                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="message">
                                <div class="pt-4 row">
                                    @foreach ($bank as $item)
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
                                                        <a type="button" class="btn btn-outline-warning btn-sm" href="javascript:void(0);" onclick="editBank({{ $item->id }})"><i class="fas fa-pencil-alt"></i></a>
                                                        <a type="button" class="btn btn-outline-danger btn-sm deletebtn" href="javascript:void(0);" data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        var html1 = '<tr>'+
                    '    <td>'+
                    '        <select class="form-control" id="account_number_" name="account_number[]">'+
                    '            <option selected disabled>Choose One</option>'+
                    '            @foreach (App\Models\Bank::get() as $item)'+
                    '                <option value="{{ $item->id }}">{{ $item->bank_name }} ===> {{ $item->account_number }}</option>'+
                    '            @endforeach'+
                    '        </select>'+
                    '    </td>'+
                    '    <td>'+
                    '        <select class="form-control" id="type" name="type[]">'+
                    '            <option selected disabled>Choose One</option>'+
                    '            <option value="Debit">Debit</option>'+
                    '            <option value="Credit">Credit</option>'+
                    '            <option value="Pending">Pending</option>'+
                    '        </select>'+
                    '    </td>'+
                    '    <td>'+
                    '        <input type="text" name="ref[]" class="form-control" />'+
                    '    </td>'+
                    '    <td>'+
                    '        <input type="text" name="reason[]" class="form-control" />'+
                    '    </td>'+
                    '    <td>'+
                    '        <input type="date" name="date[]" class="form-control" />'+
                    '    </td>'+
                    '    <td>'+
                    '        <input type="text" name="amount[]" id="amount" class="form-control" required>'+
                    '    </td>'+
                    '    <td>'+
                    '        <button name="remove" class="btn btn-danger btn-sm" id="remove"><i class="fas fa-eraser"></i> </button>'+
                    '    </td>'+
                    '</tr>';

        var x = 1;
        $("#add1").click(function() {
            $("#table_field").append(html1);
        });
        $("#table_field").on('click', '#remove', function() {
            $(this).closest('tr').remove();
        });
    });
</script>


    <script>
            $('#BankTransactionForm').on('submit', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var myformData = new FormData($('#BankTransactionForm')[0]);
                $.ajax({
                    type: "post",
                    url: "/admin/bank/transaction/add",
                    data: myformData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $("#BankTransactionForm").find('input').val('');
                        // $('#companybalanceAddModal').modal('hide');
                        Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1800
                });
                        location.reload();
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
                    url: "/admin/bank/transaction/delete/" + id,
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Successful',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        location.reload();
                        console.log(data);
                    },
                    error: function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'Error',
                            title: 'Data Not Deleted',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        console.log('Error:', data);
                    }
                });
            }
        });
    </script>



{{-- Datatable Value Filter --}}
    <script>

        $(document).ready(function() {
            //Date Filter Start
            var minDate, maxDate;
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = minDate.val();
                    var max = maxDate.val();
                    var date = new Date( data[5] );
                    if (
                        ( min === null && max === null ) || ( min === null && max >= date ) || ( min <= date   && max === null ) || ( min <= date   && max >= date )
                    ) {
                        return true;
                    }
                    return false;
                }
            );
            minDate = new DateTime($('#min'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });

           var table= $('#BankTransaction_transection').DataTable({

                initComplete: function() {
                    //Drop Down Account Number
                    var column = this.api().column(2);
                    var select = $('<select class="form-control"><option value="">All Account</option></select>')
                        .appendTo($('#account_number').empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });

                    //Drop Down Perticuler
                    var column1 = this.api().column(3);
                    var select1 = $('<select class="form-control"><option value="">All Company</option></select>')
                        .appendTo($('#source').empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column1.search(val ? '^' + val + '$' : '', true, false).draw();
                        }) ;
                        column1.data().unique().sort().each(function(d, j) {
                            select1.append('<option value="' + d + '">' + d + '</option>');
                        });
                }

            });
            //Drop Down Filter3 Pre-Define Value
            $('#type__').on('change', function () {
                table.columns(6).search( this.value ).draw();
            });
            //Date Filter
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });

    </script>

@endsection
