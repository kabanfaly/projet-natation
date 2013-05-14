<?php
include './entete.php';
//desactivattion de la session permettant de retenir les informations saisies dans le formulaire
unset($_SESSION['contenu_categorie_maitre']);
?>
<div class="contenu">
    <center><h2>Gestion des cat&eacute;gories ma&icirc;tres</h2></center>

    <span><a href="formulaire_categorie_maitre.php?action=ajout"><button>Ajouter une cat&eacute;gorie ma&icirc;tre</button></a></span>
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
                    <th>Cat&eacute;gorie</th>               
                    <th>Op&eacute;rations</th>               
                </tr>
                <?php
                //Inclusion de la classe categorie maitre
                include 'model/class.categorie_maitre.php';

                //Recuperation de toutes les categorie
                $categorie_maitres = categorie_maitre::rechercherTout();

                //si aucun type de nage n'existe
                if (!$categorie_maitres) {
                    ?>

                    <tr><td align="center" colspan="5">Il n'existe aucune cat&eacute;gorie ma&icirc;tres enregistr&eacute;e</td></tr>
                    <?php
                } else {//sinon afficher toutes les categories dans un tableau
                    $style = "lignePaire";
                    foreach ($categorie_maitres as $key => $categorie_maitre) {
                        if ($key % 2 == 0) {
                            $style = "lignePaire";
                        } else {
                            $style = "ligneImpaire";
                        }
                        ?>
                        <tr id="<?= $style ?>">
                            <td align="center"><?= $categorie_maitre['categorie'] ?> </td>
                            <td align="center">
                                <a href="controleur/controleur_categorie_maitre.php?idmodif=<?= $categorie_maitre['idcategorie_maitre'] ?>"><img src="images/edit.png"/></a>
                                <span onclick="if (confirm('Voulez vous supprimer cette catégorie maitre?')) {
                                            document.location.href = 'controleur/controleur_categorie_maitre.php?idsuppression=<?= $categorie_maitre['idcategorie_maitre'] ?>';
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
