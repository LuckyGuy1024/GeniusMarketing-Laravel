<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



<!-- report start here -->
  <div class="row "  >
 <form id="frmProducts" method="post"   action="<?php echo e(route('user.roi-date')); ?>" style="width:100% !important;">
     <?php echo csrf_field(); ?>
                         <div class="form-group">
                            <div class="row">
                          <div class="col-md-6"></div>
                          
                    <div class="col-md-4" >
                               
                                    <strong style="color:white;">Select Date:</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg plan-price'"  id="current_date" name="current_date" required="required" class="form-control" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Date</span>
                                        </div>
                                    </div>

                                </div>


                            <?php 
$totalAmount=0;
$totalAmountAfterBalance=0;

$request="manage_pin";

if($page=="used_pin"){
    $request="used_pin";

}
                            ?>


                             
                           
<div class=" col-md-2" style="margin-top:15px !important;" >


<input type="submit" value="View Report" class="btn btn-block btn-success mt-2">
    </div>
    </div>
    </div>

</form>
    </div>

<!-- report ends here -->


    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light"   id="printTable">
                        <thead>
                        <tr>

                          
                             
                                <th scope="col">Plan Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date Gained</th>
                              
                         

                        </tr>
                        </thead>


                        <tbody class="list">
                    
                 
                            <?php $__currentLoopData = $trans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php $totalAmount=$totalAmount+$p->amount;  

                                 ?>


 <?php
                        $userName="";
$result=\App\User::where("id","=",$p->user_id)->get();
if($result){

    foreach($result as $r){
if($r){
        $userName=$r->username;
    }
    }
}
?>


 <?php
                        $planName="";
$plan=\App\Plan::where("id","=",$p->plan_id)->get();
if($plan){

    foreach($plan as $pl){
if($pl){
        $planName=$pl->name;
    }
    }
}
?>
                                <tr>
                                   
                                    <td><?php echo e($planName); ?></td>
                                    <td><?php echo e($general->cur_sym); ?><?php echo e($p->amount); ?></td>
                                    <td><?php echo e(show_datetime($p->created_at)); ?></td>
                                   
                                    
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        


                        </tbody>


<tfoot><thead >
                            
                            <th colspan="6">
                                <center>

                                <?php
echo "<h7>"." Total Amount  <b>: ".$totalAmount."  </b>"."</h7>"."<br>";
                                ?>
</center>
                            </th>
                        </thead></tfoot>

                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <?php echo e($trans->links()); ?>

                    </nav>
                </div>
            </div>

            
<div class="row col-md-12">
    <div class="col-md-9"></div>
        <div class="col-md-3">
<input type="submit" class="btn btn-block btn-primary mt-2"
                                                   value="<?php echo app('translator')->get('Print'); ?>" onclick="printData()" />

                                               </div>
</div>



        </div>
    </div>

<div id="print_div"></div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title bold uppercase" id="myModalLabel"><?php echo app('translator')->get('Generate E-PIN'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo e(route('admin.storePin')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">


                        <div class="form-group error">
                            <label for="inputName" class="col-sm-12  bold uppercase"><?php echo app('translator')->get('Amount'); ?> : </label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" name="amount">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                             <?php echo e($general->cur_sym); ?>

                                            </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group error">
                            <label for="inputName" class="col-sm-12 bold uppercase"><?php echo app('translator')->get('Number (How Many Pins want to create)'); ?>: </label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control has-error bold" name="number" >
                                <code><?php echo app('translator')->get('PIN will generate automatically'); ?></code>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary bold uppercase"> <?php echo app('translator')->get('Generate'); ?> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>






<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .user-image {
            width: 200px;
            height: 200px;
        }
    </style>

    <script>
        $("select[name=country]").val("<?php echo e(Auth::user()->address->country); ?>");
    </script>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>

<script>
    var approveWithDrawal="";


      $('.print').on('click', function() {

      approveWithDrawal+= "<div>Pin    :       "+ $('.print').data("pin")+"</div>\n";
      approveWithDrawal+= "<div>Amount :       "+ $('.print').data("amount")+"</div>\n";
      approveWithDrawal+= "<div>Date Created : "+ $('.print').data("date")+"</div>\n";
    

$("#print_div").html(approveWithDrawal);
printPageArea("print_div");
      // alert(approveWithDrawal);
// return;
      });




    function printPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=900');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
  </script>


<?php $__env->stopPush(); ?>






<script type="text/javascript">
  
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
});

</script>

<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/user/roi.blade.php ENDPATH**/ ?>