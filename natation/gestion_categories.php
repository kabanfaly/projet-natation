<?php
include './entete.php';
//desactivattion de la session permettant de retenir les informations saisies dans le formulaire
unset($_SESSION['contenu_categorie']);
?>
<div class="contenu">
    <center><h2>Gestion des cat&eacute;goriess</h2></center>

    <span><a href="formulaire_categorie.php?action=ajout"><button>Ajouter une cat&eacute;gorie</button></a></span>
    <center>
        <div id="success">
            <?php
            if (isset($_GET['message'])) {
                echo $_GET['message'];
            }
            //si l'admin est connecte
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                ?>
            </div>
            <br>
            <div id="afficheur">
                <table>
                    <tr>
                        <th>Cat&eacute;gorie</th>               
                        <th>Description</th>               
                        <th>Op&eacute;rations</th>               
                    </tr>
                    <?php
                    //Inclusion de la classe categorie
                    include 'model/class.categorie.php';

                    //Recuperation de toutes les categorie
                    $categories = categorie::rechercherTout();

                    //si aucune categorie n'existe
                    if (!$categories) {
                        ?>

                        <tr><td align="center" colspan="5">Il n'existe aucune cat&eacute;gorie enregistr&eacute;e</td></tr>
                        <?php
                    } else {//sinon afficher toutes les categories dans un tableau
                        $style = "lignePaire";
                        foreach ($categories as $key => $categorie) {
                            if ($key % 2 == 0) {
                                $style = "lignePaire";
                            } else {
                                $style = "ligneImpaire";
                            }
                            ?>
                            <tr id="<?= $style ?>">
                                <td align="center"><?= $categorie['categorie'] ?> </td>
                                <td align="center"><?= $categorie['description'] ?> </td>
                                <td align="center">
                                    <a href="controleur/controleur_categorie.php?idmodif=<?= $categorie['idcategorie'] ?>"><img src="images/edit.png"/></a>
                                    <span onclick="if (confirm('Voulez vous supprimer cette catégorie?')) {
                                                        document.location.href = 'controleur/controleur_categorie.php?idsuppression=<?= $categorie['idcategorie'] ?>';
                                                    }"><img src="images/delete.png"/></span>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <?php
        }
        ?>
    </center>
</div>
<?php include './pied_de_page.php' ?>
