<?php include './entete.php' ?>
<div class="contenu">
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'modif') {
            echo '<center><h2>Modifier la cat&eacute;gorie</h2></center>';
        } else {
            //supprimer l'id de la categorie enregistre eventuellement
            unset($_SESSION['idcategorie']);
            echo '<center><h2>Ajouter une cat&eacute;gorie</h2></center>';
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
                //si l'admin est connecte
                if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                    ?>
                </div>
                <div id="formulaire">        
                    <table>
                        <form method="post" action="controleur/controleur_categorie.php">            
                            <tr>
                                <td id="libelle">Cat&eacute;gorie:</td><td><input type="text" name="categorie" value="<?php
                                                                                  if (isset($_SESSION['contenu_categorie'])) {
                                                                                      echo html_entity_decode($_SESSION['contenu_categorie']['categorie']);
                                                                                  }
                                                                                  ?>" required="true"/></td>
                            </tr>                                  
                            <tr>
                                <td id="libelle">Description:</td><td><input type="text" name="description" value="<?php
                                                                                  if (isset($_SESSION['contenu_categorie'])) {
                                                                                      echo html_entity_decode($_SESSION['contenu_categorie']['description']);
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
                <?php
            }
            ?>
    </center>
</div>
<?php include './pied_de_page.php' ?>
