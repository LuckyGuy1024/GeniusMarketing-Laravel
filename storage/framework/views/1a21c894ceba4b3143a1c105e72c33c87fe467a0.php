<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    <div class="row">
        <?php $__currentLoopData = $gatewayCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <img src="<?php echo e($data->methodImage()); ?>" class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e(__($data->name)); ?></h5>
                   <hr>

                    <a href="#" data-toggle="modal" data-currency="<?php echo e($data->currency); ?>"
                       data-min_amount="<?php echo e(formatter_money($data->min_amount)); ?> "
                       data-max_amount=" <?php echo e(formatter_money($data->max_amount)); ?> "
                       data-fcharge=" <?php echo e(formatter_money($data->fixed_charge)); ?>"
                       data-pcharge="<?php echo e(formatter_money($data->percent_charge)); ?> %"
                       data-method_code="<?php echo e($data->method_code); ?>"
                       class="btn btn-primary  deposit"
                       ><?php echo app('translator')->get('Deposit Now'); ?></a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>






    <!-- Modal -->
    <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content blue-bg ">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel" style="color: black"><?php echo app('translator')->get('Choose amount'); ?></h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('user.deposit.insert')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body text-center">
                        <input type="hidden" name="currency" class="edit-currency" value="">
                        <input type="hidden" name="method_code" class="edit-method-code" value="">




                        <strong style="color: black"><?php echo app('translator')->get('Limit'); ?>
                            :<span class="min_amount"></span>  -
                            <span class="max_amount"></span> <?php echo e($general->cur_text); ?> </strong>

                        <div class="form-group text-left">
                            <label ><?php echo app('translator')->get('Amount'); ?></label>


                            <div class="input-group mb-2">

                                <input type="text" class="form-control" name="amount" value="<?php echo e(old('amount')); ?>">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><?php echo e($general->cur_text); ?></div>
                                </div>
                            </div>

                        </div>

                        <strong style="color: black;"> <?php echo app('translator')->get('Charge'); ?>  :<?php echo e($general->cur_text); ?> <span class="fcharge"></span>  -
                            <span class="pcharge"></span> </strong>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Confirm'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>

        $('.deposit').on('click', function () {
            var modal = $('#depositModal');
            $('.edit-currency').val($(this).data('currency'));
            $('.currency').text($(this).data('currency'));
            $('.edit-method-code').val($(this).data('method_code'));
            modal.find('.fcharge').text($(this).data('fcharge'));
            modal.find('.pcharge').text($(this).data('pcharge'));
            modal.find('.min_amount').text($(this).data('min_amount'));
            modal.find('.max_amount').text($(this).data('max_amount'));
            modal.modal('show');
        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/payment/deposit.blade.php ENDPATH**/ ?>