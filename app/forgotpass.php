<?php
require 'conn.php';
session_start();

if (isset($_POST['btnforgot'])) {
    $email = $_POST['email'];
    
    $fpass = $conn->prepare('SELECT * FROM user WHERE email = ? LIMIT 1');
    $fpass->bindParam(1, $email);
    $fpass->execute();
    $row = $fpass->fetch(PDO::FETCH_ASSOC);

    if ($fpass->rowCount() == 1) {
       $id = base64_encode($row['iduser']);
       $token = md5(uniqid(rand()));

       $uptoken = $conn->prepare('UPDATE user SET token = ? WHERE email = ?');
       $uptoken->bindParam(1, $token);
       $uptoken->bindParam(2, $email);
       $uptoken->execute();

       // Prepara el mensaje y el asunto del correo que voy a enviar

       $subject = '=?UTF-8?B?'.base64_encode("Restablecer Contraseña"). "=?=";

       $message = "<body style='margin:0;padding:0;word-spacing:normal;background-color:#ffffff;text-align: center;'>
    <div aria-roledescription='email' lang='es-CO'
        style='text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ffffff;'>
        <table style='width:100%;border:none;border-spacing:0;'>
            <tbody>
                <tr>
                    <td>
                        <table
                            style='width:100%;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                            <tbody>
                                <tr>
                                    <td style='text-align: center;'>
                                        <img src='https://sbm.bombushouse.com.co/assets/img/logob.png' id='Logo_Sena'
                                            style='width:20%;max-width:100px;height:auto;border:none;text-decoration:none;color:#ffffff;'>
                                    </td>
                                    <td style='padding:30px;background-color:#ffffff;text-align: right;'>
                                        <h2
                                            style='margin-top:0;line-height:32px;font-weight:bold;letter-spacing:-0.02em;'>
                                            Restablecer Contrase&ntilde;a</h2>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table
                            style='width:100%;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;'>
                            <tbody>
                                <tr>
                                    <td style='padding:20px;background-color:#ffffff;text-align: center;'>
                                        <h2
                                            style='margin-top:0;line-height:32px;font-weight:bold;letter-spacing:-0.02em;'>
                                            Bienvenido(a) a Pub^Pdf!</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style='padding:20px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);'>
                                        <div class='col-lge'
                                            style='display:initial;width:100%;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:18px;line-height:22px;color:#363636;'>
                                            <p style='margin:0;padding: 4px;text-align: center;'> Solicitaste el
                                                restablecimiento de su contrase&ntilde;a con el correo $email. Haga clic
                                                en el siguiente enlace para restablecerla, si no solicitaste simplemente
                                                ignora este mensaje.</p>
                                            <p style='padding:20px;margin:0;text-align: center;'><a
                                                    href='http://localhost/personal/sbm/app/resetpass?id=$id&code=$token'
                                                    style='background: #af6000d4; text-decoration: none; padding: 10px 25px; color: #ffffff; border-radius: 4px; display:inline-block;'><span
                                                        style='font-weight:bold;'>Restablecer</span></a></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style='padding:20px;text-align:center;font-size:12px;background-color:#1565c0;color:#cccccc;'>
                                        <p
                                            style='margin:0;font-size:14px;line-height:20px;font-weight:bold;color: #ffffff;'>
                                            &copy; Copyright 2025</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>";

       include 'config.mailer.php';
    }
}

?>
<!DOCTYPE html>
<html lang="es-CO" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pub^Pdf</title>
  <!--Logo Favicon-->
  <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">

  <!--SEO Tags-->
  <meta name="author" content="Pub Pdf">
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
</head>

<body>
  <main class="form-signin m-auto pt-5 mt-4">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <img src="../assets/img/logo.png" alt="Logo" width="72" height="72">
          <h1 class="display-6">Recuperación Contraseña</h1>
        </div>
        <!--Alerts-->
        <?php if (isset($msg)) { ?>
          <div class="alert alert-<?php echo $msg[1]; ?> fade show" role="alert">
            <strong>Success!</strong> <?php echo $msg[0]; ?>
          </div>
        <?php } else { ?>
          <div class="alert alert-warning" role="alert">
            Se enviara un link a su correo para restablecer su contraseña.
          </div>
        <?php } ?>
        <!--Alerts-->


        <form action="" method="post" enctype="application/x-www-form-urlencoded">
          <div class="mb-3 mt-3">
            <label for="email" class="form-label">Correo:</label>
            <input type="email" class="form-control" id="email" placeholder="Ingrese email" name="email" required>
          </div>

          <div class="d-grid gap-2 mb-4">
            <button type="submit" class="float-end btn btn-primary" name="btnforgot">Restablecer</button>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <a href="reguser">Registráte</a>
            </div>
            <div class="col-sm-6 text-end">
              <a href="./">Iniciar Sesión</a>
            </div>
          </div>

        </form>
      </div>
      <div class="card-footer bg-dark">
        <p class="text-center text-light pt-1" title="CACJX">Carlos Andres Castro - &copy;Copyright 2025</p>
      </div>
    </div>
  </main>
  <!--Complements JS-->
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>