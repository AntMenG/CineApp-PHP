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
    <script type="text/javascript">
      $( function () {
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#blah').css('display','block');
              $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
          }
        }
        $("#imgInp").change(function(){
          readURL(this);
        });
      });
    </script>
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

    <div id="add-movie">
      <form enctype="multipart/form-data" action="../config/Nmovie.php" method="POST">
        <label class="custom-file-upload">
          <input type="file" name="sc" id="imgInp" required />
          PORTADA
          <img id="blah" src="#" alt="your image" />
        </label>
        <input type="text" name="n" placeholder="INGRESAR NOMBRE" required><br>
        <input type="text" name="s" placeholder="INGRESAR SINOPSIS" required><br>
        <input type="text" name="g" placeholder="INGRESAR GENERO" required><br>
        <input type="text" name="du" placeholder="INGRESAR DURACION" required><br>
        <input type="text" name="d" placeholder="INGRESAR DIRECTOR" required><br>
        <input type="text" name="a" placeholder="INGRESAR ACTORES" required><br>
        <input type="submit" value="REGISTRAR PELICULA">
      </form>
    </div>

  </body>
</html>
