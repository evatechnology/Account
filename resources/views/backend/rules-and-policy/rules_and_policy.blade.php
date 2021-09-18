@extends('backend.layout.master')
@section('title','Rules & Policy')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="float-right">
            <a type="button" href="#" class="btn  btn-outline-success mb-1 btn-sm" data-toggle="modal"
                data-target="#ruleandpolicyAddModal">
                <i class="mdi mdi-plus-circle"></i>Rules & Policy
            </a>
        </div>

        <table class="rule table display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @foreach ($rules as $item )
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="#" role="button" class="btn btn-sm btn-outline-success mr-2"><i class="fas fa-eye"></i></a>
                                <a href="#" role="button" class="btn btn-sm btn-outline-info mr-2"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0);" data-id="{{ $item->id }}" role="button" class="btn btn-sm btn-outline-danger mr-2 deletebtn"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


{{-- Data add Model Start --}}
<div class="modal fade" id="ruleandpolicyAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3 class="modal-title" id="exampleModalLabel">Add Rules & Policy</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="RulesForm_errorlist"></ul>
                    <form class="forms-sample" method="POST" id="RulesForm" enctype="multipart/form-data">
                        @csrf
                        {{-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> --}}

                        <div class="form-group">
                            <label for="position">Type:</label>
                            <select name="type" id="type" class="form-control">
                                <option selected disabled>Please Select Type</option>
                                <option value="Rule">Rules</option>
                                <option value="Policy">Policy</option>
                            </select>
                        </div>

                        <div class="form-group" >
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" >
                        </div>
                        <div class="form-group" >
                            <label>Description</label>
                            {{-- <div class="summernote" name="description"></div> --}}
                            <textarea id="editor" type="text" name="description" rows="5" class="form-control summernote"></textarea>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn  btn-sm btn-gradient-primary mr-2">Submit</button>
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
{{-- Data Add Modal End --}}

{{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: false
  });
</script> --}}
<script>
    var table = $('.rule').DataTable();

    $('#RulesForm').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var myformData = new FormData($('#RulesForm')[0]);
            $.ajax({
                type: "post",
                url: "{{ route('rules&policy') }}",
                data: myformData,
                cache: false,
                //enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if(response.status == 400){
                        $('#RulesForm_errorlist').html("");
                        $.each(response.errors, function (key, err_values) {
                            $("#RulesForm_errorlist").append('<li class="text-danger">'+err_values+'</li>');
                        });
                    }else{

                    $("#RulesForm").find('input').val('');
                    $('#ruleandpolicyAddModal').modal('hide');
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
                    url: "/admin/rules/delete/" + id,
                    data: {
                        "id": id,
                        "_token": token,
                        },
                    success: function(data) {
                        location.reload();
                        console.log(data);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
                }
        });
</script>
@endsection
