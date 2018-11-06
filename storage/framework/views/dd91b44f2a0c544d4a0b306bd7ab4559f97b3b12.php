<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("css/app.css")); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content-div'); ?>
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Attendances List</h1>
        <hr>
        <h4>Filter By:</h4>
        <form action="/teacher/teacher_dashboard/history" method="GET">
            <?php echo e(csrf_field()); ?>

            
            <div class="form-group">
                <label>NISN</label>
                <input type="text" id="nisn" name="nisn" class="form-control is-invalid" value="<?php echo e(old('nisn')); ?>">
                <div class="invalid-feedback">
                    <?php if($errors->has('nisn')): ?>
                        <p class="text-danger"><?php echo e($errors->first('nisn')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="form-group">
                <label>Tardiness</label>
                <select id="tardiness" name="tardiness" class="form-control">
                    <option value="late">Late</option>
                    <option value="in time">In time</option>
                    <option value="on time">On time</option>
                </select>
            </div>
            
            <input type="submit" class="btn btn-primary" value="Filter Result">
        </form>
        <hr>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>NISN</td>
                    <td>Student</td>
                    <td>Class</td>
                    <td>Teacher</td>
                    <td>Lesson</td>
                    <td>Registered At</td>
                    <td>Valid Until</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($result->nisn); ?></td>
                    <td><?php echo e($result->nama); ?></td>
                    <td><?php echo e($result->kelas); ?></td>
                    <td><?php echo e($result->pengampu); ?></td>
                    <td><?php echo e($result->pelajaran); ?></td>
                    <td><?php echo e($result->registered_at); ?></td>
                    <td><?php echo e($result->valid_until); ?></td>
                    <td><?php echo e(strtoupper($result->status_hadir)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo e($query->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('teacher.dashboard_template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>