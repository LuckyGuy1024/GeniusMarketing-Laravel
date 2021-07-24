@extends(activeTemplate() .'layouts.app')

@section('content')
    <!--Start Dashboard Content-->

	<div class="card mt-3">
        <div class="card-content">
            <div class="row row-group m-0">
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0">{{$general->cur_sym}}{{formatter_money($ref_com)}}<span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           <div class="progress-bar" style="width:55%"></div>
                        </div>
                      <p class="mb-0 text-white small-font">@lang('promo Bonus')<span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0">{{$general->cur_sym}}{{formatter_money($total_epin_recharge)}}<span class="float-right"><i class="fa fa-usd"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           <div class="progress-bar" style="width:55%"></div>
                        </div>
                      <p class="mb-0 text-white small-font">@lang('Total E-Pin Recharged')<span class="float-right">+1.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0">{{$general->cur_sym}}{{formatter_money($total_epin_generate)}}<span class="float-right"><i class="fa fa-eye"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           <div class="progress-bar" style="width:55%"></div>
                        </div>
                      <p class="mb-0 text-white small-font">@lang('Total E-Pin Generated')<span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0">{{$general->cur_sym}}{{formatter_money($total_bal_transfer)}}<span class="float-right"><i class="fa fa-envira"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                           <div class="progress-bar" style="width:55%"></div>
                        </div>
                      <p class="mb-0 text-white small-font">@lang('Total Transferred Balance')<span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
            </div>
        </div>
     </div>  
          
        <div class="row">
         <div class="col-12 col-lg-8 col-xl-8">
            <div class="card">
             <div class="card-header">@lang('Direct Refferals')
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
                   <h5 class="mb-0">{{$total_direct_ref}}</h5>
                   <small class="mb-0">Overall Visitor <span> <i class="fa fa-arrow-up"></i> 2.43%</span></small>
                 </div>
               </div>
               <div class="col-12 col-lg-4">
                 <div class="p-3">
                   <h5 class="mb-0">{{$total_direct_ref}}</h5>
                   <small class="mb-0">Visitor Duration <span> <i class="fa fa-arrow-up"></i> 12.65%</span></small>
                 </div>
               </div>
               <div class="col-12 col-lg-4">
                 <div class="p-3">
                   <h5 class="mb-0">{{$total_direct_ref}}</h5>
                   <small class="mb-0">Pages/Visit <span> <i class="fa fa-arrow-up"></i> 5.62%</span></small>
                 </div>
               </div>
             </div>
             
            </div>
         </div>


         {{-- Chart here is inside index.js --}}
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
                       <td><i class="fa fa-circle text-white mr-2"></i>@lang('Current Balance')</td>
                       <td>{{$general->cur_sym}}{{formatter_money(Auth::user()->balance)}}</td>
                     </tr>
                     <tr>
                       <td><i class="fa fa-circle text-light-1 mr-2"></i>@lang('Total Deposit')</td>
                       <td>{{$general->cur_sym}}{{formatter_money($total_deposit)}} </td>
                     </tr>
                     <tr>
                       <td><i class="fa fa-circle text-light-2 mr-2"></i>@lang('Total Withdraw')</td>
                       <td>{{$general->cur_sym}}{{formatter_money($total_withdraw)}} </td>
                     </tr>
                     <tr>
                       <td><i class="fa fa-circle text-light-3 mr-2"></i>@lang('Refferal Commission')</td>
                       <td>{{$general->cur_sym}}{{formatter_money($level_com)}}</td>
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


             {{-- referrer.blade.php can be here! --}}


               <div class="table-responsive">
                     <table class="table align-items-center table-flush table-borderless">
                      <thead>
                       <tr>
                        <th scope="col">@lang('First Name')</th>
                        <th scope="col">@lang('Last Name')</th>
                        <th scope="col">@lang('Username')</th>
                        <th scope="col">@lang('Email')</th>
                        <th scope="col">@lang('Plan')</th>
                        <th scope="col">@lang('Join date')</th>
                       </tr>
                       </thead>
                       <tbody>@forelse($referrals as $data)
                        <tr>
                            <td>{{$data->firstname}}</td>
                            <td>{{$data->lastname}}</td>
                            <td>{{$data->username}}</td>
                            <td>{{$data->email}}</td>
                            <td>
                                @php $plan = \App\Plan::find($data->plan_id); @endphp
                                @if($plan != NULL)
                                    {{$plan->name}}
                                @else
                                    @lang('N/A')
                                @endif
                            </td>
                            <td>{{show_datetime($data->created_at)}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{__('NO DATA FOUND')}}</td>
                        </tr>
                    @endforelse
                     </tbody></table>
                   </div>
           </div>
         </div>
        </div><!--End Row-->
    
          <!--End Dashboard Content-->
<!-- Bootstrap core JavaScript-->
<script src="{{ asset(activeTemplate(true)) . '/users/js/jquery.min.js'}}"></script>
<script src="{{ asset(activeTemplate(true)) . '/users/js/popper.min.js'}}"></script>
<script src="{{ asset(activeTemplate(true)) . '/users/js/bootstrap.min.js'}}"></script>

<!-- simplebar js -->
<script src="{{ asset(activeTemplate(true)) . '/users/plugins/simplebar/js/simplebar.js'}}"></script>
<!-- sidebar-menu js -->
<script src="{{ asset(activeTemplate(true)) . '/users/js/sidebar-menu.js'}}"></script>
<!-- loader scripts -->
<script src="{{ asset(activeTemplate(true)) . '/users/js/jquery.loading-indicator.js'}}"></script>
<!-- Custom scripts -->
<script src="{{ asset(activeTemplate(true)) . '/users/js/app-script.js'}}"></script>
<!-- Chart js -->

<script src="{{ asset(activeTemplate(true)) . '/users/plugins/Chart.js/Chart.min.js'}}"></script>

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
					labels: ["@lang('Current Balance')", "@lang('Total Deposit')", "@lang('Total Withdraw')", "@lang('Refferal Commission')"],
					datasets: [{
						backgroundColor: [
							"#ffffff",
							"rgba(255, 255, 255, 0.70)",
							"rgba(255, 255, 255, 0.50)",
							"rgba(255, 255, 255, 0.20)"
						],
						data: [{{formatter_money(Auth::user()->balance)}}, {{formatter_money($total_deposit)}}, {{formatter_money($total_withdraw)}}, {{formatter_money($level_com)}}],
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
@endsection
