@extends('backend.layout.master')
@section('title','AMS || Receivable')
@section('content')

<div class="card">
    <h4 class="text-center mt-3 mb-3"><u>Receivable Amount</u></h4>
    <div class="card-body" >
        <div style="overflow-y: scroll">
            <table id="example" class="table" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Work Order Amount</th>
                        <th>Received Amount</th>
                        <th>Receivable Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $item )
                        @php
                            $receivable = 0;
                            $receivable = ($item->work_order)-($item->received_payment);
                        @endphp
                        @if ($receivable > 0)
                            <tr>
                                <td></td>
                                <td>{{ $item->name }}</td>
                                <td class="text-right">{{ number_format($item->work_order,2)}}</td>
                                <td class="text-right">{{ number_format($item->received_payment,2)}}</td>
                                <td class="text-right">
                                    {{-- {{ number_format(($item->work_order)-($item->received_payment),2)}} --}}
                                    @if (($item->work_order <= $item->received_payment) && ($item->status == 'complete'))
                                        <span class="h6" style="color: #2FDD92">{{ number_format($receivable,2)}}</span>
                                    @elseif (($item->work_order <= $item->received_payment) && ($item->status == 'progress'))
                                        <span class="h6" style="color: #2FDD92">{{ number_format($receivable,2)}}</span>
                                    @elseif (($item->work_order > $item->received_payment) && ($item->status == 'complete'))
                                        <span class="h6" style="color: #F90716">{{ number_format($receivable,2)}}</span>
                                    @elseif (($item->work_order > $item->received_payment) && ($item->status == 'progress'))
                                        <span class="h6" style="color: #9145B6">{{ number_format($receivable,2)}}</span>
                                    @endif

                                </td>
                                <td class="text-center">
                                    @if ( $item->status == 'complete')
                                        <span class="text-success font-weight-bold h6">Complete</span>
                                    @else
                                        <span class="text-warning font-weight-bold h6">Progress</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Work Order Amount</th>
                        <th>Receiveable Amount</th>
                        <th>Pending Amount</th>
                        <th>Status</th>
                    </tr>
                </tfoot>


            </table>
        </div>
    </div>
</div>
<script>
    var table = $('#example').DataTable({
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			// debugger;
			var index = iDisplayIndexFull + 1;
			$("td:first", nRow).html(index);
			return nRow;
		},
        });
</script>
@endsection
