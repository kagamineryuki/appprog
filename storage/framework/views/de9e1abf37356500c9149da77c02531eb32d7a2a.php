<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("css/app.css")); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="welcome-bg" class="d-flex justify-content-center align-items-center">
        <div>
            <h1 class="display-3 text-light mb-1"><?php echo e(config('app.name')); ?></h1>
            <p class="h5 text-light text-center mb-3">Administrator</p>

            <form method="POST" action="./admin/login">
                <?php echo e(csrf_field()); ?>


                <div class="form-group mb-3">
                    <input type="text" name="username" class="form-control form-control-lg mb-1 is-invalid" placeholder="Username" value="<?php echo e(old('username')); ?>">
                    <?php if($errors->has('username')): ?>
                        <div class="invalid-feedback mb-3">
                            <?php echo e($errors->first('username')); ?>

                        </div>
                    <?php endif; ?>

                    <input type="password" name="password" class="form-control form-control-lg mb-1 is-invalid" placeholder="Password" >
                    <?php if($errors->has('password')): ?>
                        <div class="invalid-feedback mb-3">
                            <?php echo e($errors->first('password')); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-around">
                    <div class="form-inline mr-4">
                        <input type="checkbox" class="form-check-input" name="remember">
                        <label class="text-light"><strong>Remember Me</strong></label>
                    </div>
                    <input type="submit" class="btn btn-primary flex-fill" value="Login">
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome_css', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>