
<?php $__env->startSection('title'); ?>
Profil Saya
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Profil Saya</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('doctor.profile.update')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row mb-3 align-items-center">
                    <div class="col-md-3 text-center">
                        <?php if($doctor->photo): ?>
                        <img src="<?php echo e(asset('storage/' . $doctor->photo)); ?>" alt="<?php echo e($doctor->name); ?>"
                            class="img-thumbnail rounded-circle mb-2" style="width:150px;height:150px;object-fit:cover;">
                        <?php else: ?>
                        <div class="bg-secondary-subtle rounded-circle d-flex align-items-center justify-content-center mb-2"
                            style="width:150px;height:150px;margin:0 auto;">
                            <i class="bi bi-person fs-1"></i>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group mb-2">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" value="<?php echo e(old('name', $doctor->name)); ?>">
                        </div>

                        <div class="form-group mb-2">
                            <label>Email (tidak dapat diubah)</label>
                            <input type="text" class="form-control" value="<?php echo e($doctor->user->email ?? '-'); ?>" disabled>
                        </div>

                        <div class="form-group mb-2">
                            <label>Spesialisasi</label>
                            <select class="form-control" name="specialization_id">
                                <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($specialization->id); ?>"
                                    <?php echo e(old('specialization_id', $doctor->specialization_id) == $specialization->id ? 'selected' : ''); ?>>
                                    <?php echo e($specialization->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>No. Telepon/WhatsApp</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone', $doctor->phone)); ?>" placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="form-group mb-2">
                            <label>Pengalaman (tahun praktik)</label>
                            <input type="number" min="0" class="form-control" name="experience_years" value="<?php echo e(old('experience_years', $doctor->experience_years)); ?>">
                        </div>

                        <div class="form-group mb-2">
                            <label>Bio / Deskripsi Singkat</label>
                            <textarea class="form-control" name="bio" rows="4" placeholder="Ceritakan sedikit tentang diri Anda, keahlian, dan pengalaman praktik."><?php echo e(old('bio', $doctor->bio)); ?></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/doctor/profile/edit.blade.php ENDPATH**/ ?>