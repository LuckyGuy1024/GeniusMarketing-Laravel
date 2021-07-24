<?php $__env->startSection('panel'); ?>
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>" class="avatar avatar-sm rounded-circle mr-3">
                                        <img src="<?php echo e(get_image(config('constants.user.profile.path') .'/'. $user->image)); ?>" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>"><span class="name mb-0"><?php echo e($user->fullname); ?></span></a>
                                    </div>

                                </div>
                            </td>
                            <td><a href="<?php echo e(route('admin.users.detail', $user->id)); ?>"><?php echo e($user->username); ?></a></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->mobile); ?></td>
                            <td><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($user->balance)); ?></td>
                            <td><a href="<?php echo e(route('admin.users.detail', $user->id)); ?>" class="btn btn-rounded btn-primary text-white"><i class="fa fa-fw fa-desktop"></i></a></td>
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
                    <?php echo e($users->links()); ?>

                </nav>
            </div>
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="<?php echo e(route('admin.users.search', $scope ?? str_replace('admin.users.', '', request()->route()->getName()))); ?>" method="GET" class="form-inline">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="Username or email" value="<?php echo e($search ?? ''); ?>">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/users/users.blade.php ENDPATH**/ ?>