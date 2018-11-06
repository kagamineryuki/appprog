<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("css/app.css")); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content-div'); ?>
    <h1 class="text-center mt-3 display-4">Scan QR Code</h1>
    <hr>
    <div class="m-4 d-flex justify-content-center align-content-center">
        <video class="align-items-center w-100" id="preview"></video>
    </div>
    <div class="container">
        <h1 class="text-center h3">Can't scan the code ?</h1>
        <p class="text-center">Input the code below</p>
        <form action="./submit_qr" method="POST">
            <?php echo e(csrf_field()); ?>

            <input type="text" name="kode_qr" class="form-control mb-2" placeholder="QR Code Subtitution">
            <input type="hidden" name="nisn" value="<?php echo e(auth()->guard('student')->user()->nisn); ?>">
            <div class="d-flex justify-content-center align-content-center">
                <input type="submit" class="btn btn-primary flex-fill">
            </div>
        </form>
    </div>
    <hr>
    <script src="<?php echo e(asset('/js/qrcode.js')); ?>"></script>
    
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('student_template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>