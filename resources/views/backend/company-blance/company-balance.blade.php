@extends('backend.layout.master')
@section('title', 'Company Balance Sheet')
@section('content')

<div>

   <section class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title text-center">Company Transection</h4>
                <!-- Nav tabs -->
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">New Transection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile">Transection History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#message">Balance Summery</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <div class="pt-4">
                                <form class="forms-sample" id="companybalanceForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <table class="table table-borderless " id="table_field">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Company</th>
                                                <th>Account Head</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                {{-- <th>Document (Optional)</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control type" id="type" name="type[]" required>
                                                        <option selected disabled>Choose One</option>
                                                        <option value="Income">Income</option>
                                                        <option value="Expense">Expense</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="company_id" name="company_id[]" required>
                                                        <option selected disabled>Choose One</option>
                                                        @foreach (App\Models\Company::get() as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="source[]" id="source" class="form-control" required>
                                                </td>
                                                <td>
                                                    <input type="date" name="date[]" id="date" class="form-control" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="amount[]" id="amount" value="0" class="form-control amount" required>
                                                </td>
                                                {{-- <td>
                                                    <input type="file" name="document1[]" required id="document">
                                                </td> --}}
                                                <td>
                                                    <button type="button" class="btn btn-sm" style="background-color: #3a86ff;color:#FFF" id="add1"><i class="fas fa-plus"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><h4>Total: </h4></td>
                                                <td>
                                                    <div id="diff" class="diff">Differance:</div>
                                                    {{-- <h4>
                                                        <input type='text' class="totalSum form-control border-0" readonly id='totalSum'>
                                                    </h4> --}}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="float-right">
                                        <button type="submit" class="btn  btn-sm btn-primary mr-2">Submit</button>
                                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="profile">
                            <div class="pt-4">
                                <div class="card">
                                    <h4 class="text-center mt-3 mb-3"><u>Filter</u></h4>
                                    <div class="card-body">
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Company</label>
                                                        <div class="col-sm-8">
                                                          <div id="company"></div>
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Type</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="type_filter">
                                                                <option value="">All Type</option>
                                                                <option value="Income">Income</option>
                                                                <option value="Expense">Expanse</option>
                                                              </select>
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Account Head</label>
                                                        <div class="col-sm-8">
                                                            <div id="source1"></div>
                                                        </div>
                                                      </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">From</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="min" name="min" placeholder="yyyy-mm-dd">
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">To</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="max" name="max" placeholder="yyyy-mm-dd">
                                                        </div>
                                                      </div>
                                                </div>

                                            </div>

                                            <div id="buttons"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <h4 class="text-center mt-3 mb-3"><u>Company Transection History</u></h4>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="company_transection" class=" table display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Date</th>
                                                        <th>Company Name</th>
                                                        <th>Account Head</th>
                                                        <th>Voucher Type</th>
                                                        <th>Amount</th>
                                                        {{-- <th style="display:none">Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @foreach ($companyBalance as $item)
                                                        <tr id="editcompanybalance{{ $item->id }}">
                                                            <td>{{ ++$i }}</td>
                                                            {{-- <td>{{ date('d-M-y', strtotime($item->date)) }}</td> --}}
                                                            <td>{{ $item->date}}</td>

                                                            <td>{{ $item->company->name }}</td>
                                                            <td>{{ $item->source }}</td>
                                                            <td>
                                                                @if ($item->type == 'Income')
                                                                    <div class="font-weight-bold" style="color: #00AF91">Income</div>
                                                                @elseif( $item->type == 'Expense')
                                                                    <div class="font-weight-bold" style="color: #F05454">Expense</div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="float-right">
                                                                    @if ($item->type == 'Income')
                                                                        <div class="font-weight-bold" style="color: #00AF91">+ {{ $item->amount }}</div>
                                                                    @elseif( $item->type == 'Expense')
                                                                        <div class="font-weight-bold" style="color: #F05454">- {{ $item->amount }}</div>
                                                                    @endif
                                                                </div>

                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Date</th>
                                                        <th>Company Name</th>
                                                        <th>Account Head</th>
                                                        <th>Voucher Type</th>
                                                        <th>Amount</th>
                                                        {{-- <th style="display:none">Action</th> --}}
                                                    </tr>
                                                </tfoot>


                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="message">
                            <div class="pt-4 row">
                                @foreach ($company as $company)
                                    <div class="col-sm-4">
                                        <div class="card text-white shadow" id="company-balance-card">
                                            <div class="card-body mb-0">
                                                <h4 class="card-title text-white text-center">{{ $company->name }}</h5>
                                                    <br>
                                                    <h2 class="card-text text-center" style="color:#0CECDD">
                                                        {{ $company->current_blance }}</p>
                                            </div>
                                            <div class="card-footer bg-transparent border-0 text-white">
                                                <small>Last updateed {{ $company->updated_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </section>
</div>

<script type="text/javascript">
        $(document).ready(function() {
        var html1 = '<tr>\n'+
                '    <td>\n'+
                '        <select class="form-control type" id="type" name="type[]"required>\n'+
                '            <option selected disabled>Choose One</option>\n'+
                '            <option value="Income">Income</option>\n'+
                '            <option value="Expense">Expense</option>\n'+
                '        </select>\n'+
                '    </td>\n'+
                '    <td>\n'+
                '        <select class="form-control" id="company_id" name="company_id[]"required>\n'+
                '            <option selected disabled>Choose One</option>\n'+
                '            @foreach (App\Models\Company::get() as $item)\n'+
                '                <option value="{{ $item->id }}">{{ $item->name }}</option>\n'+
                '            @endforeach\n'+
                '        </select>\n'+
                '    </td>\n'+
                '    <td><input type="text" name="source[]" id="source" class="form-control" required/>'+
                '    </td>\n'+
                '    <td><input type="date" name="date[]" id="date" class="form-control" required/>'+
                '    </td>\n'+
                '    <td><input type="text" name="amount[]" value="0" id="amount" class="form-control amount" required/>'+
                '    </td>\n'+
                // '    <td><input type="file" name="document1[]"  id="document" required/>\n'+
                // '    </td>\n'+
                '    <td><button name="remove" class="btn btn-danger btn-sm" id="remove"><i class="fas fa-eraser"></i> </button>'+
                '    </td>\n'+
                '</tr>';

        var x = 1;
        $("#add1").click(function() {
            $("#table_field").append(html1);
        });

        $("#table_field").on('click', '#remove', function(e) {
            $(this).closest('tr').remove();
        });
    });
    // $(document).on('change', '.type', function () {
    //     var total = 0;
    //     var value = $(this).val();
    //     // var input = $(this).parents('td').next('td').find('.type');
    //     if (value === 'Expense') {
    //         $(".amount").each(function(){
    //                 total -= parseInt($(this).val());
    //                 $('#diff').html('Differance:' + total);
    //         });

    //     } else if (value === 'Income') {
    //         $(".amount").each(function(){
    //                 total += parseInt($(this).val());
    //                 $('#diff').html('Differance:' + total);
    //         });

    //     }

    // });
     
        $(document).on('change', '.type', function (event) {
            event.preventDefault();
            window.value1 = $(this).val();
            
        });

    $(document).on("change", ".amount", function(event1) {
        event1.preventDefault();
        var sum = 0;
        // var value1=event.value;
        // var value = $(this).find('#type').val();
        let amounttype = window.value1;
             console.log(window.value1);

        $(".amount").each(function(){
            if(amounttype === 'Income'){
                var amount2 = Math.abs(parseInt($(this).val()));
                console.log(amount2);
                sum = (sum + amount2);
                return true;
            }
            if(amounttype === 'Expense'){
                var amount3 = -Math.abs(parseInt($(this).val()));
                console.log(amount3);
                sum = (sum + amount3);
                return true;
                }
                
                // $('.diff').html('Differance:' + sum);
            });
            $('.diff').html('Differance:' + sum);
        
        
    });

    $('#companybalanceForm').on('submit', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var myformData = new FormData($('#companybalanceForm')[0]);
                $.ajax({
                    type: "post",
                    url: "/admin/companybalance/add",
                    data: myformData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $("#companybalanceForm").find('input').val('');
                        // $('#companybalanceAddModal').modal('hide');
                        Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1800
                });
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                        alert("Data Not Save");
                    }
                });
    });


</script>

<script>
    $('body').on('click', '.deletebtn', function() {
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                type: "DELETE",
                url: "/admin/companybalance/delete/" + id,
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function(data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Delete Successful',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    location.reload();
                    console.log(data);
                },
                error: function(data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'Error',
                        title: 'Data Not Deleted',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    console.log('Error:', data);
                }
            });
        }
    });
</script>



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
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });

           var table= $('#company_transection').DataTable({
               //Drop Down Filter1
                initComplete: function() {
                    var column = this.api().column(2);
                    var select = $('<select class="form-control"><option value="">All Company</option></select>')
                        .appendTo($('#company').empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });

                    //Drop Down Filter2
                    var column1 = this.api().column(3);
                    var select1 = $('<select class="form-control"><option value="">All Account Head</option></select>')
                        .appendTo($('#source1').empty())
                        .on('change', function() {
                            var val1 = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column1.search(val1 ? '^' + val1 + '$' : '', true, false).draw();
                        }) ;
                        column1.data().unique().sort().each(function(d, j) {
                            select1.append('<option value="' + d + '">' + d + '</option>');
                        });
                }

            });
            //Drop Down Filter3 Pre-Define Value
            $('#type_filter').on('change', function () {
                table.columns(4).search( this.value ).draw();
            });
            //Date Filter
            $('#min, #max').on('change', function () {
                table.draw();
            });

        });

    </script>
@endsection
