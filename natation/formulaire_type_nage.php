<?php include './entete.php' ?>
<div class="contenu">
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'modif') {
            echo '<center><h2>Modifier le type de nage</h2></center>';
        } else {
            //supprimer l'id du type de nage enregistre eventuellement
            unset($_SESSION['idtype_de_nage']);
            echo '<center><h2>Ajouter un nouveau type de nage</h2></center>';
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
                    <form method="post" action="controleur/controleur_type_nage.php">            
                        <tr>
                            <td id="libelle">Type:</td><td><input type="text" name="type" value="<?php
                                                                  if (isset($_SESSION['contenu_type_nage'])) {
                                                                      echo $_SESSION['contenu_type_nage']['type'];
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
