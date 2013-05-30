<?php
include './entete.php';
//desactivattion de la session permettant de retenir les informations saisies dans le formulaire
unset($_SESSION['contenu_performance']);
?>
<div class="contenu">
    <center><h2>Gestion des performances</h2></center>
    <span><a href="formulaire_performance.php?action=ajout"><button>Ajouter une nouvelle performance</button></a></span>
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
                        <th>Nageur</th>
                        <th>Epreuve</th>
                        <th>Temps</th>
                        <th>Ann&eacute;e</th>
                        <th>Points</th>
                        <th>Op&eacute;rations</th>
                    </tr>
                    <?php
                    //Inclusion de la classe performance
                    include 'model/class.performance.php';

                    //Recuperation de toutes les performances
                    $performances = performance::rechercherTout();

                    //si aucune performance n'existe
                    if (!$performances) {
                        ?>

                        <tr><td align="center" colspan="5">Il n'existe aucune performance enregistr&eacute;e</td></tr>
                        <?php
                    } else {//sinon afficher toutes les performances dans un tableau
                        //Inclusion des classes
                        include 'model/class.nageur.php';
                        include 'model/class.epreuve.php';
                        include 'model/class.type_nage.php';

                        $style = "lignePaire";
                        foreach ($performances as $key => $performance) {
                            if ($key % 2 == 0) {
                                $style = "lignePaire";
                            } else {
                                $style = "ligneImpaire";
                            }
                            //recherche du nageur par son id pour pouvoir afficher son nom et prenom
                            $nageur = nageur::rechercherParId($performance['idnageur']);
                            //recherche de l'epreuve par son id
                            $epreuve = epreuve::rechercherParId($performance['idepreuve']);
                            //recherche du type de nage a partir de l'epreuve
                            $type_nage = type_nage::rechercherParId($epreuve['idtype_de_nage']);
                            ?>
                            <tr id="<?= $style ?>">
                                <td align="center"><?= $nageur['nom'] . ' ' . $nageur['prenom'] ?> </td>
                                <td align="center"><?= $type_nage['type'] . ' (' . $epreuve['distance'] . ')' ?> </td>
                                <td align="center"><?= $performance['temps'] ?> </td>
                                <td align="center"><?= $performance['annee'] ?> </td>
                                <td align="center"><?= $performance['points'] ?> </td>
                                <td align="center">
                                    <a href="controleur/controleur_performance.php?idmodif=<?= $performance['idperformance'] ?>"><img src="images/edit.png"/></a>
                                    <span onclick="if (confirm('Voulez vous supprimer cette competition?')) {
                                                        document.location.href = 'controleur/controleur_performance.php?idsuppression=<?= $performance['idperformance'] ?>';
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
