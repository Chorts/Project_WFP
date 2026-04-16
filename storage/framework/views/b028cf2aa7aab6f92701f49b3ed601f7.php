<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Page</title>
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
                        <td style="font-weight:bold">Service Name</td>
                        <td style="font-weight:bold">Description</td>
                        <td style="font-weight:bold">Price</td>
                        <td style="font-weight:bold">Category ID</td>
                        <td style="font-weight:bold">Category Name</td>
                        <td style="font-weight:bold">Tipe Service</td>
                    </tr>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($service->id); ?></td>
                        <td><?php echo e($service->service_name); ?></td>
                        <td><?php echo e($service->description); ?></td>
                        <td><?php echo e($service->price); ?></td>
                        <td><?php echo e($service->category_id); ?></td>
                        <td><?php echo e($service->category->category_name); ?></td>
                        <td><?php echo e($service->tipe_service); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>

</html><?php /**PATH C:\Users\CENT\Downloads\Imp\Ubaya\Tugas\Sem 6\Web Framework Programming\Project_WFP\resources\views/services/index.blade.php ENDPATH**/ ?>