@extends('backend.layout.master')
@section('title','Payroll')
@section('content')


    <div class="card">
        <div class="card-body">
            <div class="float-right">
                <a type="button" href="#" class="btn  btn-outline-success mb-1 btn-sm" data-toggle="modal"
                    data-target="#PayrollAddModal">
                    <i class="mdi mdi-plus-circle"></i>Payroll
                </a>
            </div>
            <table class="payroll table display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        {{-- <th>Company Name</th> --}}
                        <th>Position</th>
                        <th>Reason</th>
                        <th>Amount</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($payroll as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->employee->name }}</td>
                            <td>{{ $item->employee->email }}</td>
                            <td>{{ $item->employee->phone }}</td>
                            {{-- <td>{{ $item->company->name }}</td> --}}
                            <td>{{ $item->position->name }}</td>
                            <td>{{ $item->reason }}</td>
                            <td>{{ number_format($item->bonous,2) }}</td>
                            {{-- <td>

                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        {{-- <th>Company Name</th> --}}
                        <th>Position</th>
                        <th>Reason</th>
                        <th>Amount</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>




{{-- Data add Model Start --}}
<div class="modal fade" id="PayrollAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                    <form class="forms-sample" method="POST" id="BankForm" >
                        @csrf
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}
                        <div class="form-group">
                            <label>Company Name</label>
                            <select class="form-control" id="company_id" name="company_id">
                                <option selected disabled>Please Select Company</option>
                                @foreach ($company as $item )
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="position">Position:</label>
                            <select name="position_id" id="position_id" class="form-control">
                                <option selected disabled>Please Select Company First</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="employee_id">Employee Name:</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                <option selected disabled>Please Select Position First</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Company Name</label>
                            <select class="form-control" id="reason" name="reason">
                                <option selected disabled>Please Select Reason</option>
                                <option  value="Travel Allowance">Travel Allowance</option>
                                <option  value="Mobile Allowance">Mobile Allowance</option>
                                <option  value="Salary Gross">Salary Gross</option>
                            </select>
                        </div>

                        <div class="form-group" >
                            <label>Amount</label>
                            <input type="text" name="bonous" class="form-control" placeholder="250000.00"/>
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
    var table = $('.payroll').DataTable({
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    //debugger;
                    var index = iDisplayIndexFull + 1;
                    $("td:first", nRow).html(index);
                    return nRow;
                },
    });

</script>


<script>
$('#company_id').change(function() {

var companyID = $(this).val();

if (companyID) {
    //console.log(companyID);
    $.ajax({
        type: "GET",
        url: "/admin/payroll/position/" + companyID,
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
    $("#employee_id").empty();
}
});

$('#position_id').on('change', function() {

var positionID = $(this).val();
// console.log(positionID);
if (positionID) {

    $.ajax({
        type: "GET",
        url: "/admin/payroll/employee/" + positionID,
        success: function(res) {
            // console.log(res);
            if (res) {
                $("#employee_id").empty();
                $("#employee_id").append('<option>Select Employee</option>');
                $.each(res, function(key, value) {
                    $("#employee_id").append('<option value="' + value.id + '">' + value.name +
                        '</option>');

                });

            } else {

                $("#employee_id").empty();
            }
        }
    });
} else {

    $("#employee_id").empty();
}
});
</script>
@endsection
