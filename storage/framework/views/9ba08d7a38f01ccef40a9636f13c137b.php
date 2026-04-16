<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Patient Name</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Day</td>
                    <td style="font-weight:bold">Time</td>
                    <td style="font-weight:bold">Status</td>
                    <td style="font-weight:bold">Booking Date</td>
                </tr>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($booking->id); ?></td>
                        <td><?php echo e($booking->user->name); ?></td>
                        <td><?php echo e($booking->schedule->doctor->name); ?></td>
                        <td><?php echo e($booking->schedule->day); ?></td>
                        <td><?php echo e($booking->schedule->start_time); ?> - <?php echo e($booking->schedule->end_time); ?></td>
                        <td><?php echo e($booking->status); ?></td>
                        <td><?php echo e($booking->booking_date); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>

</html><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/bookings/index.blade.php ENDPATH**/ ?>