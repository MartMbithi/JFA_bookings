<?php
    session_start();
    unset($_SESSION['js_id']);
    session_destroy();

    header("Location: index.php");
    exit;
?>