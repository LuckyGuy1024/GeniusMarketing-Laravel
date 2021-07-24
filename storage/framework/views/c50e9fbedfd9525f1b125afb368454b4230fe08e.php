<?php $__env->startPush('style'); ?>
    <style>
        #code {
            font-size: 40px;
            font-weight: 900;
            text-align: center;
            height: 100% !important;
            width: 100% !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <form action="<?php echo e(route('user.pin.recharge.post')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <input class="form-control input-lg" id="code" value=""  pat tern=".{35,35}" name="pin" maxlength="35" autocomplete="off" type="tel" Placeholder='<?php echo app('translator')->get('ENTER PIN'); ?>' required />
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-block btn-primary mr-2"><?php echo app('translator')->get('RECHARGE NOW'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>









    <div class="row">

        <div class="col-lg-12">
            <h3 style="padding-left:20px" class="card-header">
                <?php echo app('translator')->get('My created E-Pin'); ?>
                <a href="#createEpinModal" data-toggle="modal" class="btn btn-success  float-right"><?php echo app('translator')->get('Create New E-Pin'); ?></a>
            </h3>


<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="<?php echo e(route('user.pin.recharge.date')); ?>" style="width:100% !important;">
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



            
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Pin'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        </tr>
                        </thead>
                        <?php 
$totalAmount=0;
$totalAmountAfterBalance=0;
                            ?>
                    

            

                        <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $epin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                    <?php
$totalAmount=$totalAmount+formatter_money($data->amount);

                        ?>
                            <tr>
                                <td><?php echo e($general->cur_sym); ?><?php echo e($data->amount); ?></td>
                                <td><?php echo e($data->pin); ?></td>
                                <td><?php if($data->status == 1): ?> <span class="badge badge-success"><?php echo app('translator')->get('Not Used'); ?></span> <?php else: ?> <span class="badge badge-warning"><?php echo app('translator')->get('Used'); ?></span> <?php endif; ?></td>
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

                        <?php echo e($epin->links()); ?>

                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createEpinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> <?php echo app('translator')->get('Create New Pin'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form  method="post" action="<?php echo e(route('user.pin.generate')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body text-center">

                        <strong class="text-center"><?php echo app('translator')->get('Amount'); ?></strong>
                        <div class="input-group">
                            <input type="text" class="form-control input-lg" name="amount">
                            <div class="input-group-append">
                            <span class="input-group-text">
                                <?php echo e(__($general->cur_sym)); ?>

                            </span>
                            </div>

                        </div>
                        <small class="text-center text-danger"><?php echo app('translator')->get('This amount will subtract from your wallet and generate new pin.'); ?></small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-primary bold uppercase"><i class="fa fa-send"></i> <?php echo app('translator')->get('Generate'); ?></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo app('translator')->get('Close'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        $('#code').on('keypress change', function () {
            var xx = document.getElementById('code').value;
            // if (xx.length < 32) {
            if (xx.length < 10) {
                $(this).val(function (index, value) {
                    return value.replace(/\W/gi, '').replace(/(.{8})/g, '$1-');
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2//user/pin_recharge.blade.php ENDPATH**/ ?>