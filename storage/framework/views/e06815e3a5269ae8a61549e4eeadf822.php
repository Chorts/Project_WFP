<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table class="table">
            </thead>
            <tbody>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($service->id); ?></td>
                        <td><?php echo e($service->service_name); ?></td>
                        <td><?php echo e($service->description); ?></td>
                        <td><?php echo e($service->availability); ?></td>
                        <td><?php echo e($service->price); ?></td>
                        <td><?php echo e($service->category_id); ?></td>
                        <td><?php echo e($service->category->category_name); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH C:\Users\CENT\WFP_Week1\resources\views/services/index.blade.php ENDPATH**/ ?>