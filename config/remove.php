<?php

  include('link.php');

  if (
    $_GET['movie'] != ""
  ) {

  	mysqli_query($link, 'delete from movies where id = "' . $_GET['movie'] . '"');
    header('Location: /');

  }
?>
