@extends(activeTemplate() .'layouts.app')



@section('style')

@stop

@section('content')



<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="{{route('user.deposit.history.date')}}" style="width:100% !important;">
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
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>

                            <th scope="col">@lang('Date')</th>
                            <th scope="col">@lang('TRX')</th>
                            <th scope="col">@lang('Method')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Status')</th>
                        </tr>
                        </thead>
                        <tbody >

                                                    @php 
$totalAmount=0;
$totalAmountAfterBalance=0;
                            @endphp
                    


                        @forelse($logs as $item)


                        @php
$totalAmount=$totalAmount+formatter_money($item->amount);
                        @endphp
                            <tr>
                                <td>{{ show_datetime($item->created_at) }}</td>
                                <td>{{ $item->trx }}</td>
                                <td>{{ __($item->gateway->name) }}</td>
                                <td>{{ $general->cur_sym }}{{ formatter_money($item->amount) }} </td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge badge-success">@lang('Complete')</span>
                                    @elseif ($item->status == 2)
                                        <span class="badge badge-warning">@lang('Pending')</span>
                                    @elseif ($item->status == 3)
                                        <span class="badge badge-danger">@lang('Reject')</span>
                                    @endif

                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{__('NO DATA FOUND')}}</td>
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
                        {{ $logs->links() }}
                    </nav>
                </div>

            </div>
        </div>
    </div>
@endsection



