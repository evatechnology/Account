@extends('backend.layout.master')
@section('title','Financial Report')
@section('content')
<section>
    <div class="card">
        <div class="card-body">

            <table class="table">
                <thead>
                  <tr>

                    <th scope="col">Reason</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($data as $data )
                    <tr>
                        <td>{{ $data->ref }}</td>
                        <td>{{ $data->amount }}</td>
                    </tr>
                    @endforeach


                </tbody>
              </table>


        </div>
    </div>
</section>
@endsection
