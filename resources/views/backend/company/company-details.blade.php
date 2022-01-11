@extends('backend.layout.master')
@section('title','AMS || Client Details')
@section('content')
    <div class="card">
        <div class="card-body" id="details">

            <div class="row">
                <div class="col-md-12">
                  <div class="user-profile-name text-center mt-5"><h2>{{ $company->name }}</p></div>
                    <div class="row pt-4">
                        <div class="col-md-4">
                            <div>
                                <h4 style="color: #009DAE"><u>Client Information</u></h4>

                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><span class="h5 " style="color: #113CFC">Phone:</span></td>
                                            <td><span class="text-dark h6">{{ $company->phone_no }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="h5" style="color: #113CFC">Email:</span></td>
                                            <td><span class="text-dark h6">{{ $company->email }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="h5" style="color: #113CFC">Website:</span></td>
                                            <td><span class="text-dark h6">http://{{ $company->website }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <h4 style="color: #009DAE"><u>Project Information</u></h4>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><span class="h5 " style="color: #113CFC">Work Order: </span></td>
                                            <td><span class="text-dark h6">{{ number_format($company->work_order,2)}}</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="h5" style="color: #113CFC">Project Start Date:</span></td>
                                            <td><span class="text-dark h6">{{ $company->start_date }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="h5" style="color: #113CFC">Project End Date:</span></td>
                                            <td><span class="text-dark h6">{{ $company->end_date }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <h4 style="color: #009DAE"><u>Balance Summery</u></h4>
                                <table class="table table-borderless">
                                    <tbody>
                                        @php
                                            $receivable = 0;
                                            $receivable = ($company->work_order)-($company->received_payment);
                                            $profit = 0;
                                            $profit = ($company->received_payment)-($company->spending);
                                        @endphp
                                        <tr>
                                            <td><span class="h5 " style="color: #113CFC">Total Received: </span></td>
                                            <td class="text-dark h6 text-right"><span >{{ number_format($company->received_payment,2)}}</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="h5" style="color: #113CFC">Total Spend:</span></td>
                                            <td class="text-dark h6 text-right"><span>{{ number_format($company->spending,2) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="h5" style="color: #113CFC">Pending Amount:</span></td>
                                            <td class="h6 text-right">
                                                @if ($receivable < 0)
                                                    <span class="text-success">{{ abs(number_format($receivable,2)) }} (Extra)</span>
                                                @elseif ($receivable == 0)
                                                    <span class="text-success">{{ number_format($receivable,2) }}</span>
                                                @else
                                                    <span class="text-danger">{{ number_format($receivable,2) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="h5" style="color: #113CFC">Profit/Loss:</span></td>
                                            <td class="text-dark h6 text-right"><span >{{ number_format($profit,2) }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <h2 class="text-center">Full Payment List</h2>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Account Head</th>
                                <th class="text-right">Received</th>
                                <th class="text-right">Spend</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                                    @foreach (App\Models\CompanyBalance::where('company_id',$company->id)->orderBy('date')->get() as $t_item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $t_item->date}}</td>
                                        <td>{{ $t_item->account_head}}</td>
                                        <td class="text-right font-weight-bold">
                                            @if ($t_item->type == 'Income')
                                                <p class="text-success">
                                                    {{ number_format($t_item-> amount,2)}}
                                                </p>
                                            @else
                                                0.00
                                            @endif
                                        </td>
                                        <td class="text-right font-weight-bold">
                                            @if ($t_item->type == 'Expense')
                                                <p style="color: #FF0075">
                                                    {{ number_format($t_item-> amount,2)}}
                                                </p>
                                            @else
                                                0.00
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            {{-- <button class="btn btn-info waves-effect waves-light"  id="makepdf" >Download As Pdf</button> --}}
            <button class="btn btn-info waves-effect waves-light" onclick="myFunction('details')">Print</button>
            <a type="button" href="{{ route('company') }}" class=" float-right btn btn-info waves-effect waves-light" >Back</a>

        </div>

    </div>

    <script>
        function myFunction(el) {
            var getFullContent = document.body.innerHTML;
            var printsection = document.getElementById(el).innerHTML;
            document.body.innerHTML = printsection;
            window.print();
            document.body.innerHTML = getFullContent;

    }
    </script>
@endsection
