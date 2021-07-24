@extends('admin.layouts.app')

@section('panel')

@php 

$request="log";
if($page){

switch($page){

    case "pending":
   $request="pending";
   break; 

    case "approved":
   $request="approved";
   break;   

    case "rejected":
   $request="rejected";
   break;  

    case "log":
   $request="log";
   break;
defaul:
  $request="log";
}

}


@endphp

<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="{{route('admin.withdraw.date')}}" style="width:100% !important;">
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

                                <input type="hidden" name="page" value="{{ $request }}">
                           
<div class=" col-md-2" style="margin-top:15px !important;" >


<input type="submit" value="View Report" class="btn btn-block btn-success mt-2">
    </div>
    </div>
    </div>

</form>
    </div>

<!-- report ends here -->


@php


$totalAmount=0;
$totalCharge=0;
$totalPayableAmount=0;
$totalCurrency=0;

@endphp


<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light" id="printTable" class="withDrawTable">
                    <thead>
                        <tr>
                           <!--  <th scope="col"><input type="checkbox" style="width:20px;height: 20px;" class="form-control input-sm" class="checkbox" id="check_all" /></th> -->
                            <th scope="col">Date</th>
                            <th scope="col">Withdrawal Code</th>
                            <th scope="col">Username</th>
                            <th scope="col">Withdrawal Method</th>

                            <th scope="col">Amount</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Payable Amount</th>
                            <th scope="col">In Method Currency</th>
                            @if(request()->routeIs('admin.withdraw.pending'))
                            <th scope="col">Action</th>
                            @elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search'))
                            <th scope="col">Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php $now = \Carbon\Carbon::now(); @endphp
                        @foreach($withdrawals as $withdraw)
                        <tr>
                            <!-- <td><input type="checkbox" style="width:20px;height: 20px;" class="form-control input-sm"  class="checkbox" /></td> -->
                            <td>{{ show_datetime($withdraw->created_at) }}</td>

                            <td class="font-weight-bold">{{ strtoupper($withdraw->trx) }}</td>
@php


$totalAmount=$totalAmount+formatter_money($withdraw->amount);
$totalCharge=$totalCharge+formatter_money($withdraw->charge);
$totalPayableAmount=$totalPayableAmount+($withdraw->amount - $withdraw->charge);


@endphp
 @php
                        $userName="";
$result=\App\User::where("id","=",$withdraw->id)->get();
if($result){

    foreach($result as $r){
if($r){
        $userName=$r->username;
    }
    }
}
@endphp

                            <td><a href="{{ route('admin.users.detail', $withdraw->user_id) }}">{{$userName}} </a></td>
                

                            <td>{{ $withdraw->method->name }}</td>

                            <td class="budget">{{ $general->cur_sym }}{{ formatter_money($withdraw->amount) }}</td>

                            <td class="budget text-danger">{{ $general->cur_sym }}{{ formatter_money($withdraw->charge) }}</td>

                            @php $payable = $withdraw->amount - $withdraw->charge; @endphp
                            <td class="budget">{{ $general->cur_sym }}{{ formatter_money($payable) }}</td>

@php 

$totalCurrency=$totalCurrency+ formatter_money($withdraw->rate * $payable);
@endphp
                            <td class="budget">{{ $withdraw->currency}}{{ formatter_money($withdraw->rate * $payable) }}</td>
                            @if(request()->routeIs('admin.withdraw.pending'))
                            <td>
                                <button class="btn btn-success approveBtn" data-id="{{ $withdraw->id }}" data-amount="{{ $general->cur_sym }}{{ formatter_money($withdraw->amount) }}" data-username="{{ $withdraw->user->username }}" data-date="{{show_datetime($withdraw->created_at)}}" data-code="{{  strtoupper($withdraw->trx)  }}"  data-mehtod="{{ $withdraw->method->name }}"    data-amount="{{ $general->cur_sym }}{{ formatter_money($withdraw->amount) }}"  data-charge="{{ $general->cur_sym }}{{ formatter_money($withdraw->charge) }}"  data-pay="{{ $general->cur_sym }}{{ formatter_money($payable) }}"  data-currency="{{ $withdraw->currency}}{{ formatter_money($withdraw->rate * $payable) }}"

                                    ><i class="fa fa-fw fa-check"></i></button>
                                <button class="btn btn-danger rejectBtn" data-id="{{ $withdraw->id }}" data-amount="{{ $general->cur_sym }}{{ formatter_money($withdraw->amount) }}" data-username="{{ $withdraw->user->username }}"><i class="fa fa-fw fa-ban"></i></button>
                                @if(!empty($withdraw->detail))
                                <button class="btn btn-info viewBtn" data-ud="{{ json_encode($withdraw->detail) }}" ><i class="fa fa-fw fa-eye"></i></button>
                                @endif
                            </td>
                            @elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search'))
                            <td>

                                @if($withdraw->status == 1)
                                <span class="badge badge-success">Approved</span>
                                @elseif($withdraw->status == 3)
                                    <span class="badge badge-danger">Rejected</span>
                                    @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            @endif

                        </tr>
                       
                        @endforeach
                    </tbody>

   <tfoot><thead >
                            
                            <th colspan="9">
                                <center>

                                @php
