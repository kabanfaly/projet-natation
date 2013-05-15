<?php

//Session pour la connexion d'un administrateur
if (!isset($_SESSION['admin'])) {
    session_register('admin');
}
//inclusion de la classe administrateur
include '../model/class.administrateur.php';

if ($_POST) {
    $login = mysql_escape_string($_POST['login']);
    $mdp = mysql_escape_string($_POST['mot_de_passe']);
    $re_mdp = mysql_escape_string($_POST['re_mot_de_passe']);
    if ($re_mdp !== $mdp) {
        header('Location: ../formulaire_admin.php?message=Les mots mots de passe ne sont pas identiques');
    } else {
        administrateur::modifier($_SESSION['admin']['login'], $login, $mdp);
        header('Location: ../admin.php?message=La modification a été effectuée avec succès');
    }
}