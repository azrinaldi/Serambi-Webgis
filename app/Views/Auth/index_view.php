<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Serambi WebGIS</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url('images/logo.png'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="/mazer/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/mazer/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/mazer/assets/css/app.css">
    <link rel="stylesheet" href="/mazer/assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="logo">
                        <img src="<?php echo base_url('images/logo.png'); ?>" alt="Logo" style="width: 30%; height: auto;">
                        <div style="display: inline-block; vertical-align: top; margin-left: 10px;">
                            <h1 class="title" style="margin: 0;">SERAMBI</h1>
                            <h1 class="title" style="margin: 0;">WebGIS</h1>
                        </div>
                    </div>
                    <br><br>
                    <h2 class="text-center">Login</h2>
                    <form action="<?= site_url('auth/login') ?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="username" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    
                </div>
            </div>
        </div>

    </div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php
    if (session()->getFlashdata('info')) {
    ?>
        Swal.fire({
            icon: '<?= session()->getFlashdata('info') ?>',
            title: '<?= session()->getFlashdata('message') ?>',
        })
    <?php
    }
    ?>
</script>

</html>