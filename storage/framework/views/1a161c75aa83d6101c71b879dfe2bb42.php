<?php $__env->startSection('title', 'Booking Saya'); ?>
<?php $__env->startSection('nav-bookings', 'active'); ?>

<?php $__env->startSection('content'); ?>

<div class="lb-page-header">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1>Booking Saya</h1>
            <p>Kelola jadwal konsultasi Anda dengan dokter.</p>
        </div>
        <button type="button" class="btn btn-lb" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="bi bi-plus-lg me-1"></i> Booking Baru
        </button>
    </div>
</div>

<div class="container mb-5">

    <?php if($bookings->isEmpty()): ?>

    <div class="lb-empty">
        <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
        Anda belum memiliki booking konsultasi.
    </div>

    <?php else: ?>

    <div class="table-responsive lb-table">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Tanggal Booking</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <i class="bi bi-person-badge me-1" style="color: var(--lb-primary-dark);"></i>
                        <?php echo e($booking->schedule->doctor->name ?? '-'); ?>

                    </td>
                    <td><?php echo e($booking->booking_date); ?></td>
                    <td>
                        <?php
                        $statusClass = match(true) {
                        str_contains(strtolower($booking->status ?? ''), 'aktif') => 'lb-badge-active',
                        str_contains(strtolower($booking->status ?? ''), 'selesai') => 'lb-badge-done',
                        default => 'lb-badge-wait',
                        };
                        ?>
                        <span class="lb-badge <?php echo e($statusClass); ?>"><?php echo e($booking->status ?? 'Menunggu'); ?></span>
                    </td>
                    <td>
                        <form action="<?php echo e(route('member.consultations.store', $booking->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-lb btn-sm">
                                Mulai Konsultasi
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
    </div>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const DAY_NAMES = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        const dateInput = document.getElementById('inputBookingDate');
        const doctorSelect = document.getElementById('selectDoctor');
        const scheduleSelect = document.getElementById('selectSchedule');
        const noDoctorNotice = document.getElementById('noDoctorNotice');
        const noScheduleNotice = document.getElementById('noScheduleNotice');

        if (!dateInput || !doctorSelect || !scheduleSelect) return;

        const doctorPlaceholder = doctorSelect.querySelector('option[value=""]');
        const doctorOptions = doctorSelect.querySelectorAll('option[data-doctor-option]');

        const schedulePlaceholder = scheduleSelect.querySelector('option[value=""]');
        const scheduleOptions = scheduleSelect.querySelectorAll('option[data-doctor-id]');

        function isScheduleAvailable(opt, selectedDate, selectedDayName) {
            const bookedDates = (opt.dataset.bookedDates || '')
                .split(',')
                .filter(Boolean);

            return opt.dataset.day === selectedDayName && !bookedDates.includes(selectedDate);
        }

        function resetDoctor(message) {
            doctorOptions.forEach(opt => opt.hidden = true);
            doctorSelect.disabled = true;
            doctorSelect.value = '';
            doctorPlaceholder.hidden = false;
            doctorPlaceholder.textContent = message || 'Pilih tanggal terlebih dahulu';
            noDoctorNotice.classList.add('d-none');
        }

        function resetSchedule(message) {
            scheduleOptions.forEach(opt => opt.hidden = true);
            scheduleSelect.disabled = true;
            scheduleSelect.value = '';
            schedulePlaceholder.hidden = false;
            schedulePlaceholder.textContent = message || 'Pilih dokter terlebih dahulu';
            noScheduleNotice.classList.add('d-none');
        }

        // Step A: pilih Tanggal -> filter Dokter: hanya dokter yang punya sesi
        // cocok hari tsb dan belum penuh di tanggal itu.
        dateInput.addEventListener('change', function() {
            resetSchedule();

            if (!dateInput.value) {
                resetDoctor();
                return;
            }

            const dayIndex = new Date(dateInput.value + 'T00:00:00').getDay();
            const selectedDayName = DAY_NAMES[dayIndex];

            const availableDoctorIds = new Set();
            scheduleOptions.forEach(opt => {
                if (isScheduleAvailable(opt, dateInput.value, selectedDayName)) {
                    availableDoctorIds.add(opt.dataset.doctorId);
                }
            });

            let visibleCount = 0;
            doctorOptions.forEach(opt => {
                const matches = availableDoctorIds.has(opt.value);
                opt.hidden = !matches;
                if (matches) visibleCount++;
            });

            doctorSelect.disabled = visibleCount === 0;
            doctorSelect.value = '';
            doctorPlaceholder.hidden = visibleCount > 0;
            doctorPlaceholder.textContent = 'Pilih dokter';
            noDoctorNotice.classList.toggle('d-none', visibleCount > 0);
        });

        // Step B: pilih Dokter -> filter Sesi milik dokter itu yang available di tanggal terpilih.
        doctorSelect.addEventListener('change', function() {
            if (!doctorSelect.value) {
                resetSchedule();
                return;
            }

            const dayIndex = new Date(dateInput.value + 'T00:00:00').getDay();
            const selectedDayName = DAY_NAMES[dayIndex];

            let visibleCount = 0;
            scheduleOptions.forEach(opt => {
                const matches = opt.dataset.doctorId === doctorSelect.value &&
                    isScheduleAvailable(opt, dateInput.value, selectedDayName);
                opt.hidden = !matches;
                if (matches) visibleCount++;
            });

            scheduleSelect.disabled = visibleCount === 0;
            scheduleSelect.value = '';
            schedulePlaceholder.hidden = visibleCount > 0;
            schedulePlaceholder.textContent = 'Pilih sesi';
            noScheduleNotice.classList.toggle('d-none', visibleCount > 0);
        });

        // State awal saat modal dibuka.
        resetDoctor();
        resetSchedule();
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('modals'); ?>

