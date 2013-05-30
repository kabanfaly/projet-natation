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
        $id_type_nage = '';
        $annee = '';
        if ($_POST) {
            //rechercher les performances du nageur par epreuve et par annee
            $id_type_nage = $_POST['idtype_de_nage'];
            $annee = $_POST['annee'];
            //rechercher toutes les performances
            if ($id_type_nage === '' && $annee === '') {
                $performances = performance::rechercherParNageur($id_nageur);
            } else
            //rechercher toutes les performances d'une annee
            if ($id_type_nage === '' && $annee !== '') {
                $performances = performance::rechercherParNageurAnnee($id_nageur, $annee);
            } else
            //rechercher toutes les performances par epreuve
            if ($id_type_nage !== '' && $annee === '') {
                //rechercher les types de nage
                $epreuves = epreuve::rechercherParType($id_type_nage);
                $performances = array();
                if ($epreuves) {
                    foreach ($epreuves as $key => $epreuve) {
                        //rechercher la performance pour l'epreuve
                        $performance = performance::rechercherParNageurEpreuve($id_nageur, $epreuve['idepreuve']);
                        if ($performance) {
                            $performances = array_merge($performances, $performance);
                        }
                    }
                }
            } else {//rechercher toutes performances sur une epreuve pour une annee donnee
                //rechercher les types de nage
                $epreuves = epreuve::rechercherParType($id_type_nage);
                $performances = array();
                if ($epreuves) {
                    foreach ($epreuves as $key => $epreuve) {
                        //rechercher la performance pour l'epreuve
                        $performance = performance::rechercherParNageurEpreveuveAnnee($id_nageur, $epreuve['idepreuve'], $annee);
                        if ($performance) {
                            $performances = array_merge($performances, $performance);
                        }
                    }
                }
            }
        } else {
            //Recherche toutes les performances du nageur
            $performances = performance::rechercherParNageur($id_nageur);
        }
        $type_nages = type_nage::rechercherTout();
        ?>
        <center>

            <div id="afficheur">
                <h4>Performances</h4>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" >
                    Epreuve: <select name="idtype_de_nage">                        
                        <option value="">Toutes les &eacute;preuves</option>
                        <?php
                        if ($type_nages) {
                            foreach ($type_nages as $key => $type) {
                                if ($type['idtype_de_nage'] == $type_nage) {
                                    echo '<option value="' . $type['idtype_de_nage'] . '" selected="true">' . $type['type'] . '</option>';
                                } else {
                                    echo '<option value="' . $type['idtype_de_nage'] . '">' . $type['type'] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                    &nbsp;&nbsp;
                    Ann&eacute;e: <select name="annee">
                        <option value="">Toutes les ann&eacute;es</option>
                        <?php
                        $date = intval(date('Y'));
                        for ($i = $date; $i >= $date - 10; $i--) {
                            if ($annee == $i) {
                                echo "<option value='$i' selected='true'>$i</option>";
                            } else {
                                echo "<option value='$i'>$i</option>";
                            }
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
                    $minute = $seconde = $centieme = $points = 0;
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
                                <td align="center"><?= html_entity_decode($type_nage['type']) . ' (' . $epreuve['distance'] . ' m)' ?> </td>
                                <td align="center"><?= $performance['temps'] ?> </td>
                                <td align="center"><?= $performance['annee'] ?> </td>
                                <td align="center"><?= $performance['points'] ?> </td>
                            </tr>
                            <?php
                            //calcul du score sur epreuve pour une annee
                            $points += intval($performance['points']);
                            $explode = explode(':', $performance['temps']);
                            //si la minute est definie (ex: 1:22.24)
                            if (count($explode) == 2) {
                                //calcul des minutes
                                $minute += intval($explode[0]);
                                //calcul des secondes
                                $explode2 = explode('.', $explode[1]);
                                $seconde += intval($explode2[0]);
                                if ($seconde >= 60) {
                                    $reste = $seconde - 60;
                                    $minute += 1;
                                    $seconde = $reste;
                                }
                                //calcul des centiemes de secondes
                                $centieme += intval($explode2[1]);
                                if ($centieme >= 100) {
                                    $reste = $centieme - 100;
                                    $seconde += 1;
                                    $centieme = $reste;
                                }
                            } else {//si la minute n'est pas definie (ex: 22.24)
                                $explode = explode('.', $performance['temps']);
                                //calcul des secondes
                                $seconde += intval($explode[0]);
                                if ($seconde >= 60) {
                                    $reste = $seconde - 60;
                                    $minute += 1;
                                    $seconde = $reste;
                                }
                                //calcul des centiemes de secondes
                                $centieme += intval($explode[1]);
                                if ($centieme >= 100) {
                                    $reste = $centieme - 100;
                                    $seconde += 1;
                                    $centieme = $reste;
                                }
                            }
                        }
                    }

                    //calcul du score sur une epreuve
                    ?>

                </table>
                <?php
                echo "<div>Score total:<b> $minute:$seconde.$centieme </b>$points pts</div>";
                ?>



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
