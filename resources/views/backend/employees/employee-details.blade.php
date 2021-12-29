@extends('backend.layout.master')
@section('title','Employee')
@section('content')
    <div class="card">
        <div class="card-body " id="details">
            <div class="text-center ">
                <img src="{{ asset('/backend/image/employee/image/'.$employees->image) }}" class="img-fluid rounded-circle shadow" style="width:250px; height:250px" alt="">
            </div>
            <h3 class="text-center pt-5">{{ $employees->full_name }}</h3>
            <div class="row mt-4">
                <div class="col-sm-6">
                    <div>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="h6">Email:</td>
                                    <td>{{ $employees->email }}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Phone Number:</td>
                                    <td>{{ $employees->phone_1 }}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Alternetive Phone Number:</td>
                                    <td>{{ $employees->phone_2 }}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Present Address:</td>
                                    <td>{{ $employees-> address_present}}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Permanent Address:</td>
                                    <td>{{ $employees->address_permanent}}</td>
                                </tr>
                                <tr>
                                    <td class="h6">NID:</td>
                                    <td>{{ $employees->nid}}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Education:</td>
                                    <td>{{ $employees->education}}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Date Of Birth:</td>
                                    <td>{{ $employees->dob}}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Gender: </td>
                                    <td>{{ $employees->gender}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="h6">Position: </td>
                                    <td>{{ $employees->position->position_name }}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Salary: </td>
                                    <td>{{ $employees->salary }}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Join Date: </td>
                                    <td>{{ $employees->join_date }}</td>
                                </tr>
                                <tr>
                                    <td class="h6">Document: </td>
                                    <td>
                                        <a href="{{ asset('/backend/image/employee/nid_copy/'.$employees->nid_copy) }}" target="_blank" class="btn btn-outline-primary">NID COPY</a>
                                        <a href="{{ asset('/backend/image/employee/cv/'.$employees->cv) }}" target="_blank" class="btn btn-outline-primary">CV</a>
                                        <a href="{{ asset('/backend/image/employee/image/'.$employees->image) }}" target="_blank" class="btn btn-outline-primary">IMAGE</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h6">Status: </td>
                                    <td>
                                        @if ($employees->status == 1)
                                            <a class="btn btn-success text-white">Active</a>
                                        @else
                                            <a class="btn btn-danger text-white">Deactive</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <a type="button" href="{{ route('employees') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table display">
                @php
                    $i=0;
                @endphp
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Date</td>
                        <td>Position</td>
                        <td>Reason</td>
                        <td>Amount</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payroll as $item)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->position->position_name }}</td>
                        <td>{{ $item->reason }}</td>
                        <td>{{ $item->bonous }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
