<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="style.css" rel="stylesheet" />
        <title>connexion</title>
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
                </div>
                <div id="contenu">
                    <center>
                        <?php
                        include './identifiantAdmin.php';
                        if ($_POST) {
                            if ($_POST['login'] != LOGIN) {
                                echo '<div>Login incorrect</div>';
                            } else
                            if ($_POST['mot_de_passe'] != MOT_DE_PASSE) {
                                echo '<div>Mot de passe incorrect</div>';
                            } else {
                                session_register('connexionOK');
                                $_SESSION['connexionOK'] = true;
                                header('Location: index.php');
                            }
                        }
                        ?>

                        <form method="POST">
                            <table>
                                <tr>
                                    <td>Login:</td>
                                    <td><input type="text" name="login" required="true"></td>
                                </tr>
                                <tr>
                                    <td>Mot de passe:</td>
                                    <td><input type="password" name="mot_de_passe" required="true"></td>
                                </tr>
                                <tr><td colspan="2"><input type="submit" value="Connexion"></td></tr>
                            </table>
                        </form>

                    </center>
                </div>
            </div>
        </div>
    </body>
</html>
