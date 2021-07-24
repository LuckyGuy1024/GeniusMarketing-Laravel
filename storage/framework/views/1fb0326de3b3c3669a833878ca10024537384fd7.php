<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="card-title font-weight-normal"><?php echo app('translator')->get('Referrer Link'); ?></h4>
                </div>

                <div class="card-body">

                    <form id="copyBoard" >
                        <div class="form-row align-items-center">
                            <div class="col-md-10 my-1">
                                <input value="<?php echo e(url('/')); ?>/user/register/<?php echo e(auth()->user()->ref_link); ?>" type="url" id="ref" class="form-control from-control-lg" readonly>
                            </div>
                            <div class="col-md-2 my-1">
                                <button   type="button" @click="copyBtnClick" data-copytarget="#ref" id="copybtn" class="btn btn-primary btn-block"> <i class="fa fa-copy"></i> Copy</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>


        </div>





<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="<?php echo e(route('user.ref.index.date')); ?>" style="width:100% !important;">
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
                            <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Email'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Plan'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Join date'); ?></th>
                        </tr>
                        </thead>


                        <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($data->firstname); ?> <?php echo e($data->lastname); ?></td>
                                <td><?php echo e($data->username); ?></td>
                                <td><?php echo e($data->email); ?></td>
                                <td>
                                    <?php $plan = \App\Plan::find($data->plan_id); ?>
                                    <?php if($plan != NULL): ?>
                                        <?php echo e($plan->name); ?>

                                    <?php else: ?>
                                        <?php echo app('translator')->get('N/A'); ?>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(show_datetime($data->created_at)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="text-muted text-center" colspan="100%"><?php echo e(__('NO DATA FOUND')); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>


                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        <?php echo e($referrals->links()); ?>

                    </nav>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        (function() {
            'use strict';
            document.body.addEventListener('click', copy, true);
            function copy(e) {
                var
                    t = e.target,
                    c = t.dataset.copytarget,
                    inp = (c ? document.querySelector(c) : null);
                if (inp && inp.select) {
                    inp.select();
                    try {
                        document.execCommand('copy');
                        inp.blur();
                        t.classList.add('copied');
                        setTimeout(function() { t.classList.remove('copied'); }, 1500);
                    }catch (err) {
                        alert('please press Ctrl/Cmd+C to copy');
                    }
                }
            }
        })();
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2//user/referrer.blade.php ENDPATH**/ ?>