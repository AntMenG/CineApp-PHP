<?php
    include('link.php');

    $n = $_POST['n'];
    $s = $_POST['s'];
    $g = $_POST['g'];
    $du = $_POST['du'];
    $d = $_POST['d'];
    $a = $_POST['a'];

    mysqli_query($link, 'insert into movies values (
      NULL,
      "' . $n . '",
      "' . $g . '",
      "' . $du . '",
      "' . $s . '",
      "' . $d . '",
      "' . $a . '",
      "1",
      "1"
    )');

    $id = 0;

    $query = "SELECT * FROM movies WHERE nombre = '" . $n . "' LIMIT 1";

    $result = $link->query($query);

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    		$id = $row[0];
    }

   $target_path = "../public/img/cover/";
   $target_path = $target_path . basename('movie' . $id . '.jpg');
   if(move_uploaded_file($_FILES['sc']['tmp_name'], $target_path)) {
     header('Location: ../views/add-movie.php');
   } else{
     echo "Ha ocurrido un error, trate de nuevo!";
   }

?>
