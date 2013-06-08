<?php
//suppression de la performance
include_once("code_connexion_pdo.php");
mysql_query("DELETE FROM `performance` WHERE `id_performance` =". $_GET['id']) or die(mysql_error());
header('Location: ges_performances.php?message=Suppression OK');