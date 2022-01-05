@extends('backend.layout.master')
@section('title','AMS || Salary Sheet')
@section('content')

<div class="card">
    <div class="card-body">
        <h2 class="text-center">Generate New Salary Sheet</h2>

        <div class=" mt-5">

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Month</label>
                        <select class="form-control month" id="month">
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
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Year</label>
                        <input type="number" id="year" class="form-control" required>
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
                        <th colspan="2" class="text-center">Attendance Details</th>
                        <th rowspan="2">Arear Salary</th>
                        <th colspan="2" class="text-center">Deduction</th>
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
                        {{-- <th>Absent</th> --}}
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
                                <td style="white-space: nowrap;">
                                    <div style="display:none"><input type="text" value="{{ $item->id }}" name="employee_id[]" class="form-control border-0"></div>
                                    {{ $item->full_name }}
                                </td>
                                <td>
                                    <div style="display:none"><input type="text" value="{{ $item->position_id }}" name="position_id[]" class="form-control border-0"></div>
                                    {{ $item->position->position_name }}</td>
                                <td style="white-space: nowrap;">{{ $item->join_date }}</td>
                                <td>
                                    {{ number_format($item->salary,2) }}
                                    <div style="display:none"><input type="text" value="{{ $item->salary }}" name="basic[]" class="form-control border-0"></div>
                                </td>
                                <td>{{ number_format($house_rent,2) }}</td>
                                <td>{{ number_format($medical,2) }}</td>
                                <td>
                                    {{ number_format($item->yearly_increment,2) }}
                                    <div style="display:none"><input type="text" value="{{ $item->yearly_increment }}" name="yearly_increment[]" class="form-control border-0"></div>
                                </td>
                                <td>{{ number_format($gross_salary,2) }}</td>
                                <td><input type="number" id="working_day" value="0" min="0" name="working_day[]" class="form-control working_day" readonly></td>
                                <td><input type="number" id="present_day" value="0" min="0" name="present[]" class="form-control present_day" required></td>
                                <td><input type="number" id="leave_day" value="0" min="0" name="leave[]" class="form-control leave_day" required></td>
                                {{-- <td><input type="number" id="absent_day" value="0" min="0" name="absent[]" class="form-control absent_day" required></td> --}}
                                <td>-</td>
                                {{-- <td><input type="number" id="absent_salary" value="0" min="0" class="form-control"></td> --}}
                                <td><input type="number" id="advance" name='advance' value="0" min="0" class="form-control" ></td>
                                <td>-</td>
                                <td>-</td>
                                {{-- <td><input type="number" id="total" value="0" min="0" class="form-control border-0" readonly></td>
                                <td><input type="number" id="net_paid" value="0" min="0" class="form-control border-0" readonly></td> --}}
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
<script>
    $(document).ready(function() {
            $(".month").change(function(){
                var month = $(this).val();
                if(month == "January" || month == "March" || month == "May" || month == "July" || month == "August" ||month == "October" ||month == "December"){
                    $('.working_day').val('31');
                }
                else if(month == "February"){
                    $('.working_day').val('29');
                }
                else if(month == "April" || month == "June" || month == "September" || month == "November"){
                    $('.working_day').val('30');
                }
                else{
                    $('.working_day').val('0');
                }
        });
    });
    // $(document).ready(function() {
    //         // $('.present_day, .leave_day, .working_day').keyup(function(){
    //         //     var value1 = parseInt($('.present_day').val()) || 0;
    //         //     var value2 = parseInt($('.leave_day').val()) || 0;
    //         //     var value3 = parseInt($('.working_day').val()) || 0;
    //         //     var absend_day = 0;
    //         //     $('.absent_day').each(function(){

    //         //          absend_day = value3 - (value1 + value2);
    //         //         // $('.absent_day').val(value3 - (value1 + value2));
    //         //     });
    //         //     console.log(absend_day);
    //         //     $('.absent_day').val(absend_day);
    //         // //    $('.absent_day').val(value3 - (value1 + value2));

    //         // });
    //             $('.absent_day').each(function(){
    //                 var value1 = parseInt($('.present_day').val()) || 0;
    //                 var value2 = parseInt($('.leave_day').val()) || 0;
    //                 var value3 = parseInt($('.working_day').val()) || 0;
    //                 // absend_day = value3 - (value1 + value2);
    //                 $('.absent_day').val(value3 - (value1 + value2));
    //             });
    //      });
</script>
@endsection
