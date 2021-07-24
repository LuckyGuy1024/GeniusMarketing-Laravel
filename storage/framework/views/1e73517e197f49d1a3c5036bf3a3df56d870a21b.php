<?php $__env->startSection('panel'); ?>
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Method</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Withdraw Limit</th>
                            <th scope="col">Processing Delay</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="<?php echo e(route('admin.withdraw.method.edit', $method->id)); ?>" class="avatar avatar-sm rounded-circle mr-3">
                                        <img src="<?php echo e(get_image(config('constants.withdraw.method.path') .'/'. $method->image)); ?>" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <span class="name mb-0">
                                            <a href="<?php echo e(route('admin.withdraw.method.edit', $method->id)); ?>" class="avatar avatar-sm rounded-circle mr-3"><?php echo e($method->name); ?></a>
                                        </span>
                                    </div>

                                </div>
                            </td>
                            <td><?php echo e($method->currency); ?></td>
                            <td class="budget"><?php echo e(formatter_money($method->fixed_charge, $method->currency)); ?> + <?php echo e(formatter_money($method->percent_charge)); ?>%</td>
                            <td class="budget"><?php echo e(formatter_money($method->min_limit, $method->currency)); ?> - <?php echo e(formatter_money($method->max_limit, $method->currency)); ?></td>
                            <td><?php echo e($method->delay); ?></td>
                            <td>
                                <span class="badge badge-dot">
                                    <?php if($method->status == 1): ?>
                                        <i class="bg-success"></i>
                                        <span class="status">active</span>
                                    <?php else: ?>
                                        <i class="bg-danger"></i>
                                        <span class="status">disabled</span>
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo e(route('admin.withdraw.method.update', $method->id)); ?>"><i class="fa fa-pencil"></i></a>
                                <?php if($method->status == 1): ?>
                                    <button class="btn btn-danger deactivateBtn" data-id="<?php echo e($method->id); ?>" data-name="<?php echo e($method->name); ?>"><i class="fa fa-eye-slash"></i></button>
                                <?php else: ?>
                                    <button class="btn btn-success activateBtn" data-id="<?php echo e($method->id); ?>" data-name="<?php echo e($method->name); ?>"><i class="fa fa-eye"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="text-muted text-center" colspan="100%"><?php echo e($empty_message); ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    <?php echo e($methods->links()); ?>

                </nav>
            </div>
        </div>
    </div>
</div>

<div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdrawal Method Activation Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.withdraw.method.activate')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to activate <span class="font-weight-bold method-name"></span> method?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Activate</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdrawal Method Disable Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.withdraw.method.deactivate')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to disable <span class="font-weight-bold method-name"></span> method?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Disable</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a class="btn btn-success" href="<?php echo e(route('admin.withdraw.method.create')); ?>"><i class="fa fa-fw fa-plus"></i>Add New</a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
$('.activateBtn').on('click', function() {
    var modal = $('#activateModal');
    modal.find('.method-name').text($(this).data('name'));
    modal.find('input[name=id]').val($(this).data('id'));
    modal.modal('show');
});

$('.deactivateBtn').on('click', function() {
    var modal = $('#deactivateModal');
    modal.find('.method-name').text($(this).data('name'));
    modal.find('input[name=id]').val($(this).data('id'))
    modal.modal('show');
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/withdraw/methods.blade.php ENDPATH**/ ?>