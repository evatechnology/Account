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
                <table class="table">
                    <thead class="thead-dark">
                        <th>No</th>
                        <th>Date</th>
                        <th>Perticular</th>
                        <th>Credit</th>
                        <th>Debit</th>
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
                            <td class="text-center">{{ $data8 }}</td>
                            <td class="text-center">-</td>
                            <td class="text-center">
                                @php
                                    $balance = $balance + $data8
                                @endphp
                                 {{ $balance }}
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
                            <td class="text-center">
                                @if ($data3->type == 'Income')
                                    {{ number_format($data3-> amount,2)}}
                                @else
                                    00.00
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($data3->type == 'Expense')
                                    {{ number_format($data3-> amount,2)}}
                                @else
                                    00.00
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($data3->type == 'Income')
                                    <samp class="text-success">
                                        {{-- {{  $balance  + $data3->amount}} --}}
                                        @php
                                            $balance = $balance  + $data3->amount
                                        @endphp
                                     {{ $balance }}
                                    </samp>
                                @elseif ($data3->type == 'Expense')
                                    <samp class="text-danger">
                                        {{-- {{ $balance  - $data3->amount }} --}}
                                        @php
                                        $balance = $balance  - $data3->amount
                                    @endphp
                                 {{ $balance }}
                                    </samp>
                                @endif

                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td class="text-center">{{ $data4 }}</td>
                            <td class="text-center">{{ $data5 }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
