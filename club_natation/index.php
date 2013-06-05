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
                        
                    </div>
                    <div id="bloc2">
                        
                    </div>
                </div>
                <div id="contenu">

                </div>
            </div>
        </div>
    </body>
</html>
