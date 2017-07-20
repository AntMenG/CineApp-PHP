<?php

  include('link.php');

  $nu = $_POST['nu'];
  $pu = $_POST['pu'];
  $pr = $_POST['pr'];
  $tu = $_POST['tu'];

  if (
    $nu != "" &&
    $pu != "" &&
    $pr != "" &&
    $tu != "0" &&
    $pu == $pr
  ) {
  	$options = [
      'cost' => 10,
    ];

    $hash = password_hash($pu, PASSWORD_DEFAULT, $options);

  	mysqli_query($link, 'insert into usrs values (
      NULL,
  		"' . $nu . '",
  		"' . $hash . '",
      "' . $tu . '",
      "116"
  	)');
    header('Location: /views/add-user.php');
  }
  echo "La contraseña no coincide";
?>
