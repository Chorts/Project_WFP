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

        const doctorSelect = document.getElementById('selectDoctor');
        const dateInput = document.getElementById('inputBookingDate');
        const scheduleSelect = document.getElementById('selectSchedule');
        const noScheduleNotice = document.getElementById('noScheduleNotice');

        if (!doctorSelect || !dateInput || !scheduleSelect) return;

        const schedulePlaceholder = scheduleSelect.querySelector('option[value=""]');
        const scheduleOptions = scheduleSelect.querySelectorAll('option[data-doctor-id]');

        function resetDate() {
            dateInput.value = '';
            dateInput.disabled = true;
        }

        function resetSchedule(message) {
            scheduleOptions.forEach(opt => opt.hidden = true);
            scheduleSelect.disabled = true;
            scheduleSelect.value = '';
            schedulePlaceholder.hidden = false;
            schedulePlaceholder.textContent = message || 'Pilih dokter & tanggal terlebih dahulu';
            noScheduleNotice.classList.add('d-none');
        }

        // Step A: pilih Dokter -> aktifkan Tanggal, reset Sesi.
        doctorSelect.addEventListener('change', function() {
            resetDate();
            resetSchedule();

            if (doctorSelect.value) {
                dateInput.disabled = false;
            }
        });

        // Step B: pilih Tanggal -> filter Sesi: dokter cocok + hari cocok + belum dipesan di tanggal itu.
        dateInput.addEventListener('change', function() {
            if (!dateInput.value) {
                resetSchedule();
                return;
            }

            const doctorId = doctorSelect.value;
            const dayIndex = new Date(dateInput.value + 'T00:00:00').getDay();
            const selectedDayName = DAY_NAMES[dayIndex];

            let visibleCount = 0;

            scheduleOptions.forEach(opt => {
                const bookedDates = (opt.dataset.bookedDates || '')
                    .split(',')
                    .filter(Boolean);

                const isAvailable = opt.dataset.doctorId === doctorId &&
                    opt.dataset.day === selectedDayName &&
                    !bookedDates.includes(dateInput.value);

                opt.hidden = !isAvailable;
                if (isAvailable) visibleCount++;
            });

            scheduleSelect.disabled = visibleCount === 0;
            scheduleSelect.value = '';
            schedulePlaceholder.hidden = visibleCount > 0;
            schedulePlaceholder.textContent = 'Pilih sesi';
            noScheduleNotice.classList.toggle('d-none', visibleCount > 0);
        });

        // State awal saat modal dibuka.
        resetDate();
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
                        <label class="form-label lb-meta">Dokter</label>
                        <select class="form-control lb-form-control" id="selectDoctor">
                            <option value="">Pilih dokter</option>
                            <?php $__currentLoopData = $schedules->pluck('doctor')->unique('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label lb-meta">Tanggal Booking</label>
                        <input type="date"
                            class="form-control lb-form-control"
                            name="booking_date"
                            id="inputBookingDate"
                            min="<?php echo e(now()->toDateString()); ?>"
                            disabled>
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label lb-meta">Sesi (Hari & Jam)</label>
                        <select class="form-control lb-form-control" name="schedule_id" id="selectSchedule" disabled>
                            <option value="">Pilih dokter & tanggal terlebih dahulu</option>
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