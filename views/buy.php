<?php
  include('../config/link.php');
  session_start();
  if(
    !$_SESSION['user']
  ) {
    header('Location: /');
  }
  $query = "SELECT * FROM movies where id = '" . $_GET['movie'] . "' limit 1";
  $result = $link->query($query);
  while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>CINETRON | <?php echo $row[1]; ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
    <script type="text/javascript" src="/public/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript">
      <?php
        $querys = "SELECT * FROM sala where id = '" . $row[8] . "' limit 1";
        $results = $link->query($querys);
        while ($rows = mysqli_fetch_array($results, MYSQLI_BOTH)) {
      ?>
        var asientos = '<?php echo $rows[1]; ?>';
      <?php
        }
      ?>
      var a = -1;
      var asiento = [];
      for (var i = 0; i < asientos.length; i++) {
        if (asientos[i] != ",") {
          asiento[a] += asientos[i];
        } else {
          a++;
          asiento[a] = "";
        }
      }
      $( function () {
        for (var i = 0; i < asiento.length; i++) {
          $('.asiento[data-asiento="' + asiento[i] + '"]').addClass(
            'asoc'
          );
        }
        var as = -1;
        var asmi = [];
        var misasientos;
        var cantidad = 0;
        $('.asiento').click( function () {
          if ($(this).attr('class') == 'asiento asmi') {
            asmi[as] = null;
            as--;
            cantidad++;
            $(this).removeClass('asmi');
          }else if ($(this).attr('class') != 'asiento asoc' && cantidad > 0) {
            $(this).addClass('asmi');
            as++;
            cantidad--;
            asmi[as] = $(this).attr('data-asiento');
          }
          misasientos = asmi;
          if (misasientos[misasientos.length - 1] != ",") {
            misasientos += ',';
          }
          $('input[name="asientos"]').val(misasientos);
        });
        $("#costo").change(function(){
          $('.asmi').removeClass('asmi');
          $("#tcosto span").text(
            $(this).val() * $("#precio #elpre").text()
          );
          if ($(this).val() > 0) {
            cantidad = $(this).val();
            $('#salaBlock').css('display','none');
          } else {
            cantidad = 0;
            $('#salaBlock').css('display','block');
          }
        });
        $('#comprar').click( function () {
          var dinero = parseInt($('#mipre').text());
          var costo = parseInt($("#tcosto span").text());
          if (costo <= dinero && costo != 0) {
            if (cantidad == 0) {
              $.post( "/config/compra.php", {
          			id_user: "<?php echo $_SESSION['user-id']; ?>",
          			id_movie: '<?php echo $row[0]; ?>',
          			id_sala: '<?php echo $row[8]; ?>',
                asientos: $('input[name="asientos"]').val(),
                gasto: costo
          		}, function( data ) {
          			alert( data );
                $('#mipre').text(
                  dinero - costo
                );
                $("#costo").val('0');
                $('.asmi').addClass('asoc');
                $('.asmi').removeClass('asmi');
                $('#salaBlock').css('display','block');
          		});
            } else {
              alert("No has seleccionado todos los acientos");
            }
          } else if (costo == 0) {
            alert("No has seleccionado un número de boletos");
          } else {
            alert("No tienes dinero suficiente");
          }
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
          <?php } ?>
          <?php if ($_SESSION['type'] == 1) { ?>
          <a href="/views/add-user.php">AGREGAR USUARIO</a>
          <?php } ?>
          <?php if ($_SESSION['type'] <= 2) { ?>
          <a href="/views/ventas.php">VENTAS</a>
          <?php } ?>
        </button>
      </header>
    </div>

    <section id="secback" style="
    	background: url('/public/img/cover/movie<?php echo $row[0]; ?>.jpg');
      background-position: center;
    	background-size:cover;
    "></section>

    <div id="buy">
      <div id="formu">
        <img src="/public/img/cover/movie<?php echo $row[0]; ?>.jpg" />
        <span id="title"><?php echo $row[1]; ?></span>
        <div id="form">
          <?php
            $querys = "SELECT * FROM price where id = '1' limit 1";
            $results = $link->query($querys);
            while ($rows = mysqli_fetch_array($results, MYSQLI_BOTH)) {
              $querysu = "SELECT * FROM usrs where user = '". $_SESSION['user'] . "' limit 1";
              $resultsu = $link->query($querysu);
              while ($rowsu = mysqli_fetch_array($resultsu, MYSQLI_BOTH)) {
          ?>
          <h4 id="precio">
            PRECIO:<?php echo ' $<span id="elpre">'.$rows[1].'</span>'; ?>
            <?php echo ', TU TIENES: $<span id="mipre">'.$rowsu[4].'</span>'; ?>
          </h4>
          <?php
              }
            }
          ?>
          <input id="costo" type="number" max="9" min="0" name="pu" placeholder="BOLETOS" required><br>
          <h4 id="tcosto">
            COSTO: $<span>0</span>
          </h4>
          <input type="hidden" name="asientos" value="">
          <button id="comprar" type="button" name="button">
            COMPRAR
          </button>
        </div>
      </div>
      <div id="salaBlock"></div>
      <div id="sala">
        <?php
          $top = 0;
          $fill = array('A','B','C','D','E');
          for($f = 0; $f < 5; $f++) {
        ?>
          <div class="fill" style="top: <?php echo $top; ?>%;">
            <button class="SF">
              <?php echo $fill[$f]; ?>
            </button>
            <div>
            <?php for($i = 1; $i <= 10; $i++) { ?>
              <button type="button" class="asiento" data-asiento="<?php echo $fill[$f] . $i; ?>">
                <span>
                  <?php echo $fill[$f] . $i; ?>
                </span>
              </button>
            <?php } ?>
            </div>
          </div>
        <?php
          $top += 20;
          }
        ?>
      </div>
    </div>

  </body>
</html>
<?php
  }
?>
