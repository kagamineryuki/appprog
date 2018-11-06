<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("css/app.css")); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content-div'); ?>
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <div class="container">
            <h1 class="display-4">About Me</h1>
            <hr>
            <form method="POST" action="/api/update_user_info_web" enctype="multipart/form-data">
            <div class="d-flex">
                <div class="container col-8">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-row">
                            <div class="form-group mb-3 col-2">
                                <label class="mr-3"><strong>NIGN</strong></label>
                                <input type="text" class="form-control " name="nign"
                                       value="<?php echo e($nign); ?>" readonly>
                                <div class="invalid-feedback">
                                    <?php if($errors->has('username')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('username')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group mb-3 col-10">
                                <label class="mr-3"><strong>Name*</strong></label>
                                <input type="text" class="form-control " value="<?php echo e($nama); ?>" name="nama">
                                <div class="invalid-feedback">
                                    <?php if($errors->has('nama')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('nama')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mr-3"><strong>Address</strong></label>
                            <input type="text" class="form-control " value="<?php echo e($alamat); ?>" name="alamat">
                            <div class="invalid-feedback">
                                <?php if($errors->has('alamat')): ?>
                                    <p class="text-danger"><?php echo e($errors->first('alamat')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group mb-3 col-2">
                                <label class="mr-3"><strong>Birthplace</strong></label>
                                <input type="text" class="form-control" value="<?php echo e($tempat_lahir); ?>" name="tempat_lahir">
                                <div class="invalid-feedback">
                                    <?php if($errors->has('tempat_lahir')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('tempat_lahir')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group mb-3 col-10">
                                <label class="mr-3"><strong>Birthdate</strong></label>
                                <input type="date" class="form-control" value="<?php echo e($tanggal_lahir); ?>" name="tanggal_lahir">
                                <div class="invalid-feedback">
                                    <?php if($errors->has('tgllahir')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('tgllahir')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mr-3"><strong>Phone Number</strong></label>
                            <input type="number" class="form-control" value="<?php echo e($no_telp); ?>" name="no_telp">
                            <div class="invalid-feedback">
                                <?php if($errors->has('notelp')): ?>
                                    <p class="text-danger"><?php echo e($errors->first('notelp')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <input type="hidden" name="user_type" value="teacher">

                        <input type="submit" class="btn btn-primary" value="Change Profile">

                </div>
                <div class="container col-4">
                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Profile Picture</strong></label>
                        <br>
                        <img src="/storage/uploads/<?php echo e($profile_picture); ?>" class="rounded-circle mb-2 border" style="width:100px">
                        <input type="file" class="form-control-file" name="foto_profil">
                        <div class="invalid-feedback">
                            <?php if($errors->has('foto_profil')): ?>
                                <p class="text-danger"><?php echo e($errors->first('foto_profil')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script src="<?php echo e(asset('js/retrieve_change_user_data.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('teacher.dashboard_template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>