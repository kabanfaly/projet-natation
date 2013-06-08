<?php

include_once("code_connexion_pdo.php");
mysql_query("DELETE FROM `categorie` WHERE `id_categorie` =". $_GET['id']) or die(mysql_error());
header('Location: ges_categories.php?message=Suppression OK');