<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>403 Forbidden Access</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #f4f6f9;
            color: #343a40;
        }

        .error-box {
            text-align: center;
            padding: 2rem;
        }

        .error-box h1 {
            font-size: 6rem;
            margin: 0;
            color: #dc3545;
        }

        .error-box h2 {
            margin: 0.5rem 0 1rem;
            font-weight: 600;
        }

        .error-box p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        .error-box a {
            display: inline-block;
            padding: 0.6rem 1.5rem;
            background: #0d6efd;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }

        .error-box a:hover {
            background: #0b5ed7;
        }
    </style>
</head>

<body>
    <div class="error-box">
        <h1>403</h1>
        <h2>Forbidden Access</h2>
        <p>Anda tidak memiliki hak akses untuk membuka halaman ini.</p>
        <a href="<?php echo e(url('/')); ?>">Kembali ke Beranda</a>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\wfp\baru\Project_WFP\resources\views/errors/403.blade.php ENDPATH**/ ?>