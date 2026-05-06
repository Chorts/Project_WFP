<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->

<?php $__env->startSection('sidebar-articles'); ?>
active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Articles
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <table class="table">
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:bold">ID</td>
                <td style="font-weight:bold">Title</td>
                <td style="font-weight:bold">Article</td>
                <td style="font-weight:bold">Date Published</td>
                <td style="font-weight:bold">Doctor ID</td>
                <td style="font-weight:bold">Doctor Name</td>
            </tr>
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php echo e($article->id); ?>

                </td>
                <td>
                    <a href="<?php echo e(route('articles.show', $article->id)); ?>"><?php echo e($article->title); ?></a>
                </td>
                <td><?php echo e($article->article); ?></td>
                <td><?php echo e($article->date_published); ?></td>
                <td><?php echo e($article->doctor_id); ?></td>
                <td><?php echo e($article->doctor->name); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<!-- </body>

    </html> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\PROJECT\Project_WFP\resources\views/articles/index.blade.php ENDPATH**/ ?>