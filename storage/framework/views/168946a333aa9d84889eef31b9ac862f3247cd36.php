<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = $purchased_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="row">

        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

     <!--    foreach($purchased_plans as $purchase) -->

            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                <div class="pricingTable">
                    <div class="pricingTable-header">
                        <h3 class="title"><?php echo app('translator')->get($data->name); ?></h3>
                    </div>
                    <div class="price-value">
                        <span class="currency"><?php echo e($general->cur_sym); ?></span>
                        <span class="amount"><?php echo e($data->price); ?></span>
                    </div>
                    <div class="price-body text-center">
                        <ul class="margin-bottom-30">
                            <li>
                               <h4 class="pb-3"> <?php echo app('translator')->get('Direct Referral Bonus'); ?> </h4>
                                
                                             <h5> <?php echo e($general->cur_sym); ?><?php echo e($data->ref_bonus); ?> <span
                                            class='sec-color'> <?php echo app('translator')->get('No Limit'); ?></span> </h5> 
                            </li>


 <li> <strong>  <?php echo app('translator')->get('Days '); ?>
                                        : <?php echo e($data->days); ?>

                                      </strong>
                                    </li>


                                    </li>

                            <?php $total = 0; ?>
                            <?php $__currentLoopData = $data->plan_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key+1 <= $general->matrix_height): ?>
                                   <!--  <li>
                                        <strong>  <?php echo app('translator')->get('L'.$lv->level.' '); ?>
                                        : <?php echo e($general->cur_sym); ?> <?php echo e($lv->amount); ?>

                                        X <?php echo e(pow($general->matrix_width,$key+1)); ?> <i class="fa fa-users"></i> =
                                       <?php echo e($general->cur_sym); ?><?php echo e($lv->amount*pow($general->matrix_width,$key+1)); ?></strong>
                                    </li> -->
                                    <?php $total += $lv->amount ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         

                            <li>
                                <?php
                                    $per = intval($total/$data->price*100);
                                ?>

                                <strong><?php echo app('translator')->get('Return '); ?>  <span class="sec-color"><?php echo e($data->roi); ?>%</span> <?php echo app('translator')->get('of Invest'); ?></strong>
                            </li>



                        </ul>
                    </div>
                        <?php
                        $display="";
$result=\App\PurchasePlan::where("plan_id","=",$data->id)->where("user_id","=",Auth::user()->id)->get();
if($result !=null ||  $result!=""){
  foreach($result as $s ){

  if($s->id!="" || $$s->id!=null){
$display="display:none";
  }
  }
}
                        ?>

                        <?php if($display!=null || $display!= ""): ?>
                      <div cl ass="pricingTable-signup" class="btn btn-success"  > 
                        <a h ref="#confBuyModal<?php echo e($data->id); ?>" style="font-size: 14px !important;" data -toggle="modal" disabled="disabled"><?php echo app('translator')->get('Already Subscribed '); ?></a>
                    </div>

                        <?php else: ?>
                    <div class="pricingTable-signup" >
                        <a href="#confBuyModal<?php echo e($data->id); ?>" data-toggle="modal"><?php echo app('translator')->get('Subscribe Now'); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

                    <div class="modal fade" id="confBuyModal<?php echo e($data->id); ?>" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"> <?php echo app('translator')->get('Confirm Purchase '.$data->name); ?>?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-danger text-center"><?php echo e(__($data->price)); ?> <?php echo e($general->cur_text); ?> <?php echo app('translator')->get('will subtract from your balance'); ?></h5>
                        </div>
  


                        <form method="post" action="<?php echo e(route('user.plan.purchase')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="modal-footer">
                                <button type="submit" name="plan_id" value="<?php echo e($data->id); ?>"
                                        class="btn btn-primary bold uppercase"><i
                                            class="fa fa-send"></i> <?php echo app('translator')->get('Subscribe'); ?></button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="fa fa-times"></i> <?php echo app('translator')->get('Close'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('style'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2//user/plan.blade.php ENDPATH**/ ?>