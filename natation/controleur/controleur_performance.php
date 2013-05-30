<?php

//Session pour les informations saisies par l'utlilisateur
if (!isset($_SESSION['contenu_performance'])) {
    session_register('contenu_performance');
}
//Session pour enregistrer l'id de la performance
if (!isset($_SESSION['idperformance'])) {
    session_register('idperformance');
}

include '../model/class.performance.php';

if ($_POST) {

    //Recuparation des donnees du formulaire
    $id_nageur = mysql_escape_string($_POST['idnageur']);
    $id_epreuve = mysql_escape_string($_POST['idepreuve']);
    $temps = mysql_escape_string($_POST['temps']);
    $points = mysql_escape_string($_POST['points']);
    $annee = mysql_escape_string($_POST['annee']);

    //Enregistrement des contenus tapes par l'utilisateur
    $_SESSION['contenu_performance'] = $_POST;

    if (isset($_SESSION['idperformance'])) {
        //Verification du format du temps
        if (!preg_match("/^([0-9]{1,2}:)*[0-9]{1,2}\.[0-9]{1,2}$/i", $temps)) {
            header('Location: ../formulaire_performance.php?action=modif&message=Le temps défini est invalide');
        } elseif ($id_nageur === '') {
            header('Location: ../formulaire_performance.php?action=modif&message=Veuillez choisir un nageur');
        } elseif ($id_epreuve === '') {
            header('Location: ../formulaire_performance.php?action=modif&message=Veuillez choisir une épreuve');
        } elseif (performance::modifier($_SESSION['idperformance'], $points, $temps, $id_nageur, $id_epreuve, $annee)) {
            //Redirection vers la page de gestion des performances
            unset($_SESSION['contenu_performance']);
            header('Location: ../gestion_performances.php?message=La modification a été effectuée avec succès');
        }
    } else {
        try {
            //Verification du format du temps
            if (!preg_match("/^([0-9]{1,2}:)*[0-9]{1,2}\.[0-9]{1,2}$/i", $temps)) {
                header('Location: ../formulaire_performance.php?action=modif&message=Le temps défini est invalide');
            } elseif ($id_nageur === '') {
                header('Location: ../formulaire_performance.php?action=modif&message=Veuillez choisir un nageur');
            } elseif ($id_epreuve === '') {
                header('Location: ../formulaire_performance.php?action=modif&message=Veuillez choisir une épreuve');
            } else {
                //Enregistrement
                performance::enregistrer($points, $temps, $id_nageur, $id_epreuve, $annee);

                //Redirection vers la page de gestion des performance
                header('Location: ../gestion_performances.php?message=L\'enregistrement a été effectuée avec succès');
            }
        } catch (Exception $exc) {
            header('Location: ../formulaire_performance.php?action=ajout&message=' . $exc->getMessage());
        }
    }
} elseif ($_GET) {
    if (isset($_GET['idsuppression'])) {
        if (performance::supprimer($_GET['idsuppression'])) {
            header('Location: ../gestion_performances.php?message=La suppression a été effectuée avec succès');
        }
    } elseif (isset($_GET['idmodif'])) {
        //recuperer la performance par son id
        $performance = performance::rechercherParId($_GET['idmodif']);

        //retinir les informations sur la performance
        $_SESSION['contenu_performance'] = $performance;

        //Engistrement de l'id de la performance dans la session pour la modification
        $_SESSION['idperformance'] = $_GET['idmodif'];
        header('Location: ../formulaire_performance.php?action=modif');
    }
}