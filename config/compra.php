<?php

  include('link.php');

  $user = $_POST['id_user'];
  $movie = $_POST['id_movie'];
  $sala = $_POST['id_sala'];
  $time = date("G:H:s");
  $gasto = $_POST["gasto"];
  $asientos = $_POST["asientos"];

  if (
    $user != "" &&
    $movie != "" &&
    $sala != ""
  ) {

  	mysqli_query($link, 'insert into boleto values (
      NULL,
  		"' . $user . '",
  		"' . $movie . '",
      "' . $sala . '",
      "' . $time . '"
  	)');

    $query = "SELECT * FROM sala where id = '" . $sala . "'";
    $result = $link->query($query);
    $row = $result->fetch_array(MYSQLI_BOTH);

    mysqli_query($link, 'UPDATE sala SET
      places="' . $row[1] . $asientos . '"
      WHERE
      id = "' . $sala . '"
    ');

    $query = "SELECT * FROM usrs where id = '" . $user . "'";
    $result = $link->query($query);
    $row = $result->fetch_array(MYSQLI_BOTH);

    mysqli_query($link, 'UPDATE usrs SET
      saldo="' . ($row[4] - $gasto) . '"
      WHERE
      id = "' . $user . '"
    ');

    echo "Correcto";

  }else{
    echo "La contraseña no coincide";
  }

?>
