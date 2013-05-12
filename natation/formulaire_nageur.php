<?php include './entete.php' ?>
<div class="contenu">
    <center><h2>Ajouter un nouveau nageur</h2></center>
    <center>

        <div id="formulaire">  
            <div id="messageErreur">
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                ?>
            </div>
            <table>
                <form method="post" action="controleur/controleur_nageur.php">            
                    <tr>
                        <td id="libelle">Nom:</td><td><input type="text" name="nom" value="<?php
                            if (isset($_SESSION['contenu_nageur'])) {
                                echo $_SESSION['contenu_nageur']['nom'];
                            }
                            ?>" required="true"/></td>
                    </tr>
                    <tr>
                        <td id="libelle">Pr&eacute;nom:</td><td><input type="text" name="prenom" value="<?php
                            if (isset($_SESSION['contenu_nageur'])) {
                                echo $_SESSION['contenu_nageur']['prenom'];
                            }
                            ?>" required="true"/></td>
                    </tr>
                    <tr>
                        <td id="libelle">Date de naissance:</td><td><input type="text" name="date_de_naissance" value="<?php
                            if (isset($_SESSION['contenu_nageur'])) {
                                echo $_SESSION['contenu_nageur']['date_de_naissance'];
                            }
                            ?>" required="true"/>&nbsp;JJ/MM/AAAA</td>
                    </tr>
                    <tr>
                        <td id="libelle">Sexe:</td>
                        <td>
                            <select name="sexe">
                                <option value="M" <?php
                                if (isset($_SESSION['contenu_nageur']) && $_SESSION['contenu_nageur']['sexe'] === 'M') {
                                    echo 'selected';
                                }
                                ?> >M&acirc;le</option>
                                <option value="F" <?php
                                if (isset($_SESSION['contenu_nageur']) && $_SESSION['contenu_nageur']['sexe'] === 'F') {
                                    echo 'selected';
                                }
                                ?>>Femelle</option>
                            </select>
                        </td>
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
