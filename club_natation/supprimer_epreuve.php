<?php

include_once("code_connexion_pdo.php");
mysql_query("DELETE FROM `epreuve` WHERE `id_epreuve` =". $_GET['id']) or die(mysql_error());
header('Location: ges_epreuves.php?message=Suppression OK');