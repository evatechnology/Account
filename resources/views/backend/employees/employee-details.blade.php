@extends('backend.layout.master')
@section('title','Employee')
@section('content')
    <div class="card">
        <div class="card-body" id="details">
            <div class="row mt-4">
                <div class="col-sm-8">
                    <div>
                        <h3>Name: {{ $employees->f_name }} {{ $employees->l_name }}</h3>
                        <h6>Email: {{ $employees->email }}</h6>
                        <h6>Phone: {{ $employees->phone }}</h6>
                        <h6>Company Name: {{ $employees->companyname->name }}</h6>
                    </div>
                </div>
            </div>
            <br>
            <a type="button" href="{{ route('employees') }}" class="btn btn-sm btn-primary">Back</a>
    </div>


@endsection
