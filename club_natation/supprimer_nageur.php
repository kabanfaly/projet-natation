<?php
//suppression du nageur
include_once("code_connexion_pdo.php");
mysql_query("DELETE FROM `nageur` WHERE `id_nageur` =". $_GET['id']) or die(mysql_error());
header('Location: ges_nageurs.php?message=Suppression OK');