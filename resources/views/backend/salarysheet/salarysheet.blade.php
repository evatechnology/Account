@extends('backend.layout.master')
@section('title','AMS || Salary Sheet')
@section('content')

<div class="card">
    <div class="card-body">
        <h2 class="text-center">Generate New Salary Sheet</h2>

        <div class=" mt-5">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Month</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>Choose One </option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered salary_table">
                <thead>
                    <tr>
                        <th rowspan="2"><span class="my-auto">Sl. No.</span></th>
                        <th rowspan="2" style="white-space: nowrap;">Employee Name</th>
                        <th colspan="2" class="text-center">Employee Details</th>
                        <th colspan="5" class="text-center">Salary</th>
                        <th></th>
                        <th colspan="3" class="text-center">Attendance Details</th>
                        <th rowspan="2">Arear Salary</th>
                        <th colspan="5" class="text-center">Deduction</th>
                        <th style="white-space: nowrap;" rowspan="2">Net Paid</th>
                        <th style="white-space: nowrap;" rowspan="2">Receivers Signature</th>

                    </tr>
                    <tr>
                        <th>Designation</th>
                        <th>Joining Date</th>
                        <th>Basic</th>
                        <th>House Rent</th>
                        <th>Medical</th>
                        <th>Yearly Increment</th>
                        <th>Gross Salary</th>
                        <th>Working Day</th>
                        <th>Present</th>
                        <th>Leave</th>
                        <th>Absent</th>
                        <th>Absent Salary</th>
                        <th>Advance</th>
                        <th>Advance Leave</th>
                        <th>Stamp</th>
                        <th>Total</th>
                    </tr>

                    <tbody>
                        @foreach (App\Models\Employee::get() as $item)
                            <tr>
                                @php
                                    $i=0;
                                    $house_rent = 0;
                                    $medical = 0;
                                    $house_rent = ($item->salary)/2;
                                    $medical = ($item->salary)/6;
                                    $gross_salary = ($item->salary) + $house_rent + $medical + ($item->yearly_increment);
                                @endphp
                                <td></td>
                                <td style="white-space: nowrap;">{{ $item->full_name }}</td>
                                <td>{{ $item->position->position_name }}</td>
                                <td style="white-space: nowrap;">{{ $item->join_date }}</td>
                                <td>{{ number_format($item->salary,2) }}</td>
                                <td>{{ number_format($house_rent,2) }}</td>
                                <td>{{ number_format($medical,2) }}</td>
                                <td>{{ number_format($item->yearly_increment,2) }}</td>
                                <td>{{ number_format($gross_salary,2) }}</td>
                                <td><input type="number" id="working_day" value="0" class="form-control" required></td>
                                <td><input type="number" id="present_day" value="0" class="form-control" required></td>
                                <td><input type="number" id="leave_day" value="0" class="form-control" required></td>
                                <td><input type="number" id="absent_day" value="0" class="form-control" required></td>
                                <td>-</td>
                                <td><input type="number" id="absent_salary" value="0" class="form-control" required></td>
                                <td><input type="number" id="advance" value="0" class="form-control" required></td>
                                <td>-</td>
                                <td>-</td>
                                <td><input type="number" id="total" value="0" class="form-control border-0" readonly></td>
                                <td><input type="number" id="net_paid" value="0" class="form-control border-0" readonly></td>
                                <td></td>
                            </tr>
                        @endforeach

                    </tbody>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>
<script>
    var table = $('.salary_table').DataTable({
        "searching": false,
        "paging":   false,
        "info":     false,
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    //debugger;
                    var index = iDisplayIndexFull + 1;
                    $("td:first", nRow).html(index);
                    return nRow;
                },
    });

</script>
@endsection
