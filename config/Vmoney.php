<?php

  include('link.php');

  $u = $_POST['u'];
  $m = $_POST['m'];

  if (
    $u != "0" &&
    $m != ""
  ) {

    $query = "SELECT * FROM usrs where id = '" . $u . "'";
    $result = $link->query($query);
    $row = $result->fetch_array(MYSQLI_BOTH);

    mysqli_query($link, 'UPDATE usrs SET
      saldo="' . ($row[4] + $m) . '"
      WHERE
      id = "' . $u . '"
    ');

    header("Location: /views/ventas.php");

  }else{
    echo "Ha ocurrido un error";
  }

?>
