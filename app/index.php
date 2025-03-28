<!DOCTYPE html>
<html lang="es-CO" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majoma 11</title>
    <!--Logo Favicon-->
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">

    <!--SEO Tags-->
    <meta name="author" content="Majoma">
    <meta name="description" content="Aplicativo web Bootstrap">
    <meta name="keywords" content="SENA, sena, Sena, Aplicativo, APLICATIVO, aplicativo">

    <!--Optimization Tags-->
    <meta name="theme-color" content="#000000">
    <meta name="MobileOptimized" content="width">
    <meta name="HandlhledFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">

    <!--Bootstrap 5.3 Styles and complements-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/me.styles.css">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    include "conn.php";
    ?>
    <main class="form-signin m-auto pt-5 mt-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <img src="../assets/img/logo.png" alt="Logo" width="72" height="72">
                    <h1 class="display-6">Inicio de Sesión</h1>
                </div>
                <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingrese email" name="email">
                    </div>
                    <div class="mb-3 password-wrapper">

                        <label for="pwd" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="password" placeholder="Ingrese contraseña"
                            name="pass">

                        <span class="input-group pt-2 toggle-button eye-icon" onclick="password_show_hide();">
                            <i class="bi bi-eye d-none" id="show_eye" style="font-size:20px"></i>
                            <i class="bi bi-eye-slash" id="hide_eye" style="font-size:20px"></i>
                        </span>
                    </div>
                    <div class="form-check mb-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember"> Recuerdame
                        </label>
                    </div>
                    <button type="submit" class="float-end btn btn-primary" name="btnlogin">Ingresar</button>
                    <a href="reg_user">Registráte como usuario</a>
                </form>
            </div>
            <div class="card-footer bg-dark">
                <p class="text-center text-light pt-1" title="CACJX">Carlos Andres Castro - &copy;Copyright 2025</p>
            </div>
        </div>
    </main>
</body>

</html>