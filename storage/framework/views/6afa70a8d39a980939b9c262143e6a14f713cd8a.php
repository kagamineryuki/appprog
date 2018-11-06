<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("css/app.css")); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content-div'); ?>

    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Create Data</h1>
        <hr>
        
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">User</h1>
                <form method="POST" action="/admin/admin_dashboard/create_user/proceed/create_user" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>NISN / NIGN*</strong></label>
                        <input type="text" class="form-control " name="username"
                               value="<?php echo e(old('username')); ?>">
                        <div class="invalid-feedback">
                            <?php if($errors->has('username')): ?>
                                <p class="text-danger"><?php echo e($errors->first('username')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Password*</strong></label>
                        <input type="password" class="form-control " name="password">
                        <div class="invalid-feedback">
                            <?php if($errors->has('password')): ?>
                                <p class="text-danger"><?php echo e($errors->first('password')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Name*</strong></label>
                        <input type="text" class="form-control " value="<?php echo e(old('nama')); ?>" name="nama">
                        <div class="invalid-feedback">
                            <?php if($errors->has('nama')): ?>
                                <p class="text-danger"><?php echo e($errors->first('nama')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Address</strong></label>
                        <input type="text" class="form-control " value="<?php echo e(old('alamat')); ?>" name="alamat">
                        <div class="invalid-feedback">
                            <?php if($errors->has('alamat')): ?>
                                <p class="text-danger"><?php echo e($errors->first('alamat')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Birthplace</strong></label>
                        <input type="text" class="form-control" value="<?php echo e(old('tempat_lahir')); ?>" name="tempat_lahir">
                        <div class="invalid-feedback">
                            <?php if($errors->has('tempat_lahir')): ?>
                                <p class="text-danger"><?php echo e($errors->first('tempat_lahir')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Birthdate</strong></label>
                        <input type="date" class="form-control" value="<?php echo e(old('tgllahir')); ?>" name="tgllahir">
                        <div class="invalid-feedback">
                            <?php if($errors->has('tgllahir')): ?>
                                <p class="text-danger"><?php echo e($errors->first('tgllahir')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Phone Number</strong></label>
                        <input type="number" class="form-control" value="<?php echo e(old('notelp')); ?>" name="notelp">
                        <div class="invalid-feedback">
                            <?php if($errors->has('notelp')): ?>
                                <p class="text-danger"><?php echo e($errors->first('notelp')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Profile Picture</strong></label>
                        <input type="file" class="form-control-file" name="foto_profil">
                        <div class="invalid-feedback">
                            <?php if($errors->has('foto_profil')): ?>
                                <p class="text-danger"><?php echo e($errors->first('foto_profil')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-inline mb-3">
                        <input type="radio" name="user_type" value="student" class="form-control mr-3" checked>
                        <label class="mr-5"><strong>Student</strong></label>
                        <input type="radio" name="user_type" value="teacher" class="form-control mr-3">
                        <label><strong>Teacher</strong></label>
                    </div>

                    <p class="text-danger"><strong>*Inputs are required !</strong></p>

                    <input type="submit" class="btn btn-primary" value="Add User">
                </form>
            </div>

            
            <div class="d-flex container">
                <div class="mr-5">
                    <h1 class="display-4">Students</h1>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">NISN</th>
                            <th scope="col">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($student->nisn); ?></td>
                                <td><?php echo e($student->nama); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div>
                        <h1 class="display-4">Teacher</h1>
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">NIGN</th>
                                <th scope="col">Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($teacher->nign); ?></td>
                                    <td><?php echo e($teacher->nama); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">Lesson</h1>
                <form method="POST" action="/admin/admin_dashboard/create_user/proceed/create_pelajaran">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Lesson Code*</strong></label>
                        <input type="text" class="form-control " value="<?php echo e(old('kode_pelajaran')); ?>"
                               name="kode_pelajaran">
                        <div class="invalid-feedback">
                            <?php if($errors->has('kode_pelajaran')): ?>
                                <p class="text-danger"><?php echo e($errors->first('kode_pelajaran')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Lesson Name*</strong></label>
                        <input type="text" class="form-control " value="<?php echo e(old('nama_pelajaran')); ?>"
                               name="nama_pelajaran">
                        <div class="invalid-feedback">
                            <?php if($errors->has('nama_pelajaran')): ?>
                                <p class="text-danger"><?php echo e($errors->first('nama_pelajaran')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <p class="text-danger"><strong>*Inputs are required !</strong></p>

                    <input type="submit" class="btn btn-primary" value="Add Lesson">
                </form>
            </div>
            
            <div class="container">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Lesson Code</th>
                        <th scope="col">Lesson Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $pelajaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pelajaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($pelajaran->kode_pelajaran); ?></td>
                            <td><?php echo e($pelajaran->nama_pelajaran); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
        </div>
        <hr>
        
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">Class</h1>
                <form method="POST" action="/admin/admin_dashboard/create_user/proceed/create_kelas">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Class Code*</strong></label>
                        <input type="text" class="form-control " value="<?php echo e(old('kode_kelas')); ?>"
                               name="kode_kelas">
                        <div class="invalid-feedback">
                            <?php if($errors->has('kode_kelas')): ?>
                                <p class="text-danger"><?php echo e($errors->first('kode_kelas')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Class Name*</strong></label>
                        <input type="text" class="form-control  " value="<?php echo e(old('nama_kelas')); ?>" name="nama_kelas">
                        <div class="invalid-feedback">
                            <?php if($errors->has('nama_kelas')): ?>
                                <p class="text-danger"><?php echo e($errors->first('nama_kelas')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <p class="text-danger"><strong>*Inputs are required !</strong></p>

                    <input type="submit" class="btn btn-primary" value="Add Class">
                </form>
            </div>
            
            <div class="container">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Class Code</th>
                        <th scope="col">Class Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($kelas->kode_kelas); ?></td>
                            <td><?php echo e($kelas->nama_kelas); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.dashboard_template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>