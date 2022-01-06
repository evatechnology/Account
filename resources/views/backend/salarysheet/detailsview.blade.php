@extends('backend.layout.master')
@section('title','AMS || Salary Sheet')
@section('content')

    <div class="card">
        <div class="card-body " id="details">


            <div class="form-group row">
                <label  class="col-sm-2 col-form-label text-dark">Export Data</label>
                <div class="col-sm-10">
                    <div id='exp_buttons'></div>
                </div>
              </div>
            <div class="table-responsive">
                <table class="table-bordered display  monthly_salary_sheet nowrap">

                    <thead>
                        <tr>
                            <th class="text-center" colspan="21">
                                @foreach ( $salarysheetname as $salarysheetname )
                                    <h4>{{ $salarysheetname->sheet_name }}</h4>
                                    <h4>{{ $salarysheetname->month }}</h4>
                                    <h4>{{ $salarysheetname->year }}</h4>
                                @endforeach
                            </th>
                        </tr>
                        <tr>
                            <td rowspan="2">Sl.No. </td>
                            <th class="text-center" colspan="3">Employee Details </th>
                            <th class="text-center" colspan="5">Salary </th>
                            <th rowspan="2">Working Day</th>
                            <th class="text-center" colspan="3">Working Day</th>
                            <th rowspan="2">Area Salary</th>
                            <th class="text-center" colspan="5">Deduction </th>
                            <th rowspan="2">Net Paid</th>
                            <th rowspan="2">Receivers Signature</th>
                        </tr>
                        <tr>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Joining Date</th>
                            <th>Basic</th>
                            <th>House Rent</th>
                            <th>Medical</th>
                            <th>Yearly Increment</th>
                            <th>Gross Salary</th>
                            <th>Present</th>
                            <th>Leave</th>
                            <th>Absent</th>
                            <th>Absent Salary</th>
                            <th>Advance</th>
                            <th>Advance Leave</th>
                            <th>Stamp</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($monthly_salary_details as $item)
                            @php

                                $basic = $item->basic;
                                $yearly_increment = $item->yearly_increment;
                                $house_rent = $basic/2;
                                $medical = $basic/6;
                                $gross_salary = $basic + $yearly_increment + $house_rent + $medical;

                                $Working_day = $item->working_day;
                                $per_day_salary = $basic/$Working_day;
                                $leave_deduction = $per_day_salary * ($item->absent);
                                $advance_salary = $item->advance;
                                $total_deduction = $leave_deduction + $advance_salary;
                                $net_paid = $gross_salary - $total_deduction;
                            @endphp
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $item->employee->full_name }}</td>
                                <td>{{ $item->position->position_name }}</td>
                                <td>{{ $item->employee->join_date }}</td>
                                <td>{{ number_format(floor($basic),2) }}</td>
                                <td>{{ number_format(floor($house_rent),2) }}</td>
                                <td>{{ number_format(floor($medical),2) }}</td>
                                <td>{{ number_format(floor($yearly_increment),2) }}</td>
                                <td>{{ number_format(floor($gross_salary),2) }}</td>
                                <td>{{ $item->working_day }}</td>
                                <td>{{ $item->present }}</td>
                                <td>{{ $item->leave }}</td>
                                <td>{{ $item->absent }}</td>
                                <td>-</td>
                                <td>{{ number_format(floor($leave_deduction),2) }}</td>
                                <td>{{ number_format(floor($advance_salary),2) }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>{{ number_format(floor($total_deduction),2) }}</td>
                                <td>{{ number_format(floor($net_paid),2) }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
        var table = $('.monthly_salary_sheet').DataTable({
            "searching": false,
            "paging":   false,
            "info":     false,
                dom: 'Bfrtip',
                buttons: [
                    // {
                    // extend: 'csv',
                    // title: 'Report',
                    // text: '<i class="fas fa-file-csv"></i> <u>C</u>SV',
                    // className: 'btn btn-sm ',
                    // key: {
                    //     key: 'c',
                    //     altKey: true
                    //     },
                    // },
                    {
                    extend: 'excel',
                    text: '<i class="far fa-file-excel"></i> <u>E</u>xcel',
                    className: 'btn btn-sm ',
                    key: {
                        key: 'e',
                        altKey: true
                        },
                    },
                    {
                    extend: 'print',
                    title: '',
                    text: '<i class="fas fa-print"></i> <u>P</u>rint',
                    className: 'btn btn-sm ',
                    orientation: 'horizontal',
                    key: {
                        key: 'p',
                        altKey: true
                        },
                        customize: function ( win ) {
                                $(win.document.body).find( 'thead' ).prepend('<div class="header-print">' + $('#dt-header').val() + '</div>');
                            }

                    }
                ],
        });
        // table.buttons().container().appendTo($('#exp_buttons'));
    });

    </script>
@endsection
