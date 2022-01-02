@extends('backend.layout.master')
@section('title', 'AMS || Employees Position')
@section('content')


<div class="card">
    <h4 class="text-center mt-3 mb-3"><u>Filter</u></h4>
    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Account Number</label>
                        <div class="col-sm-8">
                          <div id="account_number"></div>
                        </div>
                      </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="emp_position" class="col-sm-4 col-form-label text-dark">Position</label>
                        <div class="col-sm-8">
                            <div id="emp_position"></div>
                        </div>
                      </div>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Salary From</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="min" name="min" placeholder="10,000">
                        </div>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Salary To</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="max" name="max" placeholder="90,000">
                        </div>
                      </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="card">
        <h3 class="text-center pt-3"><u>Position & Salary Scale List</u></h1>
        <div class="card-body">
            <div class="float-right">
                <a type="button" href="#" class="btn  btn-outline-success mb-2 btn-sm" data-toggle="modal"
                    data-target="#PositionAddModal">
                    <i class="mdi mdi-plus-circle"></i>Add Position
                </a>
            </div>
            <div class="table-responsive">
                <table id="position" class="table display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Position</th>
                            <th>Salary Range</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                       @foreach ($position as $item)
                        <tr id="position-{{ $item->id }}">
                            <td></td>
                            <td>{{ $item->position_name }}</td>
                            <td>{{ number_format($item->salary_range,2) }} Tk</td>
                            <td>
                                <a class="btn btn-outline-warning btn-sm" href="javascript:void(0);" onclick="editPosition({{ $item->id }})"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-outline-danger deletebtn btn-sm" href="javascript:void(0);" data-id="{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>



{{-- Data add Model Start --}}
<div class="modal fade" id="PositionAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3 class="modal-title" id="exampleModalLabel">Insert Position & Salary</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="PositionForm_errorlist"></ul>
                    <form class="forms-sample" id="positionaddform" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Position Name<small class="text-danger">*</small></label>
                            <input type="text" name="position_name" class="form-control" placeholder="Assistant Manager"/>
                        </div>
                        <div class="form-group">
                            <label>Salary Scale<small class="text-danger">*</small></label>
                            <input type="text" name="salary_range" class="form-control" placeholder="25000.00"/>
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

{{-- Data add Model Start --}}
<div class="modal fade" id="PositionEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3 class="modal-title" id="exampleModalLabel">Insert Position & Salary</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="PositionForm_errorlist"></ul>
                    <form class="forms-sample" id="positioneditform" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label>Position Name<small class="text-danger">*</small></label>
                            <input type="text" id="position_name1" name="position_name1" class="form-control" placeholder="Assistant Manager"/>
                        </div>
                        <div class="form-group">
                            <label>Salary Scale<small class="text-danger">*</small></label>
                            <input type="text" id="salary_range1" name="salary_range1" class="form-control" placeholder="25000.00"/>
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
    $('#positionaddform').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var myformData = new FormData($('#positionaddform')[0]);
            $.ajax({
                type: "post",
                url: "/admin/position/add",
                data: myformData,
                cache: false,
                //enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.status == 400){
                        $('#PositionForm_errorlist').html("");
                        $.each(response.errors, function (key, err_values) {
                            $("#PositionForm_errorlist").append('<li class="text-danger">'+err_values+'</li>');
                        });
                    }else{

                    $("#positionaddform").find('input').val('');
                    $('#PositionAddModal').modal('hide');
                    Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Position Successfully Added',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    location.reload();
                    }

                },
                error: function(error) {
                    console.log(error);
                    alert("Data Not Save");
                }
            });
        });


        $('body').on('click', '.deletebtn', function() {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/position/delete/" + id,
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


    function editPosition(id){
        $.get("/admin/position/edit/"+id, function(position){
            $('#id').val(position.id);
            $('#position_name1').val(position.position_name);
            $('#salary_range1').val(position.salary_range);
            // $('#balance').val(bank.balance);
            $('#PositionEditModal').modal("toggle");
        });
    }

    $('#positioneditform').submit(function (e) {
        e.preventDefault();

        let id = $('#id').val();
        // let company_id1 = $('#company_id1').val();
        let position_name1 = $('#position_name1').val();
        let salary_range1 = $('#salary_range1').val();
        let _token = $('input[name=_token]').val();

        $.ajax({
            type: "PUT",
            url: "/admin/position/update",
            data: {
                id:id,
                // company_id:company_id1,
                position_name1:position_name1,
                salary_range1:salary_range1,
                _token:_token,
            },
            dataType: "json",
            success: function (response) {
                // $('#position-'+response.id + 'td:nth-child(1)').text(response.company_id);
                $('#position-'+response.id + 'td:nth-child(1)').text(response.position_name1);
                $('#position-'+response.id + 'td:nth-child(2)').text(response.salary_range1);
                $('#PositionEditModal').modal("hide");
                Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Details Update Successful',
                            showConfirmButton: false,
                            timer: 1000
                        });
                location.reload();
                $('#positioneditform')[0].reset();

            }
        });

    });
</script>

<script>
    $(document).ready(function () {

        //var minData, maxData;
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = parseInt( $('#min').val(), 10 );
                    var max = parseInt( $('#max').val(), 10 );
                    var salary = parseFloat( data[3] ) || 0;
                    if ( ( isNaN( min ) && isNaN( max ) ) ||
                        ( isNaN( min ) && salary <= max ) ||
                        ( min <= salary   && isNaN( max ) ) ||
                        ( min <= salary   && salary <= max ) ) {
                        return true;
                    }
                    return false;
                }
            );

        let table = $('#position').DataTable({
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			//debugger;
                var index = iDisplayIndexFull + 1;
                $("td:first", nRow).html(index);
                return nRow;
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

                    //Drop Down Perticuler
                    var column1 = this.api().column(2);
                    var select1 = $('<select class="form-control"><option value="">All Position</option></select>')
                        .appendTo($('#emp_position').empty())
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
        $('#min, #max').on('change', function () {
                table.draw();
            });
    });
</script>
@endsection
