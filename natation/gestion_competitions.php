<?php
include './entete.php';
//desactivattion de la session permettant de retenir les informations saisies dans le formulaire
unset($_SESSION['contenu_competition']);
?>
<div class="contenu">
    <center><h2>Gestion des comp&eacute;titions</h2></center>
    <span><a href="formulaire_competition.php?action=ajout"><button>Ajouter une nouvelle comp&eacute;tition</button></a></span>
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
                    <th>Nageur</th>
                    <th>Epreuve</th>
                    <th>Cat&eacute;gorie ma&icirc;tre</th>
                    <th>ann&eacute;e</th>
                    <th>Op&eacute;rations</th>
                </tr>
                <?php
                //Inclusion de la classe competition
                include 'model/class.competition.php';

                //Recuperation de toutes les competitions
                $competitions = competition::rechercherTout();

                //si aucune competition n'existe
                if (!$competitions) {
                    ?>

                <tr><td align="center" colspan="5">Il n'existe aucune comp&eacute;tition enregistr&eacute;e</td></tr>
                    <?php
                } else {//sinon afficher toutes les competitions dans un tableau
                    //Inclusion des classes
                    include 'model/class.nageur.php';
                    include 'model/class.epreuve.php';
                    include 'model/class.type_nage.php';
                    include 'model/class.categorie_maitre.php';

                    $style = "lignePaire";
                    foreach ($competitions as $key => $competition) {
                        if ($key % 2 == 0) {
                            $style = "lignePaire";
                        } else {
                            $style = "ligneImpaire";
                        }
                        //recherche du nageur par son id pour pouvoir afficher son nom et prenom
                        $nageur = nageur::rechercherParId($competition['idnageur']);
                        //recherche de l'epreuve par son id
                        $epreuve = epreuve::rechercherParId($competition['idepreuve']);
                        //recherche du type de nage a partir de l'epreuve
                        $type_nage = type_nage::rechercherParId($epreuve['idtype_de_nage']);
                        //recherche de la categorie maitre par son id
                        $categorie_maitre = categorie_maitre::rechercherParId($competition['idcategorie_maitre']);
                        
                        ?>
                        <tr id="<?= $style ?>">
                            <td align="center"><?= $nageur['nom'].' '.$nageur['prenom'] ?> </td>
                            <td align="center"><?= $type_nage['type'].' ('. $epreuve['distance'] .')' ?> </td>
                            <td align="center"><?= $categorie_maitre['categorie'] ?> </td>
                            <td align="center"><?= $competition['annee'] ?> </td>
                            <td align="center">
                                <a href="controleur/controleur_competition.php?idmodif=<?= $competition['idcompetition'] ?>"><img src="images/edit.png"/></a>
                                <span onclick="if (confirm('Voulez vous supprimer cette competition?')) {
                                                    document.location.href = 'controleur/controleur_competition.php?idsuppression=<?= $competition['idcompetition'] ?>';
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
