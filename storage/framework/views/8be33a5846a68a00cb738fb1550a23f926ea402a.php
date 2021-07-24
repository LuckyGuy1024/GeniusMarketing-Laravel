<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo app('translator')->get('Ticket'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Subject'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                            <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><span><?php echo e($item->ticket); ?></span></td>
                                <td><span><?php echo e($item->subject); ?></span></td>
                                <td>
                                    <?php if($item->status == 0): ?>
                                        <span class="badge badge-danger"><?php echo app('translator')->get('Close'); ?></span>
                                    <?php else: ?>
                                        <?php
                                        $reply = \App\SupportTicketComment::orderBy('id', 'DESC')->where('ticket_id', $item->id)->first();
                                        ?>
                                    <?php if($reply->type == 0): ?>
                                            <span class="badge badge-primary"><?php echo app('translator')->get('your reply'); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-info"><?php echo app('translator')->get('admin reply'); ?></span>
                                    <?php endif; ?>


                                        <span class="badge badge-success"><?php echo app('translator')->get('Open'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($item->status == 1): ?>
                                        <button type="button" data-action="<?php echo e(route('user.ticket.close', $item->id)); ?>" class="btn btn-rounded btn-danger closeBtn"><i class="fa fa-fw fa-times"></i> <?php echo app('translator')->get('Close Ticket'); ?></button>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('user.ticket.detail', [$item->id, slug($item->ticket)])); ?>" class="btn btn-rounded btn-primary replyBtn"><i class="fa fa-reply"></i> <?php echo app('translator')->get('Reply'); ?></a>
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

                        <?php echo e($tickets->appends($_GET)->links()); ?>

                    </nav>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('New Ticket'); ?></h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('user.ticket.new')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Subject'); ?></label>
                            <input type="text" class="form-control" name="subject" value="<?php echo e(old('subject')); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Message'); ?></label>
                            <textarea rows="5" class="form-control" name="message"><?php echo e(old('message')); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-success"><?php echo app('translator')->get('Open Ticket'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Close Modal -->
    <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content  ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Close Ticket'); ?></h5>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('By closing this ticket you ensure your problem has been solved'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><?php echo app('translator')->get('Close Ticket'); ?></button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a class="btn btn-success " data-target="#ticketModal" data-toggle="modal"><i class="fa fa-fw fa-plus"></i>Open Ticket</a>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('js'); ?>
    <script>
        $('.closeBtn').on('click', function() {
            var modal = $('#closeModal');
            modal.find('form').attr('action', $(this).data('action'));
            modal.modal('show');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/user/support/ticket.blade.php ENDPATH**/ ?>