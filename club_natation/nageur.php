<?php
include './header.php';
include_once("code_connexion_pdo.php");
?>
<div id="contenu">
    <?php
    //si l'on doit afficher les informations du nageur
    if ($_GET) {
        //trouver le nageur correspondant
        $id_nageur = $_GET['id'];
        $res = mysql_query("SELECT * FROM `nageur` WHERE `id_nageur` =  " . $_GET['id']) or die(mysql_error());
        $nageur = mysql_fetch_array($res);
        echo '<center><h3>' . $nageur['nom_nageur'] . ' ' . $nageur['prenom_nageur'] . '</h3></center>';

        $performances = array();
        $result_performance = mysql_query("SELECT * FROM `performance` WHERE `id_nageur` = $id_nageur") or die(mysql_error());
        if (mysql_num_rows($result_performance) != 0) {
            while ($line = mysql_fetch_array($result_performance)) {
                $performances[] = $line;
            }
        }
        //on affiche les performances du nageur

        $type_epreuve = '';
        $saison = '';
        if ($_POST) {
            $performances = array();
            //retrouver les performances du nageur par epreuve et par annee
            $type_epreuve = $_POST['type_epreuve'];
            $saison = $_POST['saison'];
            //rechercher toutes les performances
            if ($type_epreuve === '' && $saison === '') {
                $result_performance = mysql_query("SELECT * FROM `performance` WHERE `id_nageur` = $id_nageur") or die(mysql_error());
                if (mysql_num_rows($result_performance) != 0) {
                    while ($line = mysql_fetch_array($result_performance)) {
                        $performances[] = $line;
                    }
                }
            } else
            //retrouver toutes les performances d'une annee
            if ($type_epreuve === '' && $saison !== '') {
                $result_performance = mysql_query("SELECT * FROM `performance` WHERE `id_nageur` = $id_nageur AND `saison` = $saison") or die(mysql_error());
                if (mysql_num_rows($result_performance) != 0) {
                    while ($line = mysql_fetch_array($result_performance)) {
                        $performances[] = $line;
                    }
                }
            } else
            //retrouver toutes les performances par epreuve
            if ($type_epreuve !== '' && $saison === '') {
                //retrouver les types de nage
                $result = mysql_query("SELECT * FROM `epreuve` WHERE `type_epreuve` = '$type_epreuve'") or die(mysql_error());
                if (mysql_num_rows($result) != 0) {
                    while ($epreuve = mysql_fetch_array($result)) {
                        //retrouver les performances correspondante
                        $res_perf = mysql_query("SELECT * FROM `performance` WHERE `id_epreuve` = '" . $epreuve['id_epreuve'] . "' AND `id_nageur` = $id_nageur") or die(mysql_error());
                        while ($line = mysql_fetch_array($res_perf)) {
                            $performances[] = $line;
                        }
                    }
                }
            }
        }
        $epreuves = mysql_query("SELECT * FROM `epreuve`") or die(mysql_error());
        ?>
        <center>
            <div id="afficheur">
                <h4>Performances</h4>
                <form method="post">
                    Epreuve: <select name="type_epreuve">                        
                        <option value="">Toutes les &eacute;preuves</option>
                        <?php
                        if (mysql_num_rows($epreuves) != 0) {
                            while ($line = mysql_fetch_array($epreuves)) {
                                if ($line['type_epreuve'] == $type_epreuve) {
                                    echo '<option value="' . $line['type_epreuve'] . '" selected="true">' . $line['type_epreuve'] . ' (' . $line['distance_epreuve'] . ' m)</option>';
                                } else {
                                    echo '<option value="' . $line['type_epreuve'] . '">' . $line['type_epreuve'] . ' (' . $line['distance_epreuve'] . ' m)</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                    &nbsp;&nbsp;
                    Ann&eacute;e: <select name="saison">
                        <option value="">Toutes les ann&eacute;es</option>
                        <?php
                        //Retrouver toutes les saisons 
                        $result_saison = mysql_query("SELECT `saison` FROM `performance` ORDER BY `saison` ASC") or die(mysql_error());
                        if (mysql_num_rows($res) != 0) {
                            while ($line = mysql_fetch_array($result_saison)) {
                                if ($line['saison'] == $saison) {
                                    echo "<option value='" . $line['saison'] . "' selected='true'>" . $line['saison'] . "</option>";
                                } else {
                                    echo "<option value='" . $line['saison'] . "' >" . $line['saison'] . "</option>";
                                }
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
                        <th>Saison</th>
                        <th>Temps total</th>
                        <th>Date</th>
                        <th>Points</th>
                    </tr>
                    <?php
                    //Retrouver toutes les performances du nageur                   
                    $minute = $seconde = $centieme = $points = 0;
                    if ($performances) {
                        foreach ($performances as $key => $performance) {
                            //recherche de l'epreuve par son id
                            $res_epreuve = mysql_query("SELECT * FROM `epreuve` WHERE `id_epreuve` = " . $performance['id_epreuve']) or die(mysql_error());
                            $epreuve = mysql_fetch_array($res_epreuve);
                            ?>
                            <tr>
                                <td align="center"><?= $epreuve['type_epreuve'] . ' (' . $epreuve['distance_epreuve'] . ' m)' ?> </td>
                                <td align="center"><?= $performance['saison'] ?> </td>
                                <td align="center"><?= $performance['temps_total'] ?> </td>
                                <?php
                                $date = explode("-", $performance["date_perf"]);
                                $date_perf = $date[2] . '/' . $date[1] . '/' . $date[0];
                                ?>
                                <td align="center"><?= $date_perf ?> </td>
                                <td align="center"><?= $performance['points'] ?> </td>
                            </tr>
                            <?php
                            //calcul du score sur epreuve pour une annee
                            $points += intval($performance['points']);
                            $explode = explode(':', $performance['temps_total']);
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
                                $explode = explode('.', $performance['temps_total']);
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

            </div>
        </center>   
        <?php
    }
    ?>
</div>
<?php include './footer.php' ?>