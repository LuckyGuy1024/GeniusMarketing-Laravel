<?php $__env->startSection('panel'); ?>



    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Gateway</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                    <?php $__empty_1 = true; $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="<?php echo e(route('admin.deposit.manual.edit', $gateway->code)); ?>" class="avatar avatar-sm rounded-circle mr-3">
                                        <img src="<?php echo e(get_image(config('constants.deposit.gateway.path') .'/'. $gateway->image)); ?>" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <span class="name mb-0"><?php echo e($gateway->name); ?></span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge badge-dot">
                                    <?php if($gateway->status == 1): ?>
                                        <i class="bg-success"></i>
                                        <span class="status">active</span>
                                    <?php else: ?>
                                        <i class="bg-danger"></i>
                                        <span class="status">disabled</span>
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.deposit.manual.edit', $gateway->code)); ?>" class="btn btn-info btn-icon editGatewayBtn"><i class="fa fa-fw fa-pencil"></i></a>
                                <?php if($gateway->status == 0): ?>
                                    <button class="btn btn-success activateBtn" data-code="<?php echo e($gateway->code); ?>" data-name="<?php echo e($gateway->name); ?>" data-toggle="modal" data-target="#activateModal"><i class="fa fa-fw fa-eye"></i></button>
                                <?php else: ?>
                                    <button class="btn btn-danger deactivateBtn" data-code="<?php echo e($gateway->code); ?>" data-name="<?php echo e($gateway->name); ?>" data-toggle="modal" data-target="#deactivateModal"><i class="fa fa-fw fa-eye-slash"></i></button>
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
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <?php echo e($gateways->links()); ?>

                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Method Activation Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.deposit.manual.activate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="code">
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
                    <h5 class="modal-title">Payment Method Disable Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.deposit.manual.deactivate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="code">
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
<a class="btn btn-success" href="<?php echo e(route('admin.deposit.manual.create')); ?>"><i class="fa fa-fw fa-plus"></i>Add New</a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    $('.activateBtn').on('click', function() {
        var modal = $('#activateModal');
        modal.find('.method-name').text($(this).data('name'));
        modal.find('input[name=code]').val($(this).data('code'));
    });

    $('.deactivateBtn').on('click', function() {
        var modal = $('#deactivateModal');
        modal.find('.method-name').text($(this).data('name'));
        modal.find('input[name=code]').val($(this).data('code'));
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/deposit/list.blade.php ENDPATH**/ ?>