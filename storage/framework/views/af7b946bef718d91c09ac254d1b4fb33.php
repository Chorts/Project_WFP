<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->

<?php $__env->startSection('sidebar-services'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Services
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('status')): ?>
            <div class="alert alert-warning"><?php echo e(session('status')); ?></div>
        <?php endif; ?>

        <h3>Halaman Services</h3>

        <a href="<?php echo e(route('services.create')); ?>" class="btn btn-primary">+ New Service</a>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + New Service (with Modal)
        </button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Tipe Service</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="tr_<?php echo e($d->id); ?>">
                        <td><?php echo e($d->id); ?></td>
                        <td id="td_name_<?php echo e($d->id); ?>"><?php echo e($d->service_name); ?></td>
                        <td id="td_desc_<?php echo e($d->id); ?>"><?php echo e($d->description); ?></td>
                        <td id="td_price_<?php echo e($d->id); ?>"><?php echo e($d->price); ?></td>
                        <td id="td_category_<?php echo e($d->id); ?>"><?php echo e($d->category->category_name); ?></td>
                        <td id="td_tipe_<?php echo e($d->id); ?>"><?php echo e($d->tipe_service); ?></td>
                        <td>
                            <a href="<?php echo e(route('services.edit', $d->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                            <a href="#modalEditA" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                onclick="getEditForm(<?php echo e($d->id); ?>)">Edit Type A</a>

                            <a href="#modalEditB" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                onclick="getEditFormB(<?php echo e($d->id); ?>)">Edit Type B</a>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permission', Auth::user())): ?>
                                <form action="<?php echo e(route('services.destroy', $d->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure to delete <?php echo e($d->service_name); ?>?')">
                                        Delete
                                    </button>
                                </form>

                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are you sure to delete <?php echo e($d->id); ?> - <?php echo e($d->service_name); ?>?')) deleteDataRemove(<?php echo e($d->id); ?>)">
                                    Delete Without Reload
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modals'); ?>
    
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="<?php echo e(url('/services')); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Service</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-2">
                            <label>Service Name</label>
                            <input type="text" class="form-control" name="service_name" placeholder="Enter Service Name">
                        </div>
                        <div class="form-group mb-2">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Enter Description">
                        </div>
                        <div class="form-group mb-2">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" placeholder="Enter Price">
                        </div>
                        <div class="form-group mb-2">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Tipe Service</label>
                            <select class="form-control" name="tipe_service">
                                <option value="Chat">Chat</option>
                                <option value="Offline">Offline</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="modal fade" id="modalEditA" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Service Type A</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalContent"></div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalEditB" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Service Type B</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalContentB"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("services.getEditForm")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    $('#modalContent').html(data.msg);
                }
            });
        }

        function getEditFormB(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("services.getEditFormB")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    $('#modalContentB').html(data.msg);
                }
            });
        }

        function saveDataUpdate(id) {
            var service_name = $('#s_service_name').val();
            var description = $('#s_description').val();
            var price = $('#s_price').val();
            var category_id = $('#s_category_id').val();
            var tipe_service = $('#s_tipe_service').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("services.saveDataUpdate")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'service_name': service_name,
                    'description': description,
                    'price': price,
                    'category_id': category_id,
                    'tipe_service': tipe_service,
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#td_name_' + id).html(service_name);
                        $('#td_desc_' + id).html(description);
                        $('#td_price_' + id).html(price);
                        $('#td_category_' + id).html($('#s_category_id option:selected').text());
                        $('#td_tipe_' + id).html(tipe_service);
                        $('#modalEditB').modal('hide');
                    }
                }
            });
        }

        function deleteDataRemove(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route("services.deleteData")); ?>',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#tr_' + id).remove();
                    }
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.adminlte4', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wfp\Project UTS\Project_WFP\resources\views/services/index.blade.php ENDPATH**/ ?>