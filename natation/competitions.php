<?php include './entete.php' ?>
<div class="contenu">
    <?php
    //rechercher le nageur par son id
    //performances du nageur
    include './model/class.nageur.php';
    include './model/class.performance.php';
    include 'model/class.epreuve.php';
    include 'model/class.type_nage.php';
    include 'model/class.competition.php';
    include 'model/class.categorie.php';
    ?>
    <center>
        <div id="afficheur">
            <?php
            //Rechercher toutes les competitions
            $competitions = competition::rechercherTout();
            ?>
            <br>
            <h4>Comp&eacute;titions</h4>
            <table>
                <tr>
                    <th>Nageur</th>
                    <th>Epreuve</th>
                    <th>Cat&eacute;gorie ma&icirc;tre</th>
                    <th>ann&eacute;e</th>
                </tr>
                <?php
                if ($competitions) {
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
                        $categorie = categorie::rechercherParId($competition['idcategorie']);
                        ?>
                        <tr id="<?= $style ?>">
                            <td align="center"><?= $nageur['nom'] . ' ' . $nageur['prenom'] ?> </td>
                            <td align="center"><?= $type_nage['type'] . ' (' . $epreuve['distance'] . ')' ?> </td>
                            <td align="center"><?= $categorie['categorie'] ?> </td>
                            <td align="center"><?= $competition['annee'] ?> </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>

        </div>
    </center>   
    <?php
    ?>
</div>
<?php include './pied_de_page.php' ?>
