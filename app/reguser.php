<?php
/*
.htaccess OK
Encriptación de contraseña OK
Refinamiento de las Alertas OK
Validación de datos únicos OK
API Js password Viewer OK
Recuperación de contraseña
*/

require_once 'conn.php';

if (isset($_POST['btn-reg'])) {
    $insert = $conn->prepare('INSERT INTO user(fname,lname,email,pass) VALUES(?,?,?,?)');
    $insert->bindParam(1, $_POST['fname']);
    $insert->bindParam(2, $_POST['lname']);
    $insert->bindParam(3, $_POST['email']);
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $insert->bindParam(4, $pass);

    /* Data Validation */
    $search = $conn->prepare('SELECT * FROM user WHERE email = ?');
    $search->bindParam(1, $_POST['email']);
    $search->execute();
    $result = $search->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $msg = array("El correo ya existe", "danger");
        }
    /* Data Validation */ elseif ($insert->execute()) {
        $msg = array("Usuario Creado", "success");
        } else {
        $msg = array("Usuario no Creado", "danger");
        }
    }
?>
<!DOCTYPE html>
<html lang="es-CO" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celia</title>

    <!--Favicon-->
    <link rel="shortcut icon" href="../assets/img/logosena.png" type="image/x-icon">

    <!--SEO Tags-->
    <meta name="author" content="Celia">
    <meta name="description" content="Aplicativo web Bootstrap">
    <meta name="keywords" content="SENA, sena, Sena">

    <!--Optimization Tags-->
    <meta name="theme-color" content="#000000">
    <meta name="MobileOptimized" content="width">
    <meta name="HandlhledFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">

    <!--Styles and complements Bootstrap 5.3-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/me.styles.css">
    <!--styles Icons Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <main class="form-signin m-auto pt-5 mt-4">
        <div class="card">
            <div class="card-body">
                <!--Alerts-->
                <?php if (isset($msg)) { ?>
                    <div class="alert alert-<?php echo $msg[1]; ?> alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Alerta !</strong> <?php echo $msg[0]; ?>
                    </div>
                <?php } ?>
                <!--Alerts-->
                <span class="float-end fw-bold">
                    <a href="./"><i class="bi bi-x-lg" style="font-size:20px;"></i></a>
                </span>
                <div class="text-center">
                    <img src="../assets/img/logo.png" alt="Logo" width="72" height="72">
                    <h1 class="display-6">Registro de Usuario</h1>
                </div>
                <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="mb-3 mt-3">
                        <label for="fname" class="form-label">Nombres:</label>
                        <input type="text" class="form-control" id="fname" placeholder="Ingrese sus nombres"
                            name="fname" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="lname" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="lname" placeholder="Ingrese sus apellidos"
                            name="lname" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingrese su email" name="email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input class="form-control" type="password" name="pass" id="password"
                                placeholder="Ingrese su contraseña" required>
                            <span class="input-group-text" onclick="pass_show_hide();">
                                <i class="bi bi-eye-fill d-none" id="showeye" style="font-size: 20px;"></i>
                                <i class="bi bi-eye-slash-fill" id="hideeye" style="font-size: 20px;"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-check mb-3 clearfix">
                        <label class="form-check-label float-end">
                            <a href="./">Iniciar Sesión</a>
                        </label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit" name="btn-reg">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <!--Complements JS-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--Script visualización password-->
    <script src="../assets/js/password.viewer.js"></script>
</body>

</html>