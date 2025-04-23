<?php
include 'conn.php';
session_start();

// Verificar al usuario para iniciar sesión

if (isset($_SESSION['user'])) {
    $login = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $login->bindParam(1, $_SESSION['user']);
    $login->execute();
    $result = $login->fetch(PDO::FETCH_ASSOC);

    if (is_array($result)) {

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
            <meta name="HandhledFriendly" content="true">
            <meta name="mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">

            <!--Styles and complements Bootstrap 5.3-->
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/me.styles.css">
        </head>

        <body class="h-100">
            <!--Coments-->
            <header>
                <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="../assets/img/logo.png" alt="Avatar Logo" style="width: 40px" class="" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsibleNavbar" aria-label="Boton de menú">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="home">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">Publicaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#team">Integrantes</a>
                                </li>
                            </ul>
                            <div class="d-flex">
                                <button class="btn btn-primary" type="button"
                                    onclick="location.href='logout.php'">Salir</button>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <main class="container pt-5">

            hol a todos


            </main>
            <!--Complements JS-->
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
            <?php
        }
    } else {
    // Si el usuario no está logueado, redirigir a la página de inicio de sesión
    header("Location: ./");

    }
?>
</body>

</html>