@extends('backend.layout.master')
@section('title','Bank Statement')
@section('content')

<section>
    <div class="card">
        <div class="card-body">
            <br>
            @foreach ($data as $data )
            <h3 class="text-center"> Company Name: {{ $data->company->name }}</h3>
            {{-- <h3 class="text-center">Account Number: {{ $data->bank->account_number }}</h3> --}}
            @endforeach
            <h3 class="text-center"> Statement Period:&nbsp;&nbsp;<samp class="text-primary">{{ $data1 }}&nbsp;/&nbsp;{{ $data2 }}</samp></h3>
            <p class="text-center text-dark">Check Date: <samp id="date">
                    <script>
                    document.getElementById("date").innerHTML = Date();
                    </script>
                </samp>
            </p>
            <br>
            <br>

            <h2 class="text-center text-decoration-underline">Account Statement</h2>

<br>
<br>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <th>No</th>
                        <th>Date</th>
                        <th>Perticular</th>
                        <th>Received Amount</th>
                        <th>Expense</th>
                        <th>Balance</th>
                    </thead>
                        @php
                            $i=1;
                            $balance = 0;
                        @endphp
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $data1 }}</td>
                            <td>Opening Balance</td>
                            <td class="text-right font-weight-bold"><p>{{ number_format($data8,2) }}</p></td>
                            <td class="text-right font-weight-bold">0.00</td>
                            <td class="text-right font-weight-bold">
                                @php
                                    $balance = $balance + $data8
                                @endphp
                                 {{ number_format($balance,2) }}
                            </td>
                        </tr>
                        {{-- @php
                            $balance = $balance + $data8
                        @endphp --}}

                        @foreach ($data3 as $data3 )
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $data3->date }}</td>
                            <td>{{ $data3->source}}</td>
                            <td class="text-right font-weight-bold">
                                @if ($data3->type == 'Income')
                                    <p class="text-success">
                                        {{ number_format($data3-> amount,2)}}
                                    </p>
                                @else
                                    0.00
                                @endif

                            </td>
                            <td class="text-right font-weight-bold">
                                @if ($data3->type == 'Expense')
                                <p class=" text-danger">
                                    {{ number_format($data3-> amount,2)}}
                                </p>
                                @else
                                    0.00
                                @endif
                            </td>
                            <td class="text-right font-weight-bold">
                                @if ($data3->type == 'Income')
                                    <p class="text-success">
                                        {{-- {{  $balance  + $data3->amount}} --}}
                                        @php
                                            $balance = $balance  + $data3->amount
                                        @endphp
                                     {{ number_format($balance,2) }}
                                    </p>
                                @elseif ($data3->type == 'Expense')
                                    <p class="text-danger">
                                        {{-- {{ $balance  - $data3->amount }} --}}
                                        @php
                                            $balance = $balance  - $data3->amount
                                        @endphp
                                        {{ number_format($balance,2) }}
                                    </p>
                                @endif

                            </td>


                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right h4">{{ number_format(($data4 + $data8),2)}}</td>
                            <td class="text-right h4">{{ number_format($data5 ,2) }}</td>
                            <td class="text-right h4"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            {{-- <td colspan="3" class="h4">Gross Total/Loss</td> --}}
                            {{-- <td class="text-right h4">{{ number_format(($data4 + $data8),2)}}</td>
                            <td class="text-right h4">{{ number_format($data5 ,2) }}</td> --}}
                            <td class="text-right h4" colspan="6"> Gross Total/Loss :&emsp;&emsp;&emsp;{{ number_format((($data4 + $data8) - $data5),2)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
