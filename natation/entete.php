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
                    <?php
                    if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                        ?>
                        <a href="admin.php">
                            <li id="<?php
                            if (strpos($page, '/admin') !== false) {
                                echo 'current';
                            }
                            ?>">Mon compte</li>
                        </a>
                        <a href="aide.php">
                            <li id="<?php
                            if (strpos($page, '/aide') !== false) {
                                echo 'current';
                            }
                            ?>">Aide</li>
                        </a>
                        <a href="controleur/deconnexion.php">
                            <li>D&eacute;connexion</li>
                        </a>     
                    <?php } ?>
                </ul>
            </div>
            <div id="principal"> 
                <div class="menuV">
                    <?php
                    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
                        ?>
                        <div id="connexion">
                            <div id="messageErreur">
                                <?php
                                if (isset($_GET['message'])) {
                                    echo $_GET['message'];
                                }
                                ?>
                            </div>
                            <fieldset>
                                <legend>Connexion</legend>
                                <form method="post" action="controleur/controleur_connexion.php">
                                    <input type="text" name="login" required="true" size="10"/>
                                    <input type="password" name="mot_de_passe" required="true" size="10"/>
                                    <center>
                                        <input type="submit" value="Valider"/>
                                    </center>
                                </form>
                            </fieldset>
                        </div>
                        <?php
                    }
                    if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                        ?>
                        <ul class="menu">
                            <li id="<?php
                            if (strpos($page, 'gestion_categories') !== false || strpos($page, 'formulaire_categorie') !== false) {
                                echo 'current2';
                            }
                            ?>"><a href="gestion_categories.php">Gestion des cat&eacute;gories</a></li>
                            <li  id="<?php
                            if (strpos($page, 'gestion_nageurs') !== false || strpos($page, 'formulaire_nageur') !== false) {
                                echo 'current2';
                            }
                            ?>"><a href="gestion_nageurs.php">Gestion des nageurs</a></li>
                            <li id="<?php
                            if (strpos($page, 'gestion_types_nage') !== false || strpos($page, 'formulaire_type_nage') !== false) {
                                echo 'current2';
                            }
                            ?>"><a href="gestion_types_nage.php">Gestion des types de nage</a></li>
                            <li id="<?php
                            if (strpos($page, 'gestion_epreuves') !== false || strpos($page, 'formulaire_epreuve') !== false) {
                                echo 'current2';
                            }
                            ?>"><a href="gestion_epreuves.php">Gestion des &eacute;preuves</a></li>

                            <li id="<?php
                            if (strpos($page, 'gestion_competitions') !== false || strpos($page, 'formulaire_competition') !== false) {
                                echo 'current2';
                            }
                            ?>"><a href="gestion_competitions.php">Gestion des comp&eacute;titions</a></li>
                            <li id="<?php
                            if (strpos($page, 'gestion_performances') !== false || strpos($page, 'formulaire_performance') !== false) {
                                echo 'current2';
                            }
                            ?>"><a href="gestion_performances.php">Gestion des performances</a></li>
                        </ul>
                    <?php } ?>
                </div>


