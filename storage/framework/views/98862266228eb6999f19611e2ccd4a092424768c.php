<?php $__env->startSection('content'); ?>
    <!--Start Dashboard Content-->

	<div class="card mt-3">
        <div class="card-content">
            <div class="row row-group m-0">
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0"><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($ref_com)); ?><span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           <div class="progress-bar" style="width:55%"></div>
                        </div>
                      <p class="mb-0 text-white small-font"><?php echo app('translator')->get('promo Bonus'); ?><span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0"><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($total_epin_recharge)); ?><span class="float-right"><i class="fa fa-usd"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           <div class="progress-bar" style="width:55%"></div>
                        </div>
                      <p class="mb-0 text-white small-font"><?php echo app('translator')->get('Total E-Pin Recharged'); ?><span class="float-right">+1.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0"><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($total_epin_generate)); ?><span class="float-right"><i class="fa fa-eye"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           <div class="progress-bar" style="width:55%"></div>
                        </div>
                      <p class="mb-0 text-white small-font"><?php echo app('translator')->get('Total E-Pin Generated'); ?><span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0"><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($total_bal_transfer)); ?><span class="float-right"><i class="fa fa-envira"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           <div class="progress-bar" style="width:55%"></div>
                        </div>
                      <p class="mb-0 text-white small-font"><?php echo app('translator')->get('Total Transferred Balance'); ?><span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
            </div>
        </div>
     </div>  
          
        <div class="row">
         <div class="col-12 col-lg-8 col-xl-8">
            <div class="card">
             <div class="card-header"><?php echo app('translator')->get('Direct Refferals'); ?>
               <div class="card-action">
                 <div class="dropdown">
                 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                  <i class="icon-options"></i>
                 </a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:void();">Action</a>
                    <a class="dropdown-item" href="javascript:void();">Another action</a>
                    <a class="dropdown-item" href="javascript:void();">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void();">Separated link</a>
                   </div>
                  </div>
               </div>
             </div>
             <div class="card-body">
                <ul class="list-inline">
                  <li class="list-inline-item"><i class="fa fa-circle mr-2 text-white"></i>Plan A</li>
                  <li class="list-inline-item"><i class="fa fa-circle mr-2 text-light"></i>Plan B</li>
                </ul>
                <div class="chart-container-1">
                  <canvas id="chart1"></canvas>
                </div>
             </div>
             
             <div class="row m-0 row-group text-center border-top border-light-3">
               <div class="col-12 col-lg-4">
                 <div class="p-3">
                   <h5 class="mb-0"><?php echo e($total_direct_ref); ?></h5>
                   <small class="mb-0">Overall Visitor <span> <i class="fa fa-arrow-up"></i> 2.43%</span></small>
                 </div>
               </div>
               <div class="col-12 col-lg-4">
                 <div class="p-3">
                   <h5 class="mb-0"><?php echo e($total_direct_ref); ?></h5>
                   <small class="mb-0">Visitor Duration <span> <i class="fa fa-arrow-up"></i> 12.65%</span></small>
                 </div>
               </div>
               <div class="col-12 col-lg-4">
                 <div class="p-3">
                   <h5 class="mb-0"><?php echo e($total_direct_ref); ?></h5>
                   <small class="mb-0">Pages/Visit <span> <i class="fa fa-arrow-up"></i> 5.62%</span></small>
                 </div>
               </div>
             </div>
             
            </div>
         </div>


         
         <div class="col-12 col-lg-4 col-xl-4">
            <div class="card">
               <div class="card-header">Account
                 <div class="card-action">
                 <div class="dropdown">
                 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                  <i class="icon-options"></i>
                 </a>
                  <div class="dropdown-menu dropdown-menu-right">
                   </div>
                  </div>
                 </div>
               </div>
               <div class="card-body">
                 <div class="chart-container-2">
                   <canvas id="chart2"></canvas>
                  </div>
               </div>
               <div class="table-responsive">
                 <table class="table align-items-center">
                   <tbody>
                     <tr>
                       <td><i class="fa fa-circle text-white mr-2"></i><?php echo app('translator')->get('Current Balance'); ?></td>
                       <td><?php echo e($general->cur_sym); ?><?php echo e(formatter_money(Auth::user()->balance)); ?></td>
                     </tr>
                     <tr>
                       <td><i class="fa fa-circle text-light-1 mr-2"></i><?php echo app('translator')->get('Total Deposit'); ?></td>
                       <td><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($total_deposit)); ?> </td>
                     </tr>
                     <tr>
                       <td><i class="fa fa-circle text-light-2 mr-2"></i><?php echo app('translator')->get('Total Withdraw'); ?></td>
                       <td><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($total_withdraw)); ?> </td>
                     </tr>
                     <tr>
                       <td><i class="fa fa-circle text-light-3 mr-2"></i><?php echo app('translator')->get('Refferal Commission'); ?></td>
                       <td><?php echo e($general->cur_sym); ?><?php echo e(formatter_money($level_com)); ?></td>
                     </tr>
                   </tbody>
                 </table>
               </div>
             </div>
         </div>
        </div><!--End Row-->
        
        <div class="row">
         <div class="col-12 col-lg-12">
           <div class="card">
             <div class="card-header">My Referrals
              <div class="card-action">
                 <div class="dropdown">
                 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                  <i class="icon-options"></i>
                 </a>
                  <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="javascript:void();">Action</a>
                  <a class="dropdown-item" href="javascript:void();">Another action</a>
                  <a class="dropdown-item" href="javascript:void();">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void();">Separated link</a>
                   </div>
                  </div>
                 </div>
             </div>


             


               <div class="table-responsive">
                     <table class="table align-items-center table-flush table-borderless">
                      <thead>
                       <tr>
                        <th scope="col"><?php echo app('translator')->get('First Name'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Last Name'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Email'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Plan'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Join date'); ?></th>
                       </tr>
                       </thead>
                       <tbody><?php $__empty_1 = true; $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($data->firstname); ?></td>
                            <td><?php echo e($data->lastname); ?></td>
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
                     </tbody></table>
                   </div>
           </div>
         </div>
        </div><!--End Row-->
    
          <!--End Dashboard Content-->
<!-- Bootstrap core JavaScript-->
<script src="<?php echo e(asset(activeTemplate(true)) . '/users/js/jquery.min.js'); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true)) . '/users/js/popper.min.js'); ?>"></script>
<script src="<?php echo e(asset(activeTemplate(true)) . '/users/js/bootstrap.min.js'); ?>"></script>

<!-- simplebar js -->
<script src="<?php echo e(asset(activeTemplate(true)) . '/users/plugins/simplebar/js/simplebar.js'); ?>"></script>
<!-- sidebar-menu js -->
<script src="<?php echo e(asset(activeTemplate(true)) . '/users/js/sidebar-menu.js'); ?>"></script>
<!-- loader scripts -->
<script src="<?php echo e(asset(activeTemplate(true)) . '/users/js/jquery.loading-indicator.js'); ?>"></script>
<!-- Custom scripts -->
<script src="<?php echo e(asset(activeTemplate(true)) . '/users/js/app-script.js'); ?>"></script>
<!-- Chart js -->

<script src="<?php echo e(asset(activeTemplate(true)) . '/users/plugins/Chart.js/Chart.min.js'); ?>"></script>

<!-- Index js -->
<script>
    $(function() {
    "use strict";

     // chart 1
	 
		  var ctx = document.getElementById('chart1').getContext('2d');
		
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
					datasets: [{
						label: 'New Visitor',
						data: [3, 3, 8, 5, 7, 4, 6, 4, 6, 3],
						backgroundColor: '#fff',
						borderColor: "transparent",
						pointRadius :"0",
						borderWidth: 3
					}, {
						label: 'Old Visitor',
						data: [7, 5, 14, 7, 12, 6, 10, 6, 11, 5],
						backgroundColor: "rgba(255, 255, 255, 0.25)",
						borderColor: "transparent",
						pointRadius :"0",
						borderWidth: 1
					}]
				},
			options: {
				maintainAspectRatio: false,
				legend: {
				  display: false,
				  labels: {
					fontColor: '#ddd',  
					boxWidth:40
				  }
				},
				tooltips: {
				  displayColors:false
				},	
			  scales: {
				  xAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#ddd'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(221, 221, 221, 0.08)"
					},
				  }],
				   yAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#ddd'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(221, 221, 221, 0.08)"
					},
				  }]
				 }

			 }
			});  
		
		
    // chart 2

		var ctx = document.getElementById("chart2").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["<?php echo app('translator')->get('Current Balance'); ?>", "<?php echo app('translator')->get('Total Deposit'); ?>", "<?php echo app('translator')->get('Total Withdraw'); ?>", "<?php echo app('translator')->get('Refferal Commission'); ?>"],
					datasets: [{
						backgroundColor: [
							"#ffffff",
							"rgba(255, 255, 255, 0.70)",
							"rgba(255, 255, 255, 0.50)",
							"rgba(255, 255, 255, 0.20)"
						],
						data: [<?php echo e(formatter_money(Auth::user()->balance)); ?>, <?php echo e(formatter_money($total_deposit)); ?>, <?php echo e(formatter_money($total_withdraw)); ?>, <?php echo e(formatter_money($level_com)); ?>],
						borderWidth: [0, 0, 0, 0]
					}]
				},
			options: {
				maintainAspectRatio: false,
			   legend: {
				 position :"bottom",	
				 display: false,
				    labels: {
					  fontColor: '#ddd',  
					  boxWidth:15
				   }
				}
				,
				tooltips: {
				  displayColors:false
				}
			   }
			});
   });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/user/dashboard.blade.php ENDPATH**/ ?>