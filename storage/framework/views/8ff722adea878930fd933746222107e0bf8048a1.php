<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("css/app.css")); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content-div'); ?>
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Generate QR Code</h1>
        <hr>
        <div class="container">
            <form method="POST" action="/teacher/teacher_dashboard/generate_qr_code/proceed">
                <?php echo e(csrf_field()); ?>

                <div class="form-row">
                    <div class="col">
                        <label>Class</label>
                        <select class="form-control is-invalid" name="kelas">
                            <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per_kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($per_kelas->kode_kelas); ?>"><?php echo e($per_kelas->kode_kelas); ?>

                                    | <?php echo e($per_kelas->nama_kelas); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if($errors->has('kelas')): ?>
                                <p class="text-danger"><?php echo e($errors->first('kelas')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col">
                        <label>Lesson</label>
                        <select class="form-control is-invalid" name="pelajaran">
                            <?php $__currentLoopData = $pelajaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per_pelajaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($per_pelajaran->kode_pelajaran); ?>"><?php echo e($per_pelajaran->kode_pelajaran); ?>

                                    | <?php echo e($per_pelajaran->nama_pelajaran); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if($errors->has('pelajaran')): ?>
                                <p class="text-danger"><?php echo e($errors->first('pelajaran')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col">
                        <label>Valid until</label>
                        <input type="datetime-local" class="form-control is-invalid" name="valid_until"
                               value="<?php echo e(old('valid_until')); ?>">
                        <div class="invalid-feedback">
                            <?php if($errors->has('valid_until')): ?>
                                <p class="text-danger"><?php echo e($errors->first('valid_until')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mt-3" value="Create QR">
            </form>
            <hr>
            <h1 class="display-4 m-0">QR Code</h1>

            <div class="container d-flex m-0 align-content-center justify-content-center">
                <?php if(!empty($qr_code)): ?>
                    <?php echo e(QRCode::text($qr_code->id_qr.",".$qr_code->kode_kelas.",".$qr_code->kode_pelajaran.",".$qr_code->nign)->setSize(35)->setErrorCorrectionLevel('H')->svg()); ?>

                <?php endif; ?>
                <div class="align-self-center">
                    <?php if(!empty($qr_code)): ?>
                        <h1 class="h1 text-center m-0"><strong>Can't scan the code ?</strong></h1>
                        <h1 class="h2 text-center">
                            <strong><?php echo e($qr_code->id_qr.",".$qr_code->kode_kelas.",".$qr_code->kode_pelajaran.",".$qr_code->nign); ?></strong>
                        </h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('teacher.dashboard_template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>