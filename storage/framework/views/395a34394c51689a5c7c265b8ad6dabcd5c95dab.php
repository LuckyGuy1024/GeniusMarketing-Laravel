<?php $__env->startSection('content'); ?>
    <div id="app">


        <div class="row">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-normal"><?php echo app('translator')->get('Balance Transfer'); ?></h4>
                    </div>

                    <div class="col-md-12 text-center">
                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo app('translator')->get('Balance Transfer Charge'); ?> <?php echo e(__($general->bal_trans_fixed_charge)); ?> <?php echo e(__($general->cur_text)); ?> <?php echo app('translator')->get('Fixed and'); ?>  <?php echo e(__($general->bal_trans_per_charge)); ?>

                                % <?php echo app('translator')->get('of your total amount to transfer balance.'); ?></strong>
                            <p style="color: red" v-if="newdata.amount !== ''">{{parseInt(newdata.amount) +
                                amount}} <?php echo e(__($general->cur_text)); ?> <?php echo app('translator')->get('will be subtracted from your'); ?> <?php echo app('translator')->get('{{wallet_name}}'); ?> </p>
                        </div>
                    </div>
                    <form class="contact-form" id="balanceTransfer" method="POST"
                          action="<?php echo e(route('user.balance.transfer.post')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label><?php echo app('translator')->get('Username / Email To Send Amount'); ?> <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" id="InputMailUser" @keyup="submitSearch"
                                           v-model="newdata.username" name="username" placeholder="<?php echo app('translator')->get('Username/Email'); ?>"
                                           required autocomplete="off">

                                </div>

                                 <div class="form-group col-md-12">

                                     <label for="InputMail"><?php echo app('translator')->get('Transfer Amount from'); ?> <span
                                                 v-if="wallet_name"> <?php echo app('translator')->get('{{wallet_name}}'); ?> </span> <span class="requred">*</span></label>
                                     <input type="text" class="form-control" id="InputMail" v-model="newdata.amount"
                                            name="amount" placeholder="<?php echo app('translator')->get('Amount'); ?> <?php echo e(__($general->cur_text)); ?>" required>
                                     <small v-if="parseInt(balance) < parseInt(newdata.amount)"
                                            style="color: red"><?php echo app('translator')->get('Insufficient Balance!'); ?></small>

                                    </div>

                            </div>
                        </div>


                        <div class="card-footer " id="bal" v-if="parseInt(balance) >= parseInt(newdata.amount) + amount && hasmsg.success == true">
                            <div class="form-group col-md-12 text-center">
                                <?php if(Auth::user()->tauth == 1): ?>
                                    <button type="button" style="width: 100%;" data-toggle="modal"
                                            data-target="#openmodal"
                                            class="btn btn-block btn-primary mr-2"> <?php echo app('translator')->get('Transfer Balance'); ?></button>
                                <?php else: ?>
                                    <button type="submit" style="width: 100%;"
                                            class=" btn btn-block btn-primary mr-2"> <?php echo app('translator')->get('Transfer Balance'); ?></button>
                                <?php endif; ?>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>

    <script src="<?php echo e(asset(activeTemplate(true) .'users/vue/axios.js')); ?>"></script>
    <script src="<?php echo e(asset(activeTemplate(true) .'users/vue/vue.js')); ?>"></script>
    <script src="<?php echo e(asset(activeTemplate(true) .'users/vue/vue-handle-error.js')); ?>"></script>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                showData: {},
                newdata: {
                    amount: '',
                    wallet_type: '',
                    username: '',
                },
                codeData: {
                    code: ''
                },
                balance: '<?php echo e(Auth::user()->balance); ?>',
                hasmsg: '',
                wallet_name: 'Balance',
                errors: ''
            },
            computed: {
                amount() {
                    return <?php echo e(intval($general->bal_trans_fixed_charge)); ?>+(parseInt(this.newdata.amount) * parseInt(<?php echo e(intval($general->bal_trans_per_charge)); ?>)) / 100
                }
            },
            methods: {
                submitSearch() {
                    var input = this.newdata;
                    axios.post('<?php echo e(route('user.search.user')); ?>', input).then(function (e) {
                        app.hasmsg = e.data;
                        if (e.data.success == true) {
                            $('#InputMailUser').css('box-shadow', '1px 1px 0px #039f08, 0 0 4px #039f08, 0 0 4px #039f08');
                            $('#bal').css('display', 'block');
                        } else {
                            $('#InputMailUser').css('box-shadow', '1px 1px 0px #de0015, 0 0 4px #de0015, 0 0 4px #de0015');
                            $('#bal').css('display', 'none');
                        }
                    });
                },
                submitCode() {
                    var input = this.codeData;
                    axios.post('', input).then(function (e) {

                        if (e.data.success == true) {
                            $("#balanceTransfer").submit();
                        } else {
                            iziToast.error({
                                title: '<?php echo e(__('Opps!')); ?>',
                                message: e.data.message,
                                position: 'topRight',
                            });
                        }

                    }).catch(function (error) {
                        app.errors = error.response.data.errors.code;
                    })
                }
            }
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make(activeTemplate() .'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2//user/balance_transfer.blade.php ENDPATH**/ ?>