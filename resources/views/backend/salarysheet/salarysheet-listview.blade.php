@extends('backend.layout.master')
@section('title','AMS || Salary Sheet')
@section('content')

<div class="card">
    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Salary Sheet Name</th>
                    <th>Month-Year</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salarySheet as $item )
                    <tr>
                        <td></td>
                        <td><a class="text-info" href="{{ route('salarysheet.details',$item->sheet_name)}}">{{ $item->sheet_name}}</a></td>
                        <td>{{ $item->month}} / {{ $item->year}}</td>
                        <td>{{ $item->created_at}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
