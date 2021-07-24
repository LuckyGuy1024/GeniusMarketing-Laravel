<?php $__env->startPush('style'); ?>
    <style>
        .custom-size{
            height: 160px !important;
            font-size: 140px;
            font-weight: 700;
            color: red;
            text-align: center;
            background-color: #000036;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('panel'); ?>

    <div class="row mb-5">




        <div class="col-md-6 offset-md-3">
            <div class="card">
                <h3 class="card-header text-center"><?php echo app('translator')->get('Set Height & Width of MATRIX'); ?></h3>
                <div class="card-body">
                    <form role="form" method="POST" action="<?php echo e(route('admin.matrix.update')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong><?php echo app('translator')->get('Matrix Height'); ?> <small>(<?php echo app('translator')->get('Should Be Numeric'); ?>)</small></strong>
                                <input type="text" class="form-control custom-size input-lg" value="<?php echo e($general->matrix_height); ?>" name="matrix_height">
                            </div>

                            <div class="form-group col-md-6">
                                <strong><?php echo app('translator')->get('Matrix Width'); ?> <small>(<?php echo app('translator')->get('Should Be Numeric'); ?>)</small></strong>
                                <input type="text" class="form-control custom-size input-lg" value="<?php echo e($general->matrix_width); ?>" name="matrix_width">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo app('translator')->get('Update'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="row">



        <div class="col-md-12">

            <div class="card">
                <h3 class="card-header"> <?php echo app('translator')->get($page_title); ?>

                    <div class="caption font-dark float-right">
                        <i class="icon-settings font-dark"></i>
                        <a href="<?php echo e(route('admin.plan.create')); ?>" class="btn btn-primary bold"><i class="fa fa-plus"></i> <?php echo app('translator')->get('Add New'); ?> </a>
                    </div>

                </h3>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Plan Price'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Referral Bonus'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Level Bonus'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($data->name); ?></td>
                            <td><?php echo e($data->price); ?> <?php echo e($general->currency); ?></td>
                            <td><?php echo e($data->ref_bonus); ?> <?php echo e($general->currency); ?></td>
                            <td>
                                <a href="#levComModal<?php echo e($data->id); ?>" data-toggle="modal" class="btn btn-info btn-block">
                                    <i class="fa fa-eye"></i> <?php echo app('translator')->get('PROMO'); ?>
                                </a>
                            </td>
                            <td>
                                <?php if($data->status == 1): ?>
                                    <span class="badge badge-success"><?php echo app('translator')->get('Active'); ?></span>
                                    <?php else: ?>
                                    <span class="badge badge-danger"><?php echo app('translator')->get('Deactive'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><a href="<?php echo e(route('admin.plan.edit', $data->id)); ?>" class="btn btn-primary btn-block"><?php echo app('translator')->get('Edit'); ?></a></td>
                        </tr>
                        <div class="modal fade" id="levComModal<?php echo e($data->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel"> <?php echo app('translator')->get($data->name.' Level Commissions'); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul  class="list-group">
                                            <?php $__currentLoopData = $data->plan_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-group-item">
                                                    <p class="text-center"><?php echo app('translator')->get('PROMO '); ?><?php echo e($lv->level); ?> : <?php echo e($lv->amount); ?> <?php echo e($general->currency); ?></p>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo app('translator')->get('Close'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/plan/index.blade.php ENDPATH**/ ?>