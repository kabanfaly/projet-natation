<?php include './entete.php' ?>
<div class="contenu">
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'modif') {
            echo '<center><h2>Modifier la cat&eacute;gorie ma&icirc;tre</h2></center>';
        } else {
            //supprimer l'id de la categorie maitre enregistre eventuellement
            unset($_SESSION['idcategorie_maitre']);
            echo '<center><h2>Ajouter une cat&eacute;gorie ma&icirc;tre</h2></center>';
        }
    }
    ?>

    <center>
        <div id="formulaire">  
            <div id="messageErreur">
                <?php
                if (isset($_GET['message'])) {
                    echo $_GET['message'];
                }
                ?>
            </div>
            <div id="formulaire">        
                <table>
                    <form method="post" action="controleur/controleur_categorie_maitre.php">            
                        <tr>
                            <td id="libelle">Cat&eacute;gorie:</td><td><input type="text" name="categorie" value="<?php
                                                                  if (isset($_SESSION['contenu_categorie_maitre'])) {
                                                                      echo $_SESSION['contenu_categorie_maitre']['categorie'];
                                                                  }
                                                                  ?>" required="true"/></td>
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
