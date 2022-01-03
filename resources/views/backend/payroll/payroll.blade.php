@extends('backend.layout.master')
@section('title','AMS || Payroll')
@section('content')

<div class="card">
    <div class="card-body">
        <div><h2 class="text-center">Payroll Management System</h2></div>
    </div>
</div>

<section>
    <div class="row">
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-salary-tab" data-toggle="pill" href="#v-pills-salary" role="tab" aria-controls="v-pills-salary" aria-selected="true">Salary Management</a>
                        <a class="nav-link" id="v-pills-allowances-tab" data-toggle="pill" href="#v-pills-allowances" role="tab" aria-controls="v-pills-allowances" aria-selected="false">Allowances Management</a>
                        <a class="nav-link" id="v-pills-advance-tab" data-toggle="pill" href="#v-pills-advance" role="tab" aria-controls="v-pills-advance" aria-selected="false">Loan / Advance</a>
                        <a class="nav-link" id="v-pills-report-tab" data-toggle="pill" href="#v-pills-report" role="tab" aria-controls="v-pills-report" aria-selected="false">Report</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="v-pills-tabContent">

                        {{-- Salary --}}
                        <div class="tab-pane fade show active" id="v-pills-salary" role="tabpanel" aria-labelledby="v-pills-salary-tab">


                            <h4 class="text-center pb-5">Salary Management</h4>

                            <table class="table salary_table">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Employee Name</th>
                                        <th>Designation</th>
                                        <th>Join Date</th>
                                        <th>Basic</th>
                                        <th>Yearly Gross Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (App\Models\Employee::where('status',1)->get() as $item)
                                        <tr id="salary{{ $item->id }}">
                                            <td></td>
                                            <td>{{ $item->full_name }}</td>
                                            <td>{{ $item->position->position_name }}</td>
                                            <td>{{ $item->join_date }}</td>
                                            <td>{{ number_format($item->salary,2) }}</td>
                                            <td>{{ number_format($item->yearly_increment,2) }}</td>
                                            <td>
                                                <a type="button" class="btn btn-outline-danger btn-sm" href="javascript:void(0);" onclick="editsalary({{ $item->id }})"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                                {{-- Data Edit Model Start --}}
                                <div class="modal fade" id="BankEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                                                <form class="forms-sample" id="BankEditForm">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id">
                                                    <div class="form-group">
                                                        <label>Bank Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Bank Name"
                                                            />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Account Number<small class="text-danger">*</small></label>
                                                        <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Account Number"/>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label>Balance<small class="text-danger">*</small></label>
                                                        <input type="text" name="balance" id="balance" class="form-control" placeholder="Account Number"/>
                                                    </div> --}}
                                                    <div class="float-right">
                                                        <button type="submit" class="btn  btn-sm btn-gradient-primary mr-2">Submit</button>
                                                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Data Edit Modal End --}}
                        </div>

                        {{-- Allowances --}}
                        <div class="tab-pane fade" id="v-pills-allowances" role="tabpanel" aria-labelledby="v-pills-allowances-tab">


                            <h4 class="text-center">Allowances Management</h4>


                        </div>

                        <div class="tab-pane fade" id="v-pills-advance" role="tabpanel" aria-labelledby="v-pills-advance-tab">


                            <h4 class="text-center">Loan / Advance</h4>


                        </div>

                        <div class="tab-pane fade" id="v-pills-report" role="tabpanel" aria-labelledby="v-pills-report-tab">
Report
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var table = $('.salary_table').DataTable({
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    //debugger;
                    var index = iDisplayIndexFull + 1;
                    $("td:first", nRow).html(index);
                    return nRow;
                },
    });

</script>


<script>
    function editsalary(id){
        $.get("/admin/payroll/salary/edit/"+id, function(salary){
            $('#id').val(salary.id);
            $('#bank_name').val(salary.full_name);
            $('#account_number').val(salary.balance);
            // $('#balance').val(bank.balance);
            $('#SaEditModal').modal("toggle");
        });
    }
</script>
@endsection
