<?php include './entete.php' ?>
<div class="contenu">
    <br>
    <center>
        <h2>Modification du login et du mot de passe de l'administrateur</h2>
        <br>

        <div id="formulaire">
            <div id="messageErreur">
                <?php
                if (isset($_GET['message'])) {
                    echo $_GET['message'];
                }
                ?>
            </div>
            <table>
                <form method="post" action="controleur/controleur_admin.php">            
                    <tr>
                        <td id="libelle">Login:</td><td><input type="text" name="login" value="<?php
                            if (isset($_SESSION['admin'])) {
                                echo $_SESSION['admin']['login'];
                            }
                            ?>" required="true"/></td>
                    </tr>                                  
                    <tr>
                        <td id="libelle">Mot de passe:</td><td><input type="password" name="mot_de_passe" value="<?php
                            if (isset($_SESSION['admin'])) {
                                echo $_SESSION['admin']['mot_de_passe'];
                            }
                            ?>" required="true"/></td>
                    </tr>                                  
                    <tr>
                        <td id="libelle">Re mot de passe:</td><td><input type="password" name="re_mot_de_passe" required="true"/></td>
                    </tr>                                  
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Valider"/>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </center>
</div>
<?php include './pied_de_page.php' ?>