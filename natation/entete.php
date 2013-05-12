<?php
session_start();
$page = $_SERVER['SCRIPT_NAME'];
$titre = '';
//Si on est sur la page d'accueil
if (strpos($page, 'index') !== false) {
    $titre = 'Club de natation';
} else
//Si on est sur la page des nageurs
if (strpos($page, 'nageurs') !== false) {
    $titre = 'Nageurs';
} else
//Si on est sur la page des competition
if (strpos($page, 'competitions') !== false) {
    $titre = 'Comp&eacute;titions';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $titre ?></title>
        <link type="text/css" href="css/style.css"  rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>    
    <body>
        <div id="all">
            <div id="header">
                <div class="logo"></div>
                <ul class="menuH">   
                     <a href="index.php">
                        <li id="<?php
                        if (strpos($page, 'index') !== false || strpos($page, 'gestion') !== false ||
                                strpos($page, 'formulaire') !== false || strpos($page, 'enregistrement_ok') !== false) {
                            echo 'current';
                        }
                        ?>">Accueil</li>
                    </a>
                    <a href="nageurs.php">
                        <li id="<?php
                        if (strpos($page, '/nageurs') !== false) {
                            echo 'current';
                        }
                        ?>">Nageurs</li>
                    </a>
                    <a href="competitions.php">
                        <li id="<?php
                        if (strpos($page, '/competitions') !== false) {
                            echo 'current';
                        }
                        ?>">Comp&eacute;titions</li>
                    </a>                   
                    <a href="deconnexion.php">
                        <li>D&eacute;connexion</li>
                    </a>                   
                </ul>
            </div>
            <div id="principal"> 
                <div class="menuV">
                    <div id="connexion">
                        <fieldset>
                            <legend>Connexion</legend>
                            <form method="post" action="">
                                <input type="text" name="login" size="10"/>
                                <input type="password" name="mot_de_passe" size="10"/>
                                <center>
                                    <input type="submit" value="Valider"/>
                                </center>
                            </form>
                        </fieldset>
                    </div>
                    <ul class="menu">
                        <li  id="<?php
                        if (strpos($page, 'gestion_nageurs') !== false || strpos($page, 'formulaire_nageur') !== false) {
                            echo 'current2';
                            }?>"><a href="gestion_nageurs.php">Gestion des nageurs</a></li>
                        <li id="<?php
                        if (strpos($page, 'gestion_types_nage') !== false) {
                            echo 'current2';
                            }?>"><a href="gestion_types_nage.php">Gestion des types de nage</a></li>
                        <li id="<?php
                        if (strpos($page, 'gestion_epreuves') !== false) {
                            echo 'current2';
                            }?>"><a href="gestion_epreuves.php">Gestion des &eacute;preuves</a></li>
                        <li id="<?php
                        if (strpos($page, 'gestion_categories_maitres') !== false) {
                            echo 'current2';
                            }?>"><a href="gestion_categories_maitres.php">Gestion des cat&eacute;gories ma&icirc;tres</a></li>
                        <li id="<?php
                        if (strpos($page, 'gestion_competitions') !== false) {
                            echo 'current2';
                            }?>"><a href="gestion_competitions.php">Gestion des comp&eacute;titions</a></li>
                        <li id="<?php
                        if (strpos($page, 'gestion_performances') !== false) {
                            echo 'current2';
                            }?>"><a href="gestion_performances.php">Gestion des performances</a></li>
                    </ul>
                </div>


