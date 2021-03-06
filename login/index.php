<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Area trabajadores</title>

        <!-- CSS -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		    <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- Favicon  -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
    </head>
    <body>
        <!-- Top content -->
        <div class="top-content inner-bg container row col-sm-6 col-sm-offset-3 form-box">
          <div class="form-top">
              <div class="form-top-left">
                  <p><img src="assets/files/logo.png" alt="logo TSI" title="Logo TSI" width="100" height="75" /></p>
                  <h3>Area privada empleados</h3>
                  <p>Introducir usuario y contrase&ntilde;a para loguearse:</p>
              </div>
              <div class="form-top-right">
                  <i class="fa fa-lock"></i>
              </div>
          </div>
          <div class="form-bottom">
              <form role="form" action="login.php" method="post" class="login-form">
                  <div class="form-group">
                      <label class="sr-only" for="form-username">Usuario...</label>
                      <input type="text" name="form-username" placeholder="Usuario..." class="form-username form-control" id="form-username">
                  </div>
                  <div class="form-group">
                      <label class="sr-only" for="form-password">Contrase&ntilde;a...</label>
                      <input type="password" name="form-password" placeholder="Contrase&ntilde;a..." class="form-password form-control" id="form-password">
                  </div>
                  <button type="submit" class="btn">Enviar!</button>
              </form>
          </div>
        </div>
        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
