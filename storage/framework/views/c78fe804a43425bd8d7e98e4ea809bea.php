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
    <div class="header text-center">
        <h1><?php echo e($article->title); ?></h1>
        <p>Date Published: <?php echo e($article->date_published); ?></p>
        <p>Doctor ID: <?php echo e($article->doctor_id); ?></p>
        <p>Doctor Name: <?php echo e($article->doctor->name); ?></p>
    </div>
    <p><?php echo e($article->article); ?></p>
</div>
<!-- </body>

    </html> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\PROJECT\Project_WFP\resources\views/articles/show.blade.php ENDPATH**/ ?>