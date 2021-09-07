
@extends('backend.layout.master')
@section('title', 'Bank Ledger')
@section('content')

    <div class="card">
        <h4 class="text-center mt-3 mb-3"><u>Filter</u></h4>
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Account Number</label>
                            <div class="col-sm-8">
                              <div id="account_number"></div>
                            </div>
                          </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">From</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="min" name="min" placeholder="mm/dd/yyyy">
                            </div>
                          </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">To</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="max" name="max" placeholder="mm/dd/yyyy">
                            </div>
                          </div>
                    </div>

                </div>
            </div>

            <div id="buttons"></div>
        </div>
    </div>

    <div class="card">
        <h4 class="text-center mt-3 mb-3"><u>Bank Statement</u></h4>
        <p id="account_number1"></p>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-borderless " style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>Account Number</th>
                            <th>Date</th>
                            <th>Revenues</th>
                            <th class="text-center">Amount</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach (App\Models\BankTransaction::where('type','credit')->get() as $item)
                            <tr>
                                <td>{{ $item->bank->account_number }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->reason }}</td>
                                <td class="text-center">{{ $item->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Account Number</th>
                            <th>Date</th>
                            <th class="text-dark"><h4>Total Revenues</h4></th>
                            <th class="text-dark text-center h4"></th>
                        </tr>
                    </tfoot>


                </table>
                <table class=" table table-borderless  " style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>Account Number</th>
                            <th>Date</th>
                            <th>Expenses</th>
                            <th class="text-center">Amount</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach (App\Models\BankTransaction::where('type','debit')->get() as $item)
                            <tr>
                                <td>{{ $item->bank->account_number }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->reason }}</td>
                                <td class="text-center">{{ $item->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="text-dark"><h4>Total Expenses</h4></th>
                            <th class="text-center text-dark h4"></th>
                        </tr>
                    </tfoot>


                </table>

            </div>

        </div>
    </div>


{{-- Datatable Value Filter --}}
    <script>

        $(document).ready(function() {
            //Date Filter Start
            var minDate, maxDate;
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = minDate.val();
                    var max = maxDate.val();
                    var date = new Date( data[1] );
                    if (
                        ( min === null && max === null ) ||
                        ( min === null && date <= max ) ||
                        ( min <= date   && max === null ) ||
                        ( min <= date   && date <= max )
                    ) {
                        return true;
                    }
                    return false;
                }
            );
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });
            var editor;
           var table= $('table.table-borderless').DataTable({
            "dom":'t',
            "columnDefs": [
                            {
                                "targets": [ 1 ],
                                "visible": false,
                                "searchable": true
                            },
                            {
                                "targets": [ 0 ],
                                "visible": false,
                                "searchable": true
                            },
                            ],

            "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            amount = api
                .column( 3, { search: "applied" } )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 3 ).footer() ).html(
                amount
            );
        },
                initComplete: function() {
                    //Drop Down Account Number
                    var column = this.api().column(0);
                    var select = $('<select class="form-control" ><option value="">All Account</option></select>')
                        .appendTo($('#account_number').empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                            document.getElementById("account_number1").innerHTML = val;
                            //console.log(column);
                        });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');

                        });
                }


            });

            //Date Filter
            $('#min, #max').on('change', function () {
                table.draw();
            });


        });

    </script>
@endsection
