<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>::. Camiones</title>
  <link rel="stylesheet" href="login/normalize.min.css">
<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='login/all.min.css'>
<link rel="stylesheet" href="login/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-container">
  <div class="logo-container fondo">
    <img src="img/logo.png" alt="">
  </div>
  <div class=" vertical-center text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <form method="post" action="autenticacion.php">
            <img class="mb-4" src="img/logo.png" width="200">
            <h1 class="h3 mb-3 fw-normal">Inicio de sesión</h1>
            <div class="form-floating">
              <input type="text" name="username" class="form-control" id="username" placeholder="Nombre de Usuario">
              <label for="username">Nombre de Usuario</label>
            </div>
            <div class="form-floating">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              <label for="password">Contraseña</label>
            </div>
            <br>
            <button class="w-100 btn btn-lg btn-primary">Ingresar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='assets/js/bootstrap.bundle.min.js'></script>

</body>
</html>
