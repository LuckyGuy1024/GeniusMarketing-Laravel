<?php $__env->startSection('panel'); ?>
<div class="row">

    <?php $__currentLoopData = $plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- card start -->
        <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
            <div class="card <?php if($plugin->status == 1): ?> border-success <?php else: ?> border-danger <?php endif; ?> mb-3 withdraw-method-card">
                <div class="card-header <?php if($plugin->status == 1): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>"></div>
                <div class="card-body">
                    <div class="price-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <img src="<?php echo e(get_image(config('constants.plugin.path') .'/'. $plugin->image)); ?>" alt="<?php echo e($plugin->name); ?>" style="width: auto; height: 65px;">
                            </div>
                            <div class="col-md-6">
                                <h5><?php echo e($plugin->name); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-primary editBtn" data-name="<?php echo e($plugin->name); ?>" data-shortcode="<?php echo e(json_encode($plugin->shortcode)); ?>" data-action="<?php echo e(route('admin.plugin.update', $plugin->id)); ?>"><i class="fa fa-fw fa-pencil"></i>Edit</button>
                    <button class="btn btn-dark helpBtn" data-description="<?php echo e($plugin->description); ?>" data-support="<?php echo e($plugin->support); ?>">Help<i class="fa fa-fw fa-question"></i></button>
                    <?php if($plugin->status == 0): ?>                                                
                        <button class="btn btn-success activateBtn" data-id="<?php echo e($plugin->id); ?>" data-name="<?php echo e($plugin->name); ?>" data-toggle="modal" data-target="#activateModal"><i class="fa fa-fw fa-eye"></i>Enable</button>
                    <?php else: ?>
                        <button class="btn btn-danger deactivateBtn" data-id="<?php echo e($plugin->id); ?>" data-name="<?php echo e($plugin->name); ?>" data-toggle="modal" data-target="#deactivateModal"><i class="fa fa-fw fa-eye-slash"></i>Disable</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- card end -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Plugin: <span class="plugin-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <?php echo csrf_field(); ?>       
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12 control-label font-weight-bold">Script <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <textarea name="script" class="form-control" rows="8" placeholder="Paste your script with proper key"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editBtn">Update</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Plugin Activation Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.plugin.activate')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to activate <span class="font-weight-bold plugin-name"></span> plugin?</p>
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
                <h5 class="modal-title">Plugin Disable Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('admin.plugin.deactivate')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>Are you sure to disable <span class="font-weight-bold plugin-name"></span> plugin?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Disable</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="helpModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Need Help?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
<style>
.withdraw-method-card .card-header {
    padding: 0.4rem;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>

$('.activateBtn').on('click', function() {
    var modal = $('#activateModal');
    modal.find('.plugin-name').text($(this).data('name'));
    modal.find('input[name=id]').val($(this).data('id'));
});

$('.deactivateBtn').on('click', function() {
    var modal = $('#deactivateModal');
    modal.find('.plugin-name').text($(this).data('name'));
    modal.find('input[name=id]').val($(this).data('id'));
});

$('.editBtn').on('click', function() {
    var modal = $('#editModal');
    var shortcode = $(this).data('shortcode');

    modal.find('.plugin-name').text($(this).data('name'));
    modal.find('form').attr('action', $(this).data('action'));

    var html = '';
    $.each(shortcode, function(key, item){
        html += `<div class="form-group">
                        <label class="col-md-12 control-label font-weight-bold">${item.title}<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input name="${key}" class="form-control" placeholder="--" value="${item.value}" required>
                        </div>
                    </div>`;
    })
    modal.find('.modal-body').html(html);

    modal.modal('show');
});

$('.helpBtn').on('click', function() {
    var modal = $('#helpModal');
    var path = "<?php echo e(asset(config('constants.plugin.path'))); ?>";
    modal.find('.modal-body').html(`<div class="mb-2">${$(this).data('description')}</div>`);
    modal.find('.modal-body').append(`<img src="${path}/${$(this).data('support')}"></img>`);
    modal.modal('show');
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/admin/plugin.blade.php ENDPATH**/ ?>