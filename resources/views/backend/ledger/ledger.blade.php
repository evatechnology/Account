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
                <table id="BankTransaction_transection" class=" table display " style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>No</th>
                            {{-- <th>Bank Name</th> --}}
                            <th>Account Number</th>
                            <th>Date</th>
                            <th>PARTICULARS</th>
                            <th>Referance/Cheque No</th>
                            <th class="text-center">Credit</th>
                            <th class="text-center">Debit</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
{{-- <tr>
    <td></td>

    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td class="text-center"></td>
    <td class="text-center"></td>
    <td class="text-center">
        @foreach (App\Models\BankTransaction::get() as $item)
            {{ $item->amount }}
        @endforeach
    </td>
</tr> --}}
                        @foreach (App\Models\BankTransaction::get() as $item)
                            <tr id="editcompanybalance{{ $item->id }}">
                                <td>{{ ++$i }}</td>
                                {{-- <td>{{ $item->bank->bank_name }}</td> --}}
                                <td>{{ $item->bank->account_number }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->reason }}</td>
                                <td>{{ $item->ref }}</td>
                                <td class="text-center">
                                    @if ($item->type == 'credit')
                                        {{ $item->amount }}
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->type == 'debit')
                                        {{ $item->amount }}
                                    @else
                                        0.00
                                    @endif
                                </td>


                                <td>
                                    {{ $item->temp_balance }}
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            {{-- <th>Bank Name</th> --}}
                            <th></th>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th class="text-center">Credit</th>
                            <th class="text-center">Debit</th>
                            <th class="text-center">Amount</th>
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
                    var date = new Date( data[2] );
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
           var table= $('#BankTransaction_transection').DataTable({
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
                                "searchable": false
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

            credit = api
                .column( 5, { search: "applied" } )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 5 ).footer() ).html(
                credit
            );
            debit = api
                .column( 6, { search: "applied" } )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 6 ).footer() ).html(
                debit
            );



            total = api
                .column( 7, { search: "applied" } )
                .data()
                .reduce( function (a, b) {
                    return credit - debit;
                }, 0 );

            // Update footer
            $( api.column( 7 ).footer() ).html(
                total
            );
        },
                initComplete: function() {
                    //Drop Down Account Number
                    var column = this.api().column(1);
                    var select = $('<select class="form-control" value=""><option>All Account</option></select>')
                        .appendTo($('#account_number').empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                            document.getElementById("account_number1").innerHTML = val;
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
