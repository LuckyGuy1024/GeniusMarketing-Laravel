<?php $__env->startSection('panel'); ?>
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $sms_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($template->name); ?></td>
                                <td>
                                    <span class="badge badge-dot">
                                        <?php if($template->sms_status == 1): ?>
                                            <i class="bg-success"></i>
                                            <span class="status">active</span>
                                        <?php else: ?>
                                            <i class="bg-danger"></i>
                                            <span class="status">disabled</span>
                                        <?php endif; ?>
                                    </span>
                                </td>
                                <td><a href="<?php echo e(route('admin.sms-template.edit', $template->id)); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
                    <?php echo e($sms_templates->links()); ?>

                </nav>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/sms_template/index.blade.php ENDPATH**/ ?>