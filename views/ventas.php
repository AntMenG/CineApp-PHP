<?php
  include('../config/link.php');
  session_start();
  if(!$_SESSION['user'] || $_SESSION['type'] > 2) {
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
      <form action="../config/Vmoney.php" method="POST">
        <select class="" name="u">
          <option value="0">SELECCIONA UN USUARIO</option>
        <?php
          $querys = "SELECT * FROM usrs";
          $results = $link->query($querys);
          while ($rows = mysqli_fetch_array($results, MYSQLI_BOTH)) {
        ?>
          <option value="<?php echo $rows[0]; ?>">
            <?php echo $rows[1]; ?>
          </option>
        <?php
          }
        ?>
        </select>
        <input type="text" name="m" placeholder="INGRESAR DINERO ELECTRONICO" required><br>
        <input type="submit" value="VENDER DINERO">
      </form>
    </div>

  </body>
</html>
