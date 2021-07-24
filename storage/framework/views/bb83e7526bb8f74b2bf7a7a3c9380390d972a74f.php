<?php $__env->startSection('panel'); ?>

<?php 

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


?>

<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="<?php echo e(route('admin.withdraw.date')); ?>" style="width:100% !important;">
     <?php echo csrf_field(); ?>
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

                                <input type="hidden" name="page" value="<?php echo e($request); ?>">
                           
<div class=" col-md-2" style="margin-top:15px !important;" >


<input type="submit" value="View Report" class="btn btn-block btn-success mt-2">
    </div>
    </div>
    </div>

</form>
    </div>

<!-- report ends here -->


<?php


$totalAmount=0;
$totalCharge=0;
$totalPayableAmount=0;
$totalCurrency=0;

?>


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
                            <?php if(request()->routeIs('admin.withdraw.pending')): ?>
                            <th scope="col">Action</th>
                            <?php elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search')): ?>
                            <th scope="col">Status</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $now = \Carbon\Carbon::now(); ?>
                        <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <!-- <td><input type="checkbox" style="width:20px;height: 20px;" class="form-control input-sm"  class="checkbox" /></td> -->
                            <td><?php echo e(show_datetime($withdraw->created_at)); ?></td>

                            <td class="font-weight-bold"><?php echo e(strtoupper($withdraw->trx)); ?></td>
<?php


$totalAmount=$totalAmount+formatter_money($withdraw->amount);
$totalCharge=$totalCharge+formatter_money($withdraw->charge);
$totalPayableAmount=$totalPayableAmount+($withdraw->amount - $withdraw->charge);


?>
 <?php
                        $userName="";
$result=\App\User::where("id","=",$withdraw->id)->get();
if($result){

    foreach($result as $r){
if($r){
        $userName=$r->username;
    }
    }
}
?>

                            <td><a href="<?php echo e(route('admin.users.detail', $withdraw->user_id)); ?>"><?php echo e($userName); ?> </a></td>
                

                            <td><?php echo e($withdraw->method->name); ?></td>

                            <td class="budget"><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($withdraw->amount)); ?></td>

                            <td class="budget text-danger"><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($withdraw->charge)); ?></td>

                            <?php $payable = $withdraw->amount - $withdraw->charge; ?>
                            <td class="budget"><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($payable)); ?></td>

<?php 

$totalCurrency=$totalCurrency+ formatter_money($withdraw->rate * $payable);
?>
                            <td class="budget"><?php echo e($withdraw->currency); ?><?php echo e(formatter_money($withdraw->rate * $payable)); ?></td>
                            <?php if(request()->routeIs('admin.withdraw.pending')): ?>
                            <td>
                                <button class="btn btn-success approveBtn" data-id="<?php echo e($withdraw->id); ?>" data-amount="<?php echo e($general->cur_sym); ?><?php echo e(formatter_money($withdraw->amount)); ?>" data-username="<?php echo e($withdraw->user->username); ?>" data-date="<?php echo e(show_datetime($withdraw->created_at)); ?>" data-code="<?php echo e(strtoupper($withdraw->trx)); ?>"  data-mehtod="<?php echo e($withdraw->method->name); ?>"    data-amount="<?php echo e($general->cur_sym); ?><?php echo e(formatter_money($withdraw->amount)); ?>"  data-charge="<?php echo e($general->cur_sym); ?><?php echo e(formatter_money($withdraw->charge)); ?>"  data-pay="<?php echo e($general->cur_sym); ?><?php echo e(formatter_money($payable)); ?>"  data-currency="<?php echo e($withdraw->currency); ?><?php echo e(formatter_money($withdraw->rate * $payable)); ?>"

                                    ><i class="fa fa-fw fa-check"></i></button>
                                <button class="btn btn-danger rejectBtn" data-id="<?php echo e($withdraw->id); ?>" data-amount="<?php echo e($general->cur_sym); ?><?php echo e(formatter_money($withdraw->amount)); ?>" data-username="<?php echo e($withdraw->user->username); ?>"><i class="fa fa-fw fa-ban"></i></button>
                                <?php if(!empty($withdraw->detail)): ?>
                                <button class="btn btn-info viewBtn" data-ud="<?php echo e(json_encode($withdraw->detail)); ?>" ><i class="fa fa-fw fa-eye"></i></button>
                                <?php endif; ?>
                            </td>
                            <?php elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search')): ?>
                            <td>

                                <?php if($withdraw->status == 1): ?>
                                <span class="badge badge-success">Approved</span>
                                <?php elseif($withdraw->status == 3): ?>
                                    <span class="badge badge-danger">Rejected</span>
                                    <?php else: ?>
                                    <span class="badge badge-warning">Pending</span>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>

                        </tr>
                       
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

   <tfoot><thead >
                            
                            <th colspan="9">
                                <center>

                                <?php
echo "<h7>"." Total Amount  <b>: ".$totalAmount."  </b>"."</h7>"."<br>";
echo "<h7>"." Total Charges  <b>: ".$totalCharge."  </b>"."</h7>"."<br>";
echo "<h7>"." Total Payable <b>:  ". $totalPayableAmount." </b>"."</h7>"."<br>";
echo "<h7>"." Total In Method Currency <b>:  ". $totalCurrency." </b>"."</h7>";
                                ?>
</center>
                            </th>
                        </thead></tfoot>


                </table>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    <?php echo e($withdrawals->appends($_GET)->links()); ?>

                </nav>
            </div>
        </div>
    </div>
</div>


<div class="row col-md-12">
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <input type="submit" class="btn btn-block btn-primary mt-2" value="<?php echo app('translator')->get('Print Selected'); ?>" id = "btnGet"  />

    </div>
        <div class="col-md-3">
<input type="submit" class="btn btn-block btn-primary mt-2" value="<?php echo app('translator')->get('Print All'); ?>" onclick="printData()" />

                                               </div>
</div>


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

<div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Withdrawal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.withdraw.approve')); ?>" method="POST">
                <?php echo csrf_field(); ?>
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


<div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Withdrawal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.withdraw.reject')); ?>" method="POST">
                <?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
    var path = `<?php echo e(asset(config('constants.withdraw.verify.path'))); ?>`;
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<?php if(request()->routeIs('admin.users.withdrawals')): ?>

<form action="" method="GET" class="form-inline">
    <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="Withdrawal code" value="<?php echo e($search ?? ''); ?>">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
<?php else: ?>
<form action="<?php echo e(route('admin.withdraw.search', $scope ?? str_replace('admin.withdraw.', '', request()->route()->getName()))); ?>" method="GET" class="form-inline">
    <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="Withdrawal code/Username" value="<?php echo e($search ?? ''); ?>">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
<?php endif; ?>
<?php $__env->stopPush(); ?>


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


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/withdraw/withdrawals.blade.php ENDPATH**/ ?>