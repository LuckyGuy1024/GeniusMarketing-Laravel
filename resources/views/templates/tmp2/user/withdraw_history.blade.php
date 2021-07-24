@extends(activeTemplate() .'layouts.app')
@push('style')



@endpush

@section('content')



<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="{{route('user.withdraw.history.date')}}" style="width:100% !important;">
     @csrf
                         <div class="form-group">
                            <div class="row">
                          <div class="col-md-6"></div>
                          
                    <div class="col-md-4" >
                               
                                    <strong style="color:white;">Select Date:</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg plan-price'"  id="current_date" name="current_date" required="required" class="form-control" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Date</span>
                                        </div>
                                    </div>

                                </div>
                           
<div class=" col-md-2" style="margin-top:15px !important;" >


<input type="submit" value="View Report" class="btn btn-block btn-primary mt-2">
    </div>
    </div>
    </div>

</form>
    </div>

<!-- report ends here -->



    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light"  id="printTable" >
                        <thead>
                        <tr>

                            <th scope="col">@lang('Date')</th>
                            <th scope="col">@lang('Withdraw Id')</th>
                            <th scope="col">@lang('Method')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Delay')</th>
                            <th scope="col">@lang('Status')</th>
                        </tr>
                        </thead>
                        <tbody >


                            @php 
$totalAmount=0;
$totalAmountAfterBalance=0;
                            @endphp
                      


                        @php $now = \Carbon\Carbon::now(); @endphp
                        @forelse($logs as $withdraw)

                                                @php
$totalAmount=$totalAmount+formatter_money($withdraw->amount);

                        @endphp
                            <tr>
                                <td>{{ show_datetime($withdraw->created_at) }}</td>
                                <td >{{ strtoupper($withdraw->trx) }}</td>
                                <td>{{ $withdraw->method->name }}</td>
                                <td >{{$general->cur_sym}}{{ formatter_money($withdraw->amount) }}</td>
                                <td >{{ $withdraw->delay }}</td>
                                <td>
                                    @if($withdraw->status == 3)
                                        <label class="badge badge-danger">@lang('Reject')</label>
                                    @elseif($withdraw->status == 2)
                                        <label class="badge badge-warning">@lang('Pending')</label>
                                    @elseif($withdraw->status == 1)
                                        <label class="badge badge-success">@lang('Complete')</label>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                            </tr>
                        @endforelse
                        </tbody>


                            <tfoot><thead >
                            
                            <th colspan="6">
                                <center>

                                @php
echo "<h7>"." Total Amount  <b>: ".$totalAmount."  </b>"."</h7>"."<br>";

                                @endphp
</center>
                            </th>
                        </thead></tfoot>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        {{$logs->links()}}
                    </nav>
                </div>

            </div>
        </div>

<div class="row col-md-12">
    <div class="col-md-9"></div>
        <div class="col-md-3">
<input type="submit" class="btn btn-block btn-primary mt-2"
                                                   value="@lang('Print')" onclick="printData()" />

                                               </div>
</div>



    </div>


@endsection

<script type="text/javascript">
  
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
});

</script>