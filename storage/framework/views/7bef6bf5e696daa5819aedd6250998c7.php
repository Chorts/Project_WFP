<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'VitaGuard'); ?> | VitaGuard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="<?php echo e(asset('assets/libra/css/libra-theme.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

    <div class="lb-topbar py-1">
        <div class="container d-flex justify-content-between align-items-center">
            <span><i class="bi bi-telephone me-1"></i> 0800-1-VITA | <i class="bi bi-envelope ms-2 me-1"></i> hello@vitaguard.id</span>
            <span class="d-none d-md-inline">Selamat datang, <?php echo e(Auth::user()->name); ?></span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg lb-navbar py-3 sticky-top">
        <div class="container">
            <a class="lb-brand text-decoration-none" href="<?php echo e(route('member.articles.index')); ?>">
                Vita<span>Guard</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBurger">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarBurger">
                <ul class="navbar-nav me-auto ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('nav-articles'); ?>" href="<?php echo e(route('member.articles.index')); ?>">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('nav-doctors'); ?>" href="<?php echo e(route('member.doctors.index')); ?>">Dokter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('nav-bookings'); ?>" href="<?php echo e(route('member.bookings.index')); ?>">Booking Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('nav-consultations'); ?>" href="<?php echo e(route('member.consultations.index')); ?>">Konsultasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $__env->yieldContent('nav-history'); ?>" href="<?php echo e(route('member.history.index')); ?>">Riwayat</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-4 me-1" style="color: var(--lb-primary-dark);"></i>
                            <span class="fw-semibold d-none d-md-inline" style="color: var(--lb-ink);"><?php echo e(Auth::user()->name); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span class="dropdown-item-text text-muted small"><?php echo e(Auth::user()->email); ?></span></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
    </div>

    <?php echo $__env->yieldContent('content'); ?>

    <footer class="lb-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>VitaGuard</h5>
                    <p class="small mb-0">Platform konsultasi kesehatan tepercaya — terhubung dengan dokter, kelola booking, dan pantau riwayat konsultasi Anda dalam satu tempat.</p>
                </div>
                <div class="col-md-4">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><a href="<?php echo e(route('member.articles.index')); ?>">Artikel Kesehatan</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('member.doctors.index')); ?>">Cari Dokter</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('member.bookings.index')); ?>">Booking Saya</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('member.history.index')); ?>">Riwayat Konsultasi</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Jakarta, Indonesia</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>0800-1-VITA</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>hello@vitaguard.id</li>
                    </ul>
                </div>
            </div>
            <div class="lb-footer-bottom text-center">
                &copy; <?php echo e(date('Y')); ?> VitaGuard. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('script'); ?>
    <?php echo $__env->yieldPushContent('modals'); ?>
</body>

</html>
<?php /**PATH C:\Users\enric\OneDrive\Desktop\Kuliah\Semester 6\WFP\Project_WFP\resources\views/layouts/member.blade.php ENDPATH**/ ?>