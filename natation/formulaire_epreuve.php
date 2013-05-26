<?php include './entete.php' ?>
<div class="contenu">
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'modif') {
            echo '<center><h2>Modifier le nageur</h2></center>';
        } else {
            //supprimer l'id de l'epreuve enregistre eventuellement
            unset($_SESSION['idepreuve']);
            echo '<center><h2>Ajouter un nouveau nageur</h2></center>';
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
                <table>
                    <form method="post" action="controleur/controleur_epreuve.php">  

                        <tr>
                            <td id="libelle">Type de nage:</td>
                            <td>
                                <?php
                                include 'model/class.type_nage.php';
                                $types = type_nage::rechercherTout();
                                ?>

                                <select name="idtype_de_nage">
                                    <option value="">Choisissez</option>
                                    <?php
                                    if ($types) {
                                        foreach ($types as $key => $type) {
                                            if (isset($_SESSION['contenu_epreuve']) && $_SESSION['contenu_epreuve']['idtype_de_nage'] === $type['idtype_de_nage']) {
                                                echo '<option value="' . $type['idtype_de_nage'] . '" selected="true">' . $type['type'] . '</option>';
                                            } else {
                                                echo '<option value="' . $type['idtype_de_nage'] . '">' . $type['type'] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Distance:</td>
                            <td><input type="text" name="distance" size="5" value="<?php
                                if (isset($_SESSION['contenu_epreuve'])) {
                                    echo $_SESSION['contenu_epreuve']['distance'];
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
                <?php
            }
            ?>
        </div>
    </center>
</div>
<?php include './pied_de_page.php' ?>
