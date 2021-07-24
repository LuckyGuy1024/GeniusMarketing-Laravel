<?php $__env->startPush('style'); ?>



<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>



<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="<?php echo e(route('user.withdraw.history.date')); ?>" style="width:100% !important;">
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

                            <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Withdraw Id'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Method'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Delay'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        </tr>
                        </thead>
                        <tbody >


                            <?php 
$totalAmount=0;
$totalAmountAfterBalance=0;
                            ?>
                      


                        <?php $now = \Carbon\Carbon::now(); ?>
                        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                                <?php
$totalAmount=$totalAmount+formatter_money($withdraw->amount);

                        ?>
                            <tr>
                                <td><?php echo e(show_datetime($withdraw->created_at)); ?></td>
                                <td ><?php echo e(strtoupper($withdraw->trx)); ?></td>
                                <td><?php echo e($withdraw->method->name); ?></td>
                                <td ><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($withdraw->amount)); ?></td>
                                <td ><?php echo e($withdraw->delay); ?></td>
                                <td>
                                    <?php if($withdraw->status == 3): ?>
                                        <label class="badge badge-danger"><?php echo app('translator')->get('Reject'); ?></label>
                                    <?php elseif($withdraw->status == 2): ?>
                                        <label class="badge badge-warning"><?php echo app('translator')->get('Pending'); ?></label>
                                    <?php elseif($withdraw->status == 1): ?>
                                        <label class="badge badge-success"><?php echo app('translator')->get('Complete'); ?></label>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="text-muted text-center" colspan="100%"><?php echo e($empty_message); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>


                            <tfoot><thead >
                            
                            <th colspan="6">
                                <center>

                                <?php
echo "<h7>"." Total Amount  <b>: ".$totalAmount."  </b>"."</h7>"."<br>";

                                ?>
</center>
                            </th>
                        </thead></tfoot>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <?php echo e($logs->links()); ?>

                    </nav>
                </div>

            </div>
        </div>

<div class="row col-md-12">
    <div class="col-md-9"></div>
        <div class="col-md-3">
<input type="submit" class="btn btn-block btn-primary mt-2"
                                                   value="<?php echo app('translator')->get('Print'); ?>" onclick="printData()" />

                                               </div>
</div>



    </div>


<?php $__env->stopSection(); ?>

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
<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/user/withdraw_history.blade.php ENDPATH**/ ?>