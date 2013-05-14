<?php
include './entete.php';
//desactivattion de la session permettant de retenir les informations saisies dans le formulaire
unset($_SESSION['contenu_type_nage']);
?>
<div class="contenu">
    <center><h2>Gestion des types de nage</h2></center>

    <span><a href="formulaire_type_nage.php?action=ajout"><button>Ajouter un nouveau type de nage</button></a></span>
    <center>
        <div id="success">
            <?php
            if (isset($_GET['message'])) {
                echo $_GET['message'];
            }
            ?>
        </div>
        <br>
        <div id="afficheur">
            <table>
                <tr>
                    <th>Type</th>               
                    <th>Op&eacute;rations</th>               
                </tr>
                <?php
                //Inclusion de la classe type de nage
                include 'model/class.type_nage.php';

                //Recuperation de tous les types de nage
                $type_nages = type_nage::rechercherTout();

                //si aucun type de nage n'existe
                if (!$type_nages) {
                    ?>

                    <tr><td align="center" colspan="5">Il n'existe aucun type de nage enregistr&eacute;</td></tr>
                    <?php
                } else {//sinon afficher tous les types de nage dans un tableau
                    $style = "lignePaire";
                    foreach ($type_nages as $key => $type_nage) {
                        if ($key % 2 == 0) {
                            $style = "lignePaire";
                        } else {
                            $style = "ligneImpaire";
                        }
                        ?>
                        <tr id="<?= $style ?>">
                            <td align="center"><?= $type_nage['type'] ?> </td>
                            <td align="center">
                                <a href="controleur/controleur_type_nage.php?idmodif=<?= $type_nage['idtype_de_nage'] ?>"><img src="images/edit.png"/></a>
                                <span onclick="if (confirm('Voulez vous supprimer ce type de nage?')) {
                                            document.location.href = 'controleur/controleur_type_nage.php?idsuppression=<?= $type_nage['idtype_de_nage'] ?>';
                                        }"><img src="images/delete.png"/></span>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </center>
</div>
<?php include './pied_de_page.php' ?>
