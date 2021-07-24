 

<?php $__env->startSection('panel'); ?>



<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <form action="<?php echo e(route('admin.frontend.update', $titles->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Section Title" value="<?php echo e($titles->value->title); ?>">
                    </div>
                    <div class="form-group">
                        <label>SubTitle</label>
                        <input type="text" name="subtitle" class="form-control"  placeholder="Section Sub-Title" value="<?php echo e($titles->value->subtitle); ?>">
                    </div>
                </div>
                <div class="card-footer py-4">
                    <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                </div>
            </form>


        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Icon</th>
                            <th scope="col">Title</th>
                            <th scope="col">Subtitle</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo $item->value->icon; ?></td>
                            <td><?php echo e($item->value->title); ?></td>
                            <td><?php echo e($item->value->sub_title); ?></td>
                            <td>
                                <button type="button" class="btn btn-rounded btn-primary editBtn" data-title="<?php echo e($item->value->title); ?>" data-icon="<?php echo e($item->value->icon); ?>" data-sub_title="<?php echo e($item->value->sub_title); ?>" data-action="<?php echo e(route('admin.frontend.update', $item->id)); ?>"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger removeBtn" data-id="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i></button>
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
                    <?php echo e($services->links()); ?>

                </nav>
            </div>

        </div>
    </div>
</div>


<div id="newModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Social Icon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.frontend.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="key" value="service.item">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input type="text" class="form-control" name="sub_title" required>
                    </div>

                    <div class="form-group">
                        <label>Icon</label>
                        <div class="input-group has_append">
                            <input type="text" class="form-control" name="icon" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary iconPicker" data-icon="fas fa-home" role="iconpicker"></button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Social Icon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="key" value="service.item">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label>Subtitle</label>
                        <input type="text" class="form-control" name="sub_title" required>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <div class="input-group has_append">
                            <input type="text" class="form-control" name="icon" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary iconPicker"     data-icon="fas fa-home" role="iconpicker"></button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Social Icon Removal Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.frontend.remove')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to remove this icon?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Remove</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<button type="button" data-target="#newModal" data-toggle="modal" class="btn btn-success"><i class="fa fa-fw fa-plus"></i>Add New</button>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-iconpicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

<script>
    $('.removeBtn').on('click', function() {
        var modal = $('#removeModal');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

    $('.editBtn').on('click', function() {
        var modal = $('#editModal');
        modal.find('input[name=title]').val($(this).data('title'));
        modal.find('input[name=icon]').val($(this).data('icon'));
        modal.find('input[name=sub_title]').val($(this).data('sub_title'));
        modal.find('form').attr('action', $(this).data('action'));
        modal.modal('show');
    });

    $('#editModal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });
    $('#newModal').on('shown.bs.modal', function (e) { $(document).off('focusin.modal'); });

    $('.iconPicker').iconpicker({
        align: 'center', // Only in div tag
        arrowClass: 'btn-danger',
        arrowPrevIconClass: 'fas fa-angle-left',
        arrowNextIconClass: 'fas fa-angle-right',
        cols: 10,
        footer: true,
        header: true,
        icon: 'fas fa-bomb',
        iconset: 'fontawesome5',
        labelHeader: '{0} of {1} pages',
        labelFooter: '{0} - {1} of {2} icons',
        placement: 'bottom', // Only in button tag
        rows: 5,
        search: false,
        searchText: 'Search icon',
        selectedClass: 'btn-success',
        unselectedClass: ''
    }).on('change', function(e){
        $(this).parent().siblings('input[name=icon]').val(`<i class="${e.icon}"></i>`);
    });
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/frontend/service/index.blade.php ENDPATH**/ ?>