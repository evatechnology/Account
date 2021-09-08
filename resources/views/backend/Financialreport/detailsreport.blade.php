@extends('backend.layout.master')
@section('title','Financial Report')
@section('content')
<section>
    <div class="card" id="content1">
        <div class="card-body">
            <br>
            @foreach ($data1 as $data1 )
            <h3 class="text-center"> Bank Name: {{ $data1->bank->bank_name }}</h3>
            <h3 class="text-center">Account Number: {{ $data1->bank->account_number }}</h3>
            @endforeach
            <h3 class="text-center"> Date:&nbsp;{{ $data7}}&nbsp;&nbsp;-&nbsp;&nbsp;{{ $data8 }}</h3>
            <p class="text-center text-dark">Check Date: <samp id="date">
                    <script>
                    document.getElementById("date").innerHTML = Date();
                    </script>
                </samp>
            </p>
            <br>
            <br>

            <section>
                <table class="table table-borderless" id="sum_table">
                    <thead class="thead-dark">
                      <tr>
                        <th>Revenue</th>
                        <th class="text-center">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data )
                            <tr>
                                <td>{{ $data->reason }}</td>
                                <td class="text-center">{{ $data->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="thead-light">
                        <tr class="border-top">
                            <th><h3>Total</h3></th>
                            <th class="text-center"><h3>{{ $data3 }}</h3></th>

                          </tr>
                    </tfoot>
                </table>
            </section>

            <br>
            <section>
                <table class="table table-borderless">
                    <thead class="thead-dark">
                      <tr>
                        <th>Expense</th>
                        <th class="text-center">Amount</th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach ($data2 as $data2 )
                        <tr>
                            <td>{{ $data2->reason }}</td>
                            <td class="text-center">{{ $data2->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="thead-light">
                        <tr>
                            <th class="h3">Total</th>
                            <th class="text-center h3">{{ $data4 }}</th>

                          </tr>
                    </tfoot>
                  </table>
            </section>
            <br>
            <section>
                <table class="table table-borderless">
                    <thead class="thead-dark">
                      <tr>
                        <th >Total</th>
                        <th class="text-center">Amount</th>
                      </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Revenue</td>
                            <td class="text-center">{{ $data3 }}</td>
                        </tr>
                        <tr>
                            <td>Expense</td>
                            <td class="text-center">{{ $data4 }}</td>
                        </tr>
                    </tbody>

                    <tfoot class="thead-light">
                        <tr>
                            <th><h3>Total Profit/Loss</h3></th>
                            <th class="text-center"><h3>{{ $data3 - $data4 }}</h3></th>

                          </tr>
                    </tfoot>
                  </table>
            </section>

        </div>
    </div>
</section>
<div id="editor"></div>
<div class="text-right">
    <button class="btn btn-info waves-effect waves-light"  id="makepdf" >Make Pdf</button>
    <button class="btn btn-info waves-effect waves-light" onclick="myFunction('content1')">Print</button>
</div>

<script>
$("body").on("click", "#makepdf", function () {
            html2canvas($('#content1')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("BankReport"+Date()+".pdf");
                }
            });
        });
</script>
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
