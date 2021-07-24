<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'build/css/intlTelInput.css')); ?>">
    <style>
        .intl-tel-input {
            width: 100%;
        }

    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('panel'); ?>
<div class="card card-authentication1 mx-auto my-4">
    <div class="card-body">
     <div class="card-content p-2">
         <div class="text-center">
             <img src="<?php echo e(get_image(config('constants.logoIcon.path') .'/logo.png')); ?>" alt="logo icon">
         </div>
      <div class="card-title text-uppercase text-center py-3">Sign Up</div>


        <form action="<?php echo e(route('user.register')); ?>" method="POST" class="login-form" id="recaptchaForm">
        <?php echo csrf_field(); ?>

          <div class="form-group">
          <label for="exampleInputName" class="sr-only">First Name</label>
           <div class="position-relative has-icon-right">
              <input type="text" id="exampleInputName" class="form-control input-shadow" value="<?php echo e(old('firstname')); ?>"
              placeholder="<?php echo app('translator')->get('Enter your first name'); ?>"
              name="firstname">
              <div class="form-control-position">
                  <i class="icon-user"></i>
              </div>
           </div>
          </div>

            <div class="form-group">
                <label for="exampleInputName" class="sr-only"><?php echo app('translator')->get('Last name'); ?></label>
                <div class="position-relative has-icon-right">
                    <input type="text" id="exampleInputName" class="form-control input-shadow" value="<?php echo e(old('lastname')); ?>"
                    placeholder="<?php echo app('translator')->get('Enter your last name'); ?>"
                    name="lastname">
                    <div class="form-control-position">
                        <i class="icon-user"></i>
                    </div>
                </div>
            </div>

          <div class="form-group">
          <label for="exampleInputEmailId" class="sr-only"><?php echo app('translator')->get('Your email'); ?></label>
           <div class="position-relative has-icon-right">
              <input type="text" id="exampleInputEmailId" class="form-control input-shadow" value="<?php echo e(old('email')); ?>"
              placeholder="<?php echo app('translator')->get('Enter your email'); ?>"
              name="email">
              <div class="form-control-position">
                  <i class="icon-envelope-open"></i>
              </div>
           </div>
          </div>

            <div class="form-group">
                <label for="exampleInputName" class="sr-only"><?php echo app('translator')->get('Your mobile'); ?></label>
                <div class="position-relative has-icon-right">
                    <input type="text" id="exampleInputName" class="form-control input-shadow" value="<?php echo e(old('mobile')); ?>"
                    placeholder="<?php echo app('translator')->get('Enter your mobile number'); ?>"
                    name="mobile">
                    <div class="form-control-position">
                        <i class="icon-user"></i>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputName" class="sr-only"><?php echo app('translator')->get('NIC'); ?></label>
                <div class="position-relative has-icon-right">
                    <input type="text" id="exampleInputName" class="form-control input-shadow" value="<?php echo e(old('nic')); ?>"
                    placeholder="<?php echo app('translator')->get('Enter your NIC'); ?>"
                    name="nic">
                    <div class="form-control-position">
                        <i class="icon-user"></i>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputName" class="sr-only"><?php echo app('translator')->get('Your Country'); ?></label>
                <div class="position-relative has-icon-right">
                    <select class="form-control input-shadow" value="<?php echo e(old('country')); ?>"
                    placeholder="<?php echo app('translator')->get('Enter your NIC'); ?>"
                    name="country">
                    <?php echo $__env->make('partials.country', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </select>
                    <div class="form-control-position">
                        <i class="icon-user"></i>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="usernamef" class="sr-only"><?php echo app('translator')->get('Username'); ?></label>
                <div class="position-relative has-icon-right">
                    <input type="text" id="usernamef" class="form-control input-shadow" name="username"
                    value="<?php echo e(old('username')); ?>" placeholder="<?php echo app('translator')->get('Enter your username'); ?>">
                    <div class="form-control-position">
                        <i class="icon-user"></i>
                    </div>
                </div>
            </div>

           
          <div class="form-group">
           <label for="exampleInputPassword" class="sr-only">Password</label>
           <div class="position-relative has-icon-right">
              <input type="password" id="exampleInputPassword" class="form-control input-shadow" name="password"
              placeholder="<?php echo app('translator')->get('Enter your password'); ?>">
              <div class="form-control-position">
                  <i class="icon-lock"></i>
              </div>
           </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword" class="sr-only"> <?php echo app('translator')->get('Confirm Password'); ?></label>
            <div class="position-relative has-icon-right">
               <input type="password" name="password_confirmation"
               placeholder="<?php echo app('translator')->get('Confirm your password'); ?>" class="form-control input-shadow" >
               <div class="form-control-position">
                   <i class="icon-lock"></i>
               </div>
            </div>
           </div>


          
         <button type="submit" id="recaptcha" class="btn btn-light btn-block waves-effect waves-light">Sign Up</button>
          <div class="text-center mt-3">Sign Up With</div>
          
         <div class="form-row mt-4">
          <div class="form-group mb-0 col-6">
           <button type="button" class="btn btn-light btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
         </div>
         <div class="form-group mb-0 col-6 text-right">
          <button type="button" class="btn btn-light btn-block"><i class="fa fa-twitter-square"></i> Twitter</button>
         </div>
        </div>
        
         </form>
       </div>
      </div>
      <div class="card-footer text-center py-3">
        <p class="text-warning mb-0">Already have an account? <a href="<?php echo e(route('user.login')); ?>"> Sign In here</a></p>
      </div>
     </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset(activeTemplate(true) .'users/css/signin.css')); ?>">
    <style>
        .registration-form-area .frm-grp+.frm-grp {
            margin-top: 0;
        }
        .registration-form-area .frm-grp label {
            color: #98a6ad!important;
            font-weight: 400;
        }
        .registration-form-area select {
            border: 1px solid #5220c5;
            width: 100%;
            padding: 12px 20px;
            color: #ffffff;;
            z-index: 9;
            background-color: #3c139c;
            border-radius: 3px;
        }
        .registration-form-area select option {
            color: #ffffff;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('js'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make(activeTemplate().'layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\laravel\upwork2\resources\views/templates/tmp2/user/auth/register.blade.php ENDPATH**/ ?>