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
        include 'model/class.categorie.php';
        //Recherche des performances du nageur
        $performances = performance::rechercherParNageur($id_nageur);
        $type_nages = type_nage::rechercherTout();
        ?>
        <center>

            <div id="afficheur">
                <h4>Performances</h4>
                <form action="GET">
                    Epreuve: <select name="idtype_de_nage">
                         <option value="">Choisissez</option>
                        <?php
                        if ($type_nages) {
                            foreach ($type_nages as $key => $type) {
                                 echo '<option value="' . $type['idtype_de_nage'] . '">' . $type['type'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    &nbsp;&nbsp;
                    Ann&eacute;e: <select name="annee">
                        <option value="">Choisissez</option>
                        <?php
                        $date = intval(date('Y'));
                        for ($i = $date; $i >= $date - 10; $i--) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                    &nbsp;&nbsp;
                    <input type="submit" value="Rechercher">
                </form>
                <table>
                    <tr>
                        <th>Epreuve</th>
                        <th>Temps</th>
                        <th>Ann&eacute;e</th>
                        <th>Points</th>
                    </tr>
                    <?php
                    if ($performances) {
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
                                <td align="center"><?= html_entity_decode($type_nage['type']) . ' (' . $epreuve['distance'] . ')' ?> </td>
                                <td align="center"><?= $performance['temps'] ?> </td>
                                <td align="center"><?= $performance['annee'] ?> </td>
                                <td align="center"><?= $performance['points'] ?> </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>

                <?php
                //Competiton auquelles a participite le nageur
                $competitions = competition::rechercherParNageur($id_nageur);
                ?>
                <br>
                <h4>Comp&eacute;titions</h4>
                <table>
                    <tr>
                        <th>Epreuve</th>
                        <th>ann&eacute;e</th>
                    </tr>
                    <?php
                    if ($competitions) {
                        foreach ($competitions as $key => $competition) {
                            if ($key % 2 == 0) {
                                $style = "lignePaire";
                            } else {
                                $style = "ligneImpaire";
                            }
                            //recherche de l'epreuve par son id
                            $epreuve = epreuve::rechercherParId($competition['idepreuve']);
                            //recherche du type de nage a partir de l'epreuve
                            $type_nage = type_nage::rechercherParId($epreuve['idtype_de_nage']);
                            ?>
                            <tr id="<?= $style ?>">
                                <td align="center"><?= html_entity_decode($type_nage['type']) . ' (' . $epreuve['distance'] . ')' ?> </td>
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
    } else {
        ?>
        <center><h3>Liste des nageurs</h3></center>
        <?php
        //recuperation de tous les nageurs
        $nageurs = nageur::rechercherTout();
        if ($nageurs) {
            foreach ($nageurs as $key => $nageur) {
                echo '<div id="nageur"><a href="?id=' . $nageur['idnageur'] . '">' . html_entity_decode($nageur['nom']) . ' ' . html_entity_decode($nageur['prenom']) . '</a></div>';
            }
        } else {
            echo "Il n'existe aucun nageur";
        }
    }
    ?>
</div>
<?php include './pied_de_page.php' ?>
