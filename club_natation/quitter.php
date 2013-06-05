<?php

if (!isset($_SESSION['connexionOK'])) {
    session_register('connexionOK');
}

$_SESSION['connexionOK'] = NULL;
header('Location: index.php');
