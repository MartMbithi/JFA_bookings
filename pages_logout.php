<?php
    session_start();
    unset($_SESSION['jp_id']);
    session_destroy();

    header("Location: index.php");
    exit;
?>