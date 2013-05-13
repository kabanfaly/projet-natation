<?php

//Session pour les informations saisies par l'utlilisateur
if (!isset($_SESSION['contenu_epreuve'])) {
    session_register('contenu_epreuve');
}
//Session pour enregistrer l'id de l'epreuve
if (!isset($_SESSION['idepreuve'])) {
    session_register('idepreuve');
}

include '../model/class.epreuve.php';

if ($_POST) {

    //Recuparation des donnees du formulaire
    $id_type_de_nage = mysql_escape_string($_POST['idtype_de_nage']);
    $distance = mysql_escape_string($_POST['distance']);

    //Enregistrement des contenus tapes par l'utilisateur
    $_SESSION['contenu_epreuve'] = $_POST;


    if (isset($_SESSION['idepreuve'])) {
        if (epreuve::modifier($_SESSION['idepreuve'], $id_type_de_nage, $distance)) {
            //Redirection vers la page de gestion des epreuves
            header('Location: ../gestion_epreuves.php?message=La modification a été effectuée avec succès');
        }
    } else {
        try {
            //Enregistrement
            epreuve::enregistrer( $id_type_de_nage, $distance);

            //Vider la session contenant les elements saisie par l'utilisateur
            unset($_SESSION['contenu_epreuve']);

            //Redirection vers la page de gestion des nageurs
            header('Location: ../gestion_epreuves.php?message=L\'enregistrement a été effectuée avec succès');
        } catch (Exception $exc) {
            header('Location: ../formulaire_epreuve.php?action=ajout&message=' . $exc->getMessage());
        }
    }
} elseif ($_GET) {
    if (isset($_GET['idsuppression'])) {
        if (epreuve::supprimer($_GET['idsuppression'])) {
            header('Location: ../gestion_epreuves.php?message=La suppression a été effectuée avec succès');
        }
    } elseif (isset($_GET['idmodif'])) {
        //recuperer l'epreuve par son id
        $epreuve = epreuve::rechercherParId($_GET['idmodif']);

        //retinir les informations sur l'epreuve
        $_SESSION['contenu_epreuve'] = $epreuve;

        //Engistrement de l'id de l'epreuve dans la session pour la modification
        $_SESSION['idepreuve'] = $_GET['idmodif'];
        header('Location: ../formulaire_epreuve.php?action=modif');
    }
}