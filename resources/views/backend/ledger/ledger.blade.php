@extends('backend.layout.master')
@section('title', 'Bank Transection List')
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
                    {{-- <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Type</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="type">
                                    <option value="">All Type</option>
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                  </select>
                            </div>
                          </div>
                    </div> --}}
                    {{-- <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Source</label>
                            <div class="col-sm-8">
                                <div id="source"></div>
                            </div>
                          </div>
                    </div> --}}

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
        </div>
    </div>

    <div class="card">
        <h4 class="text-center mt-3 mb-3"><u>Bank Transaction List</u></h4>
        <div class="card-body">
            <div class="float-right">
            </div>
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
                            <th class="text-center">Amount</th>
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
                    var select = $('<select class="form-control"><option value="">All Account</option></select>')
                        .appendTo($('#account_number').empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });

                    // //Drop Down Perticuler
                    // var column1 = this.api().column(3);
                    // var select1 = $('<select class="form-control"><option value="">All Company</option></select>')
                    //     .appendTo($('#source').empty())
                    //     .on('change', function() {
                    //         var val = $.fn.dataTable.util.escapeRegex(
                    //             $(this).val()
                    //         );
                    //         column1.search(val ? '^' + val + '$' : '', true, false).draw();
                    //     }) ;
                    //     column1.data().unique().sort().each(function(d, j) {
                    //         select1.append('<option value="' + d + '">' + d + '</option>');
                    //     });
                }


            });
            //Drop Down Filter3 Pre-Define Value
            // $('#type').on('change', function () {
            //     table.columns(6).search( this.value ).draw();
            // });
            //Date Filter
            $('#min, #max').on('change', function () {
                table.draw();
            });

        });

    </script>
@endsection
