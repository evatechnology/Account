@extends('backend.layout.master')
@section('title', 'Company Balance Sheet')
@section('content')

    <section>
        <div id="accordion-ten" class="accordion accordion-header-shadow accordion-rounded">
            <div class="accordion__item">
                <div class="accordion__header collapsed accordion__header--primary" data-toggle="collapse"
                    data-target="#header-shadow_collapseOne">
                    <span class="accordion__header--icon"></span>
                    <span class="accordion__header--text">Accordion Header One</span>
                    <span class="accordion__header--indicator"></span>
                </div>
                <div id="header-shadow_collapseOne" class="collapse accordion__body" data-parent="#accordion-ten">
                    <div class="accordion__body--text">
                        <div class="row">
                            @foreach ($company as $company)
                                <div class="col-sm-3">
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
    </section>

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
                                <select class="form-control" id="type">
                                    <option value="">All Type</option>
                                    <option value="Income">Income</option>
                                    <option value="Expense">Expanse</option>
                                  </select>
                            </div>
                          </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Source</label>
                            <div class="col-sm-8">
                                <div id="source"></div>
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
        </div>
    </div>

    <div class="card">
        <h4 class="text-center mt-3 mb-3"><u>Company Balance Sheet</u></h4>
        <div class="card-body">
            <div class="float-right">
                <a type="button" href="#" class="btn   btn-outline-success mb-5 btn-sm" data-toggle="modal"
                    data-target="#companybalanceAddModal">
                    <i class="mdi mdi-plus-circle"></i>New Transection
                </a>
            </div>
            <div class="table-responsive">
                <table id="company_transection" class=" table display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Company Name</th>
                            <th>Source</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($companyBalance as $item)
                            <tr id="editcompanybalance{{ $item->id }}">
                                <td>{{ ++$i }}</td>
                                <td>
                                    @if ($item->type == 'income')
                                        <div class="font-weight-bold" style="color: #00AF91">Income</div>
                                    @elseif( $item->type == 'expense')
                                        <div class="font-weight-bold" style="color: #F05454">Expense</div>
                                    @endif
                                </td>
                                <td>{{ $item->company->name }}</td>
                                <td>{{ $item->source }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    @if ($item->type == 'income')
                                        <div class="font-weight-bold" style="color: #00AF91"><i class="fas fa-plus"></i>
                                            {{ $item->amount }}</div>
                                    @elseif( $item->type == 'expense')
                                        <div class="font-weight-bold" style="color: #F05454"><i class="fas fa-minus"></i>
                                            {{ $item->amount }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                            role="button" data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h fa-lg"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item"
                                                href="{{ route('company.blance.edit', $item->id) }}"><i
                                                    class="fas fa-pencil-alt text-warning"></i> Edit</a>
                                            <a class="dropdown-item deletebtn" href="javascript:void(0);"
                                                data-id="{{ $item->id }}"><i class="fas fa-trash-alt text-danger"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Company Name</th>
                            <th>Source</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>


                </table>

            </div>

        </div>
    </div>


    {{-- Data add Model Start --}}
    <div class="modal fade" id="companybalanceAddModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3 class="modal-title" id="exampleModalLabel">New Income/Expense</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="companybalanceForm_errorlist"></ul>
                    <form class="forms-sample" id="companybalanceForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Type<small class="text-danger">*</small></label>
                            <select class="form-control" id="type" name="type">
                                <option selected disabled>Choose One</option>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Company</label>
                            <select class="form-control" id="company_id" name="company_id">
                                <option selected disabled>Choose One</option>
                                @foreach (App\Models\Company::get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Source<small class="text-danger">*</small></label>
                            <input type="text" name="source" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Date<small class="text-danger">*</small></label>
                            <input type="date" name="date" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Amount<small class="text-danger">*</small></label>
                            <input type="text" name="amount" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Document<small class="text-danger">(Optional)</small></label>
                            <br>
                            <input type="file" name="document" />
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn  btn-sm btn-primary mr-2">Submit</button>
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Data Add Modal End --}}


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
                    var date = new Date( data[4] );
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
                    var select1 = $('<select class="form-control"><option value="">All Company</option></select>')
                        .appendTo($('#source').empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column1.search(val ? '^' + val + '$' : '', true, false).draw();
                        }) ;
                        column1.data().unique().sort().each(function(d, j) {
                            select1.append('<option value="' + d + '">' + d + '</option>');
                        });
                }

            });
            //Drop Down Filter3 Pre-Define Value
            $('#type').on('change', function () {
                table.columns(1).search( this.value ).draw();
            });
            //Date Filter
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });

    </script>


@endsection
