<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="style.css" rel="stylesheet" />
        <title>Club de natation</title>
    </head>
    <body>
        <div id="principal">
            <div id="header">
                <div id="blank"></div>
                <span id="titre">Club Omnisports Vernouillet</span>
            </div>
            <div id="menuHoriz">
                <ul>
                    <?php
                    if (isset($_SESSION['connexionOK']) && $_SESSION['connexionOK']) {
                        ?>
                        <li><a href="quitter.php">Déconnexion</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a href="connexion.php">Connexion</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="contenuCentral">
                <div id="menuVert"> 
                    <div id="bloc1">
                        <div id="nav1"><a href="nageurs.php">Liste des nageurs</a></div>
                    </div>
                    <?php
                    if (isset($_SESSION['connexionOK']) && $_SESSION['connexionOK']) {
                        ?>
                        <div id="bloc2">
                            <div id="nav2"><a href="ges_categories.php">Gestion des catégories</a></div>
                            <div id="nav2"><a href="ges_nageurs.php">Gestion des nageurs</a></div>
                            <div id="nav2"><a href="ges_epreuves.php">Gestion des épreuves</a></div>
                            <div id="nav2"><a href="ges_performances.php">Gestion des performances</a></div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
             