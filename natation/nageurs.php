<?php include './entete.php' ?>
<div class="contenu">
    <?php
    include './model/class.nageur.php';
    //si l'on doit afficher les informations du nageur
    if ($_GET) {
        //rechercher le nageur par son id
        $id_nageur = $_GET['id'];
        $nageur = nageur::rechercherParId($id_nageur);
        echo '<center><h3>' . $nageur['nom'] . ' ' . $nageur['prenom'] . '</h3></center>';

        //performances du nageur
        include './model/class.performance.php';
        include 'model/class.epreuve.php';
        include 'model/class.type_nage.php';
        include 'model/class.competition.php';
        //Recherche des performances du nageur
        $performances = performance::rechercherParNageur($id_nageur);
        ?>
        <center>
            <div id="afficheur">
                <h4>Performances</h4>
                <table>
                    <tr>
                        <th>Epreuve</th>
                        <th>Temps</th>
                        <th>Points</th>
                    </tr>
                    <?php
                    $style = "lignePaire";
                    foreach ($performances as $key => $performance) {
                        if ($key % 2 == 0) {
                            $style = "lignePaire";
                        } else {
                            $style = "ligneImpaire";
                        }
                        //recherche de l'epreuve par son id
                        $epreuve = epreuve::rechercherParId($performance['idepreuve']);
                        //recherche du type de nage a partir de l'epreuve
                        $type_nage = type_nage::rechercherParId($epreuve['idtype_de_nage']);
                        ?>
                        <tr id="<?= $style ?>">
                            <td align="center"><?= $type_nage['type'] . ' (' . $epreuve['distance'] . ')' ?> </td>
                            <td align="center"><?= $performance['temps'] ?> </td>
                            <td align="center"><?= $performance['points'] ?> </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>

                <?php
                //Competiton auquelles a participite le nageur
                $competitions = competition::rechercherParNageur($id_nageur);
                ?>
            </div>
        </center>   
        <?php
    } else {
        ?>
        <center><h3>Liste des nageurs</h3></center>
        <?php
        //recuperation de tous les nageurs
        $nageurs = nageur::rechercherTout();
        foreach ($nageurs as $key => $nageur) {
            echo '<div id="nageur"><a href="?id=' . $nageur['idnageur'] . '">' . $nageur['nom'] . ' ' . $nageur['prenom'] . '</a></div>';
        }
    }
    ?>
</div>
<?php include './pied_de_page.php' ?>