<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="<?php echo e(route('member.bookings.store')); ?>">
            <div class="modal-content">
                <div class="modal-header" style="background-color: var(--lb-topbar); color: #fff;">
                    <h4 class="modal-title lb-serif" style="color: #fff;">Booking Konsultasi</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>

                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="form-group mb-3">
                        <label class="form-label lb-meta">Tanggal Booking</label>
                        <input type="date"
                            class="form-control lb-form-control"
                            name="booking_date"
                            id="inputBookingDate"
                            min="<?php echo e(now()->toDateString()); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label lb-meta">Dokter</label>
                        <select class="form-control lb-form-control" id="selectDoctor" disabled>
                            <option value="">Pilih tanggal terlebih dahulu</option>
                            <?php $__currentLoopData = $schedules->pluck('doctor')->unique('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($doctor->id); ?>" data-doctor-option hidden><?php echo e($doctor->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <small class="text-muted d-none" id="noDoctorNotice">Tidak ada dokter yang tersedia pada tanggal ini.</small>
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label lb-meta">Sesi (Hari & Jam)</label>
                        <select class="form-control lb-form-control" name="schedule_id" id="selectSchedule" disabled>
                            <option value="">Pilih dokter terlebih dahulu</option>
                            <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($schedule->id); ?>"
                                data-doctor-id="<?php echo e($schedule->doctor_id); ?>"
                                data-day="<?php echo e($schedule->day); ?>"
                                data-booked-dates="<?php echo e($schedule->booked_dates->implode(',')); ?>"
                                hidden>
                                <?php echo e($schedule->day); ?>

                                (<?php echo e(\Carbon\Carbon::parse($schedule->start_time)->format('H:i')); ?>-<?php echo e(\Carbon\Carbon::parse($schedule->end_time)->format('H:i')); ?>)
                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <small class="text-muted d-none" id="noScheduleNotice">Tidak ada sesi tersedia untuk dokter & tanggal ini.</small>
                    </div>

                    <input type="hidden" name="status" value="menunggu">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lb-outline" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-lb">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.member', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/member/bookings/index.blade.php ENDPATH**/ ?>