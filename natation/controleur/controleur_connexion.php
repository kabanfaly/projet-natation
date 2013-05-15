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

    //si il n'existe aucun administrateur (lors d'une permiere connexion)
    if (administrateur::aucunAdministrateur()) {
        if ($login !== 'admin' && $mdp !== 'admin') {
            header('Location: ../index.php?message=Login ou mot de passe incorrect');
        } else {
            administrateur::enregistrer($login, $mdp);
            $_SESSION['admin'] = array('login' => $login, 'mot_de_passe' => $mdp);
            header('Location:../index.php');
        }
    } else {
        if (!administrateur::rechercherParLoginMdp($login, $mdp)) {
            header('Location: ../index.php?message=Login ou mot de passe incorrect');
        } else {
            $_SESSION['admin'] = array('login' => $login, 'mot_de_passe' => $mdp);
            header('Location: ../index.php');
        }
    }
}