@extends('backend.layout.master')
@section('title','AMS || Receivable')
@section('content')

<div class="card">
    <h4 class="text-center mt-3 mb-3"><u>Payable Amount</u></h4>
    <div class="card-body" >
        <div>
            <table id="payable_table" class="table" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Referance/Cheque No</th>
                        <th>Account Head</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\BankTransaction::where('type','Pending')->get() as $item )
                            <tr id="bank_transaction{{ $item->id }}">
                                <td></td>
                                <td>{{ $item->bank->bank_name }}</td>
                                <td>{{ $item->bank->account_number }}</td>
                                <td>{{ $item->ref }}</td>
                                <td>{{ $item->reason }}</td>
                                <td>{{ date('d/M/Y',strtotime($item->date)) }}</td>
                                <td class="text-right">{{ number_format($item->amount,2)}}</td>
                                <td>{{ $item->type }}</td>
                                <td><a class="btn btn-sm btn-outline-secondary" href="javascript:void(0);" onclick="edit_bank_transaction({{ $item->id }})"><i class="fas fa-pencil-alt"></i></a></td>
                            </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Referance/Cheque No</th>
                        <th>Account Head</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>


            </table>
        </div>
    </div>
</div>



    {{-- Data Edit Model Start --}}
    <div class="modal fade" id="BankTransEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3 class="modal-title" id="exampleModalLabel">Edit Bank Details</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="BankForm_errorlist"></ul>
                    <form class="forms-sample" id="BankTransEditForm">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Amount<span class="text-danger">*</span></label>
                            <input type="text" name="amount" id="amount" class="form-control" readonly/>
                        </div>
                        <div class="form-group" style="display: none">
                            <label>Account_number<span class="text-danger">*</span></label>
                            <input type="text" name="account_number" id="account_number" class="form-control" readonly/>
                        </div>
                        <div class="form-group">
                            <label>Account Number<small class="text-danger">*</small></label>
                            <select name="type" id="type" class="form-control">
                                <option value="Credit">Credit</option>
                                <option value="Debit">Debit</option>
                                <option value="Pending" disabled>Pending</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label>Balance<small class="text-danger">*</small></label>
                            <input type="text" name="balance" id="balance" class="form-control" placeholder="Account Number"/>
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
    {{-- Data Edit Modal End --}}


<script>
    var table = $('#payable_table').DataTable({
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			// debugger;
			var index = iDisplayIndexFull + 1;
			$("td:first", nRow).html(index);
			return nRow;
		},
        });
</script>

<script>
    function edit_bank_transaction(id){
        $.get("/admin/bank/transaction/edit/"+id, function(bank_trans){
            $('#id').val(bank_trans.id);
            $('#amount').val(bank_trans.amount);
            $('#account_number').val(bank_trans.account_number);
            $('#type').val(bank_trans.type);
            // $('#balance').val(bank.balance);
            $('#BankTransEditModal').modal("toggle");
        });
    }

    $('#BankTransEditForm').submit(function (e) {
        e.preventDefault();

        let id = $('#id').val();
        let amount = $('#amount').val();
        let account_number = $('#account_number').val();
        let type = $('#type').val();
        let _token = $('input[name=_token]').val();

        $.ajax({
            type: "PUT",
            url: "/admin/bank/transaction/update",
            data: {
                id:id,
                amount:amount,
                account_number:account_number,
                type:type,
                _token:_token,
            },
            dataType: "json",
            success: function (response) {
                $('#bank_transaction'+response.id + 'td:nth-child(1)').text(response.amount);
                $('#bank_transaction'+response.id + 'td:nth-child(2)').text(response.account_number);
                $('#bank_transaction'+response.id + 'td:nth-child(3)').text(response.type);
                $('#BankTransEditModal').modal("toggle");
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your Change Done',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1800
                });
                location.reload();
                $('#BankTransEditForm')[0].reset();

            },
            error: function(error) {
                console.log(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });

    });
</script>
@endsection
