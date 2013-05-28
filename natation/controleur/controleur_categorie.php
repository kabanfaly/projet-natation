<?php

//Session pour les informations saisies par l'utlilisateur
if (!isset($_SESSION['contenu_categorie'])) {
    session_register('contenu_categorie');
}
//Session pour enregistrer l'id de la categorie
if (!isset($_SESSION['idcategorie'])) {
    session_register('idcategorie');
}

include '../model/class.categorie.php';

if ($_POST) {

    //Recuperation des donnees du formulaire
    $categorie = mysql_escape_string($_POST['categorie']);
    $description = mysql_escape_string($_POST['description']);

    //Enregistrement des contenus tapés par l'utilisateur
    $_SESSION['contenu_categorie'] = $_POST;
 
    //enregistrement de la categorie
    if (isset($_SESSION['idcategorie'])) {
        if (categorie::modifier($_SESSION['idcategorie'], $categorie, $description)) {
            //Redirection vers la page de gestion des categoriess
            header('Location: ../gestion_categories.php?message=La modification a été effectuée avec succès');
        }
    } else {
        try {
            //Enregistrement
            categorie::enregistrer($categorie, $description);
            
            //Redirection vers la page de gestion des categoriess
            header('Location: ../gestion_categories.php?message=L\'enregistrement a été effectuée avec succès');
        } catch (Exception $exc) {
            header('Location: ../formulaire_categorie.php?action=ajout&message=' . $exc->getMessage());
        }
    }
} elseif ($_GET) {
    if (isset($_GET['idsuppression'])) {
        if (categorie::supprimer($_GET['idsuppression'])) {
            header('Location: ../gestion_categories.php?message=La suppression a été effectuée avec succès');
        }
    } elseif (isset($_GET['idmodif'])) {
        //recuperer la categorie par son id
        $categorie_nage = categorie::rechercherParId($_GET['idmodif']);

        //retinir les informations sur la categorie
        $_SESSION['contenu_categorie'] = $categorie_nage;

        //Engistrement de l'id de la categorie dans la session pour la modification
        $_SESSION['idcategorie'] = $_GET['idmodif'];
        header('Location: ../formulaire_categorie.php?action=modif');
    }
}