@extends('backend.layout.master')
@section('title','Financial Report')
@section('content')
<section>
    <div class="card">
        <div class="card-body">
            @foreach ($data1 as $data1 )
            <h3 class="text-center"> Bank Name: {{ $data1->bank->bank_name }}</h3>
            <h3 class="text-center">Account Number: {{ $data1->bank->account_number }}</h3>
            @endforeach

                <h3 class="text-center"> Date:

                        {{ $data7}}-{{ $data8 }}

        </h3>
            <table class="table" id="sum_table">
                <thead>
                  <tr>
                    <th scope="col">Revenue</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data )
                    <tr>
                        <td>{{ $data->reason }}</td>
                        <td>{{ $data->amount }}</td>
                    </tr>
                    @endforeach


                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">Total</th>

                        <th scope="col">{{ $data3 }}</th>

                      </tr>
                </tfoot>
              </table>


              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Expense</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data2 as $data2 )
                    <tr>
                        <td>{{ $data2->reason }}</td>
                        <td>{{ $data2->amount }}</td>
                    </tr>
                    @endforeach


                </tbody>

                <tfoot>
                    <tr>
                        <th scope="col">Total</th>

                        <th scope="col">{{ $data4 }}</th>

                      </tr>
                </tfoot>
              </table>


              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Total</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>Revenue</td>
                        <td>{{ $data3 }}</td>
                    </tr>
                    <tr>
                        <td>Expense</td>
                        <td>{{ $data4 }}</td>
                    </tr>



                </tbody>

                <tfoot>
                    <tr>
                        <th scope="col">Total Profit/Loss</th>

                        <th scope="col">{{ $data3 - $data4 }}</th>

                      </tr>
                </tfoot>
              </table>

        </div>
    </div>
</section>


<script>

</script>
@endsection
