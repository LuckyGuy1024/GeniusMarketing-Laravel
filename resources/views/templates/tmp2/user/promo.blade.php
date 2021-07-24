@extends(activeTemplate() .'layouts.app')

@section('content')




<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="{{route('user.level.promo.date')}}" style="width:100% !important;">
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

                                <input type="hidden" name="request" value="{{ $request }}">
                           
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
                <div class="table-responsive table-responsive">
                    <table class="table align-items-center table-light"   id="printTable">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Sl')</th>
                            <th scope="col">@lang('TRX-ID') </th>
                            <th scope="col">@lang('Amount') </th>
                            <th scope="col">@lang('After Balance') </th>
                            <th scope="col">@lang('Detail') </th>
                            <th scope="col">@lang('Time') </th>
                        </tr>
                        </thead>
                        <tbody class="list">

                            @php 
$totalAmount=0;
$totalAmountAfterBalance=0;
                            @endphp
                        @forelse($table as $key=>$data)

                        @php
$totalAmount=$totalAmount+formatter_money($data->amount);
$totalAmountAfterBalance=$totalAmountAfterBalance+formatter_money($data->balance);
                        @endphp
                            <tr>
                                <td>{{$table->firstItem()+$key}}</td>
                                <td>{{$data->trx}}</td>
                                <td>{{$general->cur_sym}}{{formatter_money($data->amount)}}</td>
                                <td>{{$general->cur_sym}}{{formatter_money($data->balance)}}</td>
                                <td>{{$data->title}}</td>

                                <td>{{show_datetime($data->created_at)}}</td>
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
echo "<h7>"." Total Amount After Balance <b>:  ". $totalAmountAfterBalance." </b>"."</h7>";
                                @endphp
</center>
                            </th>
                        </thead></tfoot>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{$table->links()}}
                    </nav>
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

<!-- date picker -->
