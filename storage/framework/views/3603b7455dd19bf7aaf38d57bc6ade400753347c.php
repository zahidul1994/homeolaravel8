



<?php $__env->startSection('title','User Login'); ?>


<?php $__env->startSection('page-style'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/login.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="login-page" class="row">
    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                                                    <h5 class="gradient-45deg-green-teal text-center"><?php if($errors->has('status')): ?>
                                                           
                                                                    <strong><?php echo e($errors->first('status')); ?></strong>
                                                                
                                                            <?php endif; ?></h5>
                          <form class="login-form"   method="POST" action='<?php echo e(url("login/$url")); ?>' aria-label="<?php echo e(__('Login')); ?>">
                    
                      <?php echo csrf_field(); ?>
        <div class="row">
          <div class="input-field col s12">
            <h5 class="ml-4"><?php echo e(__('Sign in')); ?></h5>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix pt-2">person_outline</i>
            <input id="email" type="email" class=" <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
              value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
            <label for="email" class="center-align"><?php echo e(__('Email')); ?></label>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="red-text ml-10" role="alert">
              <?php echo e($message); ?>
            </small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix pt-2">lock_outline</i>
            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              name="password" required autocomplete="current-password">
            <label for="password"><?php echo e(__('password')); ?></label>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="red-text ml-10" role="alert">
              <?php echo e($message); ?>
            </small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m12 l12 ml-2 mt-1">
            <p>
              <label>
                <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                <span>Remember Me</span>
              </label>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
              Login
            </button>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="<?php echo e(route('register')); ?>">Register Now!</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
            <p class="margin right-align medium-small">
            <?php if(Route::has('password.request')): ?>
            <a   href="<?php echo e(route('admin.password.request')); ?>">
                <?php echo e(__('Forgot password?')); ?>
            </a>
        <?php endif; ?> 
          
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.fullLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\laravel8\Homeobari\resources\views/auth/login.blade.php ENDPATH**/ ?>