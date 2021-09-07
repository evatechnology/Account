@extends('backend.layout.master')
@section('title', 'Bank Ledger')
@section('content')


      <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" name="account_number" id="account_number">
                <option selected disabled>Choose One Account</option>
            @foreach (App\Models\BankTransaction::select('account_number')->groupBy('account_number')->get() as $item)
                <option value="{{ $item->account_number }}">{{ $item->bank->account_number }}</option>
            @endforeach
        </select>
      </div>


      <button type="submit" id="search" class="btn btn-dark" >Dark</button>


<script>
    $('#search').on("click", function(){
        var account_number = document.getElementById('account_number').value;
        $.ajax({
            type:'get',
            url: '/getdata/'+account_number,
            success: function(response) {
                console.log("Success");
            }
        });
    });
</script>
@endsection
