@extends('backend.layout.master')
@section('title', 'AMS || Attendance')
@section('content')

<section>
    <div class="card">
        <h2 class="text-center mt-5">Attendence</h2>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                  <a class="nav-item mx-auto nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">New Attendence</a>
                  {{-- <a class="nav-item mx-auto nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">This Month Attendence</a> --}}
                  <a class="nav-item mx-auto nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">All Privious Attendence</a>
                </div>
            </nav>
              <div class="tab-content mt-5" id="nav-tabContent">

                {{-- -----------------------New Attendence---------------------------}}
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <form class="forms-sample" id="attendenceForm" method="POST" enctype="multipart/form-data">
                    <table class="table table-bordered">
                        @php
                            $i=0;
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label  class="h3 col-sm-4 text-dark">Month:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control w-50" name="month" required>
                                            <option selected disabled>Choose One </option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 h3 text-dark">Year:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="year" class="form-control border-0" id="demo" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th class="text-center">Present</th>
                                <th class="text-center">Absent</th>
                                <th class="text-center">Leave</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Models\Employee::where('status',1)->get() as $item )
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <div style="display:none"><input type="text" value="{{ $item->id }}" name="employee_id[]" class="form-control border-0"></div>
                                        <input type="text" value= "{{ $item->full_name }}" class="form-control border-0" readonly placeholder="0">
                                    </td>
                                    <td class="text-center"><input type="number" name="present[]" class="form-control border-0" placeholder="0"></td>
                                    <td class="text-center"><input type="number" name="absent[]" class="form-control border-0" placeholder="0"></td>
                                    <td class="text-center"><input type="number" name="leave[]" class="form-control border-0" placeholder="0"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        <button type="submit" class="btn  btn-sm btn-primary mr-2">Submit</button>
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
                </div>

                {{-- -----------------------This Mounth Attendence---------------------------}}
                {{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <table class="table table-bordered">
                        @php
                            $i=0;
                        @endphp
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Present</th>
                                <th>Absent</th>
                                <th>Leave</th>
                                <th>Total Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Models\Attendance::where('mounth',$month) as $item )
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->employee->full_name }}</td>
                                    <td>{{ $item->present }}</td>
                                    <td>{{ $item->absent }}</td>
                                    <td>{{ $item->leave }}</td>
                                    <td>{{ ($item->leave) + ($item->absent) + ($item->present)}}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}

                {{-- -----------------------All Privious Attendence---------------------------}}
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label  class="col-sm-4 col-form-label text-dark">Month</label>
                                            <div class="col-sm-8">
                                              <div id="month"></div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label  class="col-sm-4 col-form-label text-dark">Year</label>
                                            <div class="col-sm-8">
                                              <div id="year"></div>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                        </div>
                    </div>


                    <table class="table example" id="example">
                        @php
                            $i=0;
                        @endphp
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Present</th>
                                <th>Absent</th>
                                <th>Leave</th>
                                <th>Total Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $item )
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->employee->full_name }}</td>
                                    <td>{{ $item->mounth }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->present }}</td>
                                    <td>{{ $item->absent }}</td>
                                    <td>{{ $item->leave }}</td>
                                    <td>{{ ($item->leave) + ($item->absent) + ($item->present)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Present</th>
                                <th>Absent</th>
                                <th>Leave</th>
                                <th>Total Day</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
              </div>
        </div>
    </div>
</section>


<script>
    const d = new Date();
    // let date = document.write(new Date().getFullYear());
    let year = d.getFullYear();
    document.getElementById("demo").value = year;
</script>

<script>
        $('#attendenceForm').on('submit', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var myformData = new FormData($('#attendenceForm')[0]);
                $.ajax({
                    type: "post",
                    url: "/admin/attendence/add",
                    data: myformData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $("#attendenceForm").find('input').val('');
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



           // DataTable filter
           $(document).ready(function() {
            var table = $('.example').DataTable({
                initComplete: function() {
                    let column = this.api().column(2);
                    let select = $('<select class="form-control"><option value="">All Month</option></select>')
                        .appendTo($('#month').empty())
                        .on('change', function() {
                            let val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });

                    let column1 = this.api().column(3);
                    let select1 = $('<select class="form-control"><option value="">All Year</option></select>')
                        .appendTo($('#year').empty())
                        .on('change', function() {
                            let val1 = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column1.search(val1 ? '^' + val1 + '$' : '', true, false).draw();
                        });
                        column1.data().unique().sort().each(function(d, j) {
                            select1.append('<option value="' + d + '">' + d + '</option>');
                        });
                }
            });

        });
</script>
@endsection