echo "<h7>"." Total Amount  <b>: ".$totalAmount."  </b>"."</h7>"."<br>";
echo "<h7>"." Total Charges  <b>: ".$totalCharge."  </b>"."</h7>"."<br>";
echo "<h7>"." Total Payable <b>:  ". $totalPayableAmount." </b>"."</h7>"."<br>";
echo "<h7>"." Total In Method Currency <b>:  ". $totalCurrency." </b>"."</h7>";
                                @endphp
</center>
                            </th>
                        </thead></tfoot>


                </table>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    {{ $withdrawals->appends($_GET)->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="row col-md-12">
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <input type="submit" class="btn btn-block btn-primary mt-2" value="@lang('Print Selected')" id = "btnGet"  />

    </div>
        <div class="col-md-3">
<input type="submit" class="btn btn-block btn-primary mt-2" value="@lang('Print All')" onclick="printData()" />

                                               </div>
</div>

{{-- View MODAL --}}
<div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="userdata"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- APPROVE MODAL --}}
<div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Withdrawal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdraw.approve') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to <span class="font-weight-bold">approve</span> <span class="font-weight-bold withdraw-amount text-success"></span> withdrawal of <span class="font-weight-bold withdraw-user"></span>?</p>
               
<div id="print_div">
    

 
   
</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="approve" class="btn btn-primary">Approve</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- REJECT MODAL --}}
<div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Withdrawal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.withdraw.reject') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to <span class="font-weight-bold">reject</span> <span class="font-weight-bold withdraw-amount text-success"></span> withdrawal of <span class="font-weight-bold withdraw-user"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Reject</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    var approveWithDrawal="";


      $('#approve').on('click', function() {

      approveWithDrawal+= "<div>Withdrawal code :     "+ $('.approveBtn').data("code")+"</div>\n";
      approveWithDrawal+= "<div>User Name :           "+ $('.approveBtn').data("username")+"</div>\n";
      approveWithDrawal+= "<div>Withdrawal Method :   "+ $('.approveBtn').data("method")+"</div>\n";
      approveWithDrawal+= "<div>Amount :              "+ $('.approveBtn').data("amount")+"</div>\n";
      approveWithDrawal+= "<div>Charge :              "+ $('.approveBtn').data("charge")+"</div>\n";
      approveWithDrawal+= "<div>Payable Amount :      "+ $('.approveBtn').data("pay")+"</div>\n";
      approveWithDrawal+= "<div>In Method Currency :  "+ $('.approveBtn').data("currency")+"</div>\n";
      approveWithDrawal+= "<div>Requested Date :      "+ $('.approveBtn').data("date")+"</div>\n";

$("#print_div").html(approveWithDrawal);
printPageArea("print_div");
      // alert(approveWithDrawal);
// return;
      });

    // print ends
    var path = `{{ asset(config('constants.withdraw.verify.path')) }}`;
    $('.approveBtn').on('click', function() {
        var modal = $('#approveModal');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('.withdraw-amount').text($(this).data('amount'));
        modal.find('.withdraw-user').text($(this).data('username'));
        modal.modal('show');
    });

    $('.rejectBtn').on('click', function() {
        var modal = $('#rejectModal');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('.withdraw-amount').text($(this).data('amount'));
        modal.find('.withdraw-user').text($(this).data('username'));
        modal.modal('show');
    });

    $('.viewBtn').on('click', function() {
        var modal = $('#viewModal');
        var data = $(this).data('ud');

        var html = `<ul class="list-group">`;
        html += `<li class="list-group-items">`
        $.each(data, function(idx, val) {
            html += `<li>${idx} - ${val}</li>`;
        });
        html += `</ul>`;

        modal.find('.userdata').html(html);
        modal.modal('show');
    });


    function printPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=900');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>
@endpush

@push('breadcrumb-plugins')
@if(request()->routeIs('admin.users.withdrawals'))

<form action="" method="GET" class="form-inline">
    <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="Withdrawal code" value="{{ $search ?? '' }}">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
@else
<form action="{{ route('admin.withdraw.search', $scope ?? str_replace('admin.withdraw.', '', request()->route()->getName())) }}" method="GET" class="form-inline">
    <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="Withdrawal code/Username" value="{{ $search ?? '' }}">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
@endif
@endpush


<script type="text/javascript">
  

function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

// $('button').on('click',function(){
// printData();
// });

</script>

