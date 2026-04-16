<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Page</title>
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
                    <td style="font-weight:bold">Booking ID</td>
                    <td style="font-weight:bold">Patient ID</td>
                    <td style="font-weight:bold">Patient Name</td>
                    <td style="font-weight:bold">Doctor ID</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Service ID</td>
                    <td style="font-weight:bold">Service Name</td>
                    <td style="font-weight:bold">Status</td>
                    <td style="font-weight:bold">Price</td>
                    <td style="font-weight:bold">Date</td>
                </tr>
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($transaction->id); ?></td>
                        <td><?php echo e($transaction->booking->id); ?></td>
                        <td><?php echo e($transaction->booking->user->id); ?></td>
                        <td><?php echo e($transaction->booking->user->name); ?></td>
                        <td><?php echo e($transaction->booking->doctor_id); ?></td>
                        <td><?php echo e($transaction->booking->schedule->doctor->name); ?></td>
                        <td><?php echo e($transaction->booking->service_id); ?></td>
                        <td><?php echo e($transaction->booking->service->service_name); ?></td>
                        <td><?php echo e($transaction->status); ?></td>
                        <td><?php echo e($transaction->price); ?></td>
                        <td><?php echo e($transaction->transaction_date); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>

</html><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/transactions/index.blade.php ENDPATH**/ ?>