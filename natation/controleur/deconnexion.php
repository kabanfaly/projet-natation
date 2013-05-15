<?php

if (!isset($_SESSION['admin'])) {
    session_register('admin');
}

$_SESSION['admin'] = false;
header('Location: ../index.php');
