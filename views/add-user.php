<?php
  include('../config/link.php');
  session_start();
  if(!$_SESSION['user'] || $_SESSION['type'] != 1) {
    header('Location: /');
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>CINETRON | NEW MOVIE</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <script type="text/javascript" src="/public/js/jquery-3.2.0.min.js"></script>
  </head>
  <body>

    <div id="space">
      <header>
        <a id="Title" href="/">
          CINETRON
        </a>
        <button id="is">
          <?php if (!$_SESSION['user']) { ?>
          INICIAR SESION
          <?php } else { echo $_SESSION['user']; ?>
          <a href="/config/exit.php">CERRAR SESSION</a>
          <a href="/views/add-user.php">AGREGAR USUARIO</a>
          <?php } ?>
        </button>
      </header>
    </div>

    <div id="add-movie" class="add-user">
      <form action="../config/Nuser.php" method="POST">
        <input type="text" name="nu" placeholder="INGRESAR NOMBRE" required><br>
        <input type="password" name="pu" placeholder="INGRESAR CONTRASEÑA" required><br>
        <input type="password" name="pr" placeholder="REINGRESA CONTRASEÑA" required><br>
        <select class="" name="tu">
          <option value="0">SELECCIONA UN TIPO</option>
          <option value="1">ADMINISTRADOR</option>
          <option value="2">VENDEDOR</option>
          <option value="3">CLIENTE</option>
        </select>
        <input type="submit" value="REGISTRAR PELICULA">
      </form>
    </div>

  </body>
</html>
