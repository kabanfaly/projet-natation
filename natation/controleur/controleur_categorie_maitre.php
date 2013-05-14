<?php

//Session pour les informations saisies par l'utlilisateur
if (!isset($_SESSION['contenu_categorie_maitre'])) {
    session_register('contenu_categorie_maitre');
}
//Session pour enregistrer l'id de la categorie maitre
if (!isset($_SESSION['idcategorie_maitre'])) {
    session_register('idcategorie_maitre');
}

include '../model/class.categorie_maitre.php';

if ($_POST) {

    //Recuparation des donnees du formulaire
    $categorie = mysql_escape_string($_POST['categorie']);

    //Enregistrement des contenus tapes par l'utilisateur
    $_SESSION['contenu_categorie_maitre'] = $_POST;
 
    //enregistrement de la categorie maitre
    if (isset($_SESSION['idcategorie_maitre'])) {
        if (categorie_maitre::modifier($_SESSION['idcategorie_maitre'], $categorie)) {
            //Redirection vers la page de gestion des categories maitres
            header('Location: ../gestion_categories_maitres.php?message=La modification a été effectuée avec succès');
        }
    } else {
        try {
            //Enregistrement
            categorie_maitre::enregistrer($categorie);

            //Vider la session contenant les elements saisies par l'utilisateur
            unset($_SESSION['contenu_categorie_maitre']);

            //Redirection vers la page de gestion des categories maitres
            header('Location: ../gestion_categories_maitres.php?message=L\'enregistrement a été effectuée avec succès');
        } catch (Exception $exc) {
            header('Location: ../formulaire_categorie_maitre.php?action=ajout&message=' . $exc->getMessage());
        }
    }
} elseif ($_GET) {
    if (isset($_GET['idsuppression'])) {
        if (categorie_maitre::supprimer($_GET['idsuppression'])) {
            header('Location: ../gestion_categories_maitres.php?message=La suppression a été effectuée avec succès');
        }
    } elseif (isset($_GET['idmodif'])) {
        //recuperer la categorie maitre par son id
        $categorie_nage = categorie_maitre::rechercherParId($_GET['idmodif']);

        //retinir les informations sur la categorie maitre
        $_SESSION['contenu_categorie_maitre'] = $categorie_nage;

        //Engistrement de l'id de la categorie maitre dans la session pour la modification
        $_SESSION['idcategorie_maitre'] = $_GET['idmodif'];
        header('Location: ../formulaire_categorie_maitre.php?action=modif');
    }
}