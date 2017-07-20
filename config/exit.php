<?php
    session_start();
    $_SESSION['user'] = null;
    $_SESSION['type'] = null;
    session_destroy();
    header('Location:/');
?>