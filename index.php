<?php
  include('config/link.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>CINETRON | HOME</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <script type="text/javascript" src="/public/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="/public/js/scroll.js"></script>
    <script type="text/javascript">
      var mid = [];
      var mnom = [];
      var mgen = [];
      var mdur = [];
      var msin = [];
      var mdir = [];
      var mact = [];
      var msal = [];
      <?php
        $i = 1;
        $query = "SELECT * FROM movies";
        $result = $link->query($query);
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
      ?>
      mid[<?php echo $row[0]; ?>] = "<?php echo $row[0]; ?>";
      mnom[<?php echo $row[0]; ?>] = "<?php echo $row[1]; ?>";
      mgen[<?php echo $row[0]; ?>] = "<?php echo $row[2]; ?>";
      mdur[<?php echo $row[0]; ?>] = "<?php echo $row[3]; ?>";
      msin[<?php echo $row[0]; ?>] = "<?php echo $row[4]; ?>";
      mdir[<?php echo $row[0]; ?>] = "<?php echo $row[5]; ?>";
      mact[<?php echo $row[0]; ?>] = "<?php echo $row[6]; ?>";
      msal[<?php echo $row[0]; ?>] = "<?php echo $row[7]; ?>";
      <?php
        }
      ?>
      $(function () {
        //movie(9);
        $('.movie').on('click', function() {
            movie(parseInt($(this).attr('data-movie')));
        });
        function movie (id) {
          $('#infTitle span').text(mnom[id]);
          $('#infTitle a').attr('href','/views/buy.php?movie=' + mid[id]);
          $('#infMovie p').text(msin[id]);
          $('#infRepartAct').text(mact[id]);
          $('#infRepartDir').text(mdir[id]);
          $('#cover section').css({
            "background" : "url('/public/img/cover/movie" + mid[id] + ".jpg')",
            "background-position" : "center",
          	"background-size" : "cover"
          });
          //$('#cover > img').attr('src','/public/img/cover/movie' + mid[id] + '.jpg');
          $('#cover > img').css('filter','blur(15px)');
          setTimeout(function(){
            $('#cover > img').attr('src','/public/img/cover/movie' + mid[id] + '.jpg');
            $('#cover > img').css('filter','blur(0px)');
          }, 300);
        }
      });
    </script>
  </head>
  <body>

    <?php
      if(!$_SESSION['user']) {
    ?>
    <div id="Loggin">
      <svg viewBox="0 0 1320 300">
        <!-- Symbol -->
        <symbol id="s-text">
          <text text-anchor="middle"
                x="50%" y="50%" dy=".35em">
            CINETRON
          </text>
        </symbol>
        <!-- Duplicate symbols -->
        <use xlink:href="#s-text" class="text"></use>
        <use xlink:href="#s-text" class="text"></use>
        <use xlink:href="#s-text" class="text"></use>
        <use xlink:href="#s-text" class="text"></use>
        <use xlink:href="#s-text" class="text"></use>
      </svg>
      <form id="mainLog" action="/config/session.php" method="post">
        <input type="text" name="user" placeholder="INGRESA TU USUARIO">
        <input type="password" name="pass" placeholder="INGRESA TU CONTRASEÑA"><br>
        <input type="submit" name="" value="INGRESAR">
      </form>

      <div class="mouse"></div>
      <div id="botShadow">
      </div>
    </div>
    <?php
      }
    ?>

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
          <?php if ($_SESSION['type'] == 1) { ?>
          <a href="/views/add-user.php">AGREGAR USUARIO</a>
          <?php } ?>
          <?php if ($_SESSION['type'] <= 2) { ?>
          <a href="/views/ventas.php">VENTAS</a>
          <?php } ?>
          <?php } ?>
        </button>
      </header>

      <div id="cover">
        <section style="
          background: url('/public/img/cover/movie1.jpg');
          background-position: center;
        	background-size:cover;
        "></section>
        <img src="/public/img/cover/movie1.jpg" height="300" alt="">
        <div id="info">
          <div id="infTitle">
            <span>
              Mujer Maravilla
            </span>
            <a href="/views/buy.php?movie=1">COMPRAR ENTRADA</a>
          </div>
          <div id="infMovie">
            <div>
              <span>SINOPSIS</span>
              <p>
                Antes de ser Wonder Woman era Diana, princesa de las Amazonas
                entrenada para ser una guerrera invencible. Diana ha sido
                criada en una isla paradisíaca protegida. Hasta que un día
                un piloto americano que tiene un accidente y acaba en sus
                costas le habla de un gran conflicto existente en el mundo
                [Primera Guerra Mundial]. Diana decide salir de la isla
                convencida de que puede detener la terrible amenaza. Mientras
                lucha junto a los hombres en la guerra que acabará con todas
                las guerras, Diana descubre todos sus poderes, y de paso, su
                verdadero destino.
              </p>
            </div>
          </div>
          <div id="infRepart">
            <div>
              <span>ACTORES</span><br>
              <span id="infRepartAct">
                Chris Pine, Robin Wright, Gal Gadot
              </span>
              <br>
              <span>DIRECTOR / ES</span><br>
              <span id="infRepartDir">
                Patty Jenkins
              </span>
            </div>
          </div>
          <div id="Cartelera">
            <span>CARTELERA</span>
            <?php if ($_SESSION['type'] == 1) { ?>
            <a href="/views/add-movie.php">
              AGREGAR PELICULA
            </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <div id="Movies">
      <?php
        $query = "SELECT * FROM movies";

        $result = $link->query($query);

        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

      ?>
      <button class="movie" data-movie="<?php echo $row[0] ?>">
        <img src="/public/img/cover/<?php echo 'movie' . $row[0]; ?>.jpg">
        <div>
          <span>
            <?php echo $row[1]; ?>
          </span>
        </div>
        <?php if ($_SESSION['type'] == 1) { ?>
          <a href="/config/remove.php?movie=<?php echo $row[0] ?>">x</a>
        <?php } ?>
      </button>
      <?php
        }
      ?>
    </div>

  </body>
</html>
