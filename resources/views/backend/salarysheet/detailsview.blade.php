@extends('backend.layout.master')
@section('title','AMS || Salary Sheet')
@section('content')

    <div class="card">
        <div class="card-body">

            <div id="monthly_salary_details">
                    <h2 class="text-center mt-5 text-primary">OSL-KNS GROUP</h2>
                    @foreach ( $salarysheetname as $salarysheetname )
                        <h4 class="text-center">{{ $salarysheetname->sheet_name }}</h4>
                        <h4 class="text-center">{{ $salarysheetname->month }} {{ $salarysheetname->year }}</h4>
                    @endforeach
                <table class="table-bordered table table-sm mt-4 monthly_salary" >
                    <thead >

                        <tr>
                            <th rowspan="2" class="text-primary">Sl. No. </th>
                            <th class="text-center text-primary" colspan="3">Employee Details </th>
                            <th class="text-center text-primary" colspan="5">Salary </th>
                            <th rowspan="2" class="text-primary">Working Day</th>
                            <th class="text-center text-primary" colspan="3">Working Day</th>
                            <th rowspan="2" class="text-primary">Area Salary</th>
                            <th class="text-center text-primary" colspan="5">Deduction </th>
                            <th rowspan="2"class="text-primary">Net Paid</th>
                            <th rowspan="2"class="text-primary" style="white-space: nowrap">Receivers Signature</th>
                        </tr>
                        <tr>
                            <th class="text-primary">Employee Name</th>
                            <th class="text-primary">Designation</th>
                            <th class="text-primary">Joining Date</th>
                            <th class="text-primary">Basic</th>
                            <th class="text-primary">House Rent</th>
                            <th class="text-primary">Medical</th>
                            <th class="text-primary">Yearly Increment</th>
                            <th class="text-primary">Gross Salary</th>
                            <th class="text-primary">Present</th>
                            <th class="text-primary">Leave</th>
                            <th class="text-primary">Absent</th>
                            <th class="text-primary">Absent Salary</th>
                            <th class="text-primary">Advance</th>
                            <th class="text-primary">Advance Leave</th>
                            <th class="text-primary">Stamp</th>
                            <th class="text-primary">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                            $total_net_deduction = 0;
                            $total_net_paid = 0;
                            $total_gross_salary = 0;
                            $total_advance_salary = 0;
                            $total_absent_deduction = 0;
                        @endphp
                        @foreach ($monthly_salary_details as $item)
                            @php

                                $basic = $item->basic;
                                $yearly_increment = $item->yearly_increment;
                                $house_rent = $basic/2;
                                $medical = $basic/6;
                                $gross_salary = $basic + $yearly_increment + $house_rent + $medical;
                                $total_gross_salary = $gross_salary +$total_gross_salary;
                                $Working_day = $item->working_day;
                                $per_day_salary = $basic/$Working_day;

                                $absent_deduction = $per_day_salary * ($item->absent);
                                $advance_salary = $item->advance;

                                $total_absent_deduction += $absent_deduction;
                                $total_advance_salary += $advance_salary;

                                $total_deduction = $absent_deduction + $advance_salary;
                                $net_paid = $gross_salary - $total_deduction;

                                $total_net_deduction = $total_net_deduction + floor($total_deduction);
                                $total_net_paid = $total_net_paid + floor($net_paid);
                            @endphp
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $item->employee->full_name }}</td>
                                <td>{{ $item->position->position_name }}</td>
                                <td style="white-space: nowrap">{{ date('d/M/Y',strtotime($item->employee->join_date)) }}</td>
                                <td class="text-right">{{ number_format(floor($basic),0) }}</td>
                                <td class="text-right">{{ number_format(floor($house_rent),0) }}</td>
                                <td class="text-right">{{ number_format(floor($medical),0) }}</td>
                                <td class="text-right">{{ number_format(floor($yearly_increment),0) }}</td>
                                <td class="text-right">{{ number_format(floor($gross_salary),0) }}</td>
                                <td class="text-right">{{ $item->working_day }}</td>
                                <td class="text-right">{{ $item->present }}</td>
                                <td class="text-right">{{ $item->leave }}</td>
                                <td class="text-right">{{ $item->absent }}</td>
                                <td>-</td>
                                <td class="text-right">{{ number_format(floor($absent_deduction),0) }}</td>
                                <td class="text-right">{{ number_format(floor($advance_salary),0) }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="text-right">{{ number_format(floor($total_deduction),0) }}</td>
                                <td class="text-right">{{ number_format(floor($net_paid),0) }}</td>
                                <td ></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right font-weight-bold">{{ number_format($total_gross_salary,0) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right font-weight-bold">{{ number_format($total_absent_deduction,0) }}</td>
                            <td class="text-right font-weight-bold">{{ number_format($total_advance_salary,0) }}</td>
                            <td></td>
                            <td></td>
                            <td class="text-right font-weight-bold">{{ number_format($total_net_deduction,0) }}</td>
                            <td class="text-right font-weight-bold">{{ number_format($total_net_paid,0) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button class="btn btn-info waves-effect float-right waves-light" onclick="myFunction('monthly_salary_details')">Print</button>
        </div>

    </div>

    <script>
        function myFunction(el) {
            var getFullContent = document.body.innerHTML;
            var printsection = document.getElementById(el).innerHTML;
            document.body.innerHTML = printsection;
            var css = '@page { size: auto;}',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
            style.styleSheet.cssText = css;
            } else {
            style.appendChild(document.createTextNode(css));
            }
            head.appendChild(style);
            // window.open();
            window.print();
            document.body.innerHTML = getFullContent;

    }
    </script>
@endsection
