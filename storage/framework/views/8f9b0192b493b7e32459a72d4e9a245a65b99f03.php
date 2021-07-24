<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="<?php echo e(route('user.deposit.history.date')); ?>" style="width:100% !important;">
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
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>

                            <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('TRX'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Method'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        </tr>
                        </thead>
                        <tbody >

                                                    <?php 
$totalAmount=0;
$totalAmountAfterBalance=0;
                            ?>
                    


                        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                        <?php
$totalAmount=$totalAmount+formatter_money($item->amount);
                        ?>
                            <tr>
                                <td><?php echo e(show_datetime($item->created_at)); ?></td>
                                <td><?php echo e($item->trx); ?></td>
                                <td><?php echo e(__($item->gateway->name)); ?></td>
                                <td><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($item->amount)); ?> </td>
                                <td>
                                    <?php if($item->status == 1): ?>
                                        <span class="badge badge-success"><?php echo app('translator')->get('Complete'); ?></span>
                                    <?php elseif($item->status == 2): ?>
                                        <span class="badge badge-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                    <?php elseif($item->status == 3): ?>
                                        <span class="badge badge-danger"><?php echo app('translator')->get('Reject'); ?></span>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>
                                <td class="text-muted text-center" colspan="100%"><?php echo e(__('NO DATA FOUND')); ?></td>
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
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/user/deposit_history.blade.php ENDPATH**/ ?>