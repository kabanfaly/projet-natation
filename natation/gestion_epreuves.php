<?php
include './entete.php';
//desactivattion de la session permettant de retenir les informations saisies dans le formulaire
unset($_SESSION['contenu_epreuve']);
?>

<div class="contenu">
    <center><h2>Gestion des &eacute;preuve</h2></center>
    <span><a href="formulaire_epreuve.php?action=ajout"><button>Ajouter une nouvelle &eacute;preuve</button></a></span>
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
                    <th>Type de nage</th>               
                    <th>Distance</th>
                    <th>Op&eacute;rations</th>
                </tr>
                <?php
                //Inclusion de la classe epreuve
                include 'model/class.epreuve.php';

                //Recuperation de toutes les epreuves
                $epreuves = epreuve::rechercherTout();

                //si aucune epreuve n'existe
                if (!$epreuves) {
                    ?>

                    <tr><td align="center" colspan="5">Il n'existe aucune epreuve enregistr&eacute;e</td></tr>
                    <?php
                } else {//sinon afficher toutes les epreuves dans un tableau
                    //Inclusion de la classe type de nage pour la recuperation du nom des types de nage par id
                    include 'model/class.type_nage.php';

                    $style = "lignePaire";
                    foreach ($epreuves as $key => $epreuve) {
                        if ($key % 2 == 0) {
                            $style = "lignePaire";
                        } else {
                            $style = "ligneImpaire";
                        }
                        $type_nage = type_nage::rechercherParId($epreuve['idtype_de_nage']);
                        ?>
                        <tr id="<?= $style ?>">
                            <td align="center"><?= $type_nage['type'] ?> </td>
                            <td align="center"><?= $epreuve['distance'] ?> </td>
                            <td align="center">
                                <a href="controleur/controleur_epreuve.php?idmodif=<?= $epreuve['idepreuve'] ?>"><img src="images/edit.png"/></a>
                                <span onclick="if (confirm('Voulez vous supprimer cette epreuve')) {
                                            document.location.href = 'controleur/controleur_epreuve.php?idsuppression=<?= $epreuve['idepreuve'] ?>';
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
