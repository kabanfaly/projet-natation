<?php

//Session pour les informations saisies par l'utlilisateur
if (!isset($_SESSION['contenu_type_nage'])) {
    session_register('contenu_type_nage');
}
//Session pour enregistrer l'id du type de nage
if (!isset($_SESSION['idtype_de_nage'])) {
    session_register('idtype_de_nage');
}

include '../model/class.type_nage.php';

if ($_POST) {

    //Recuparation des donnees du formulaire
    $type = htmlentities(mysql_escape_string($_POST['type']));

    //Enregistrement des contenus tapes par l'utilisateur
    $_SESSION['contenu_type_nage'] = $_POST;
 
    //enregistrement du nageur
    if (isset($_SESSION['idtype_de_nage'])) {
        if (type_nage::modifier($_SESSION['idtype_de_nage'], $type)) {
            //Redirection vers la page de gestion des nageurs
            header('Location: ../gestion_types_nage.php?message=La modification a été effectuée avec succès');
        }
    } else {
        try {
            //Enregistrement
            type_nage::enregistrer($type);

            //Redirection vers la page de gestion des nageurs
            header('Location: ../gestion_types_nage.php?message=L\'enregistrement a été effectuée avec succès');
        } catch (Exception $exc) {
            header('Location: ../formulaire_type_nage.php?action=ajout&message=' . $exc->getMessage());
        }
    }
} elseif ($_GET) {
    if (isset($_GET['idsuppression'])) {
        if (type_nage::supprimer($_GET['idsuppression'])) {
            header('Location: ../gestion_types_nage.php?message=La suppression a été effectuée avec succès');
        }
    } elseif (isset($_GET['idmodif'])) {
        //recuperer le type de nage par son id
        $type_nage = type_nage::rechercherParId($_GET['idmodif']);

        //retinir les informations sur le type de nage
        $_SESSION['contenu_type_nage'] = $type_nage;

        //Engistrement de l'id du type de nage dans la session pour la modification
        $_SESSION['idtype_de_nage'] = $_GET['idmodif'];
        header('Location: ../formulaire_type_nage.php?action=modif');
    }
}