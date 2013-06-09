<?php
include 'header.php';
include_once("code_connexion_pdo.php");

$message = "";
$id_ngeur = "";
$id_epreuve = "";
$saison = "";
$temps_total = "";
$date_perf = "";
$points = "";
if ($_POST) {
    //recuperation de la valeur des champs    
    $id_nageur = $_POST['id_nageur'];
    $id_epreuve = $_POST['id_epreuve'];
    $saison = $_POST['saison'];
    $temps_total = $_POST['temps_total'];
    $date_perf = $_POST['date_perf'];
    $points = $_POST['points'];

    if ($id_nageur == '') {
        $message = "<p class='erreur'>Veuillez choisir un nageur</p>";
    } elseif ($id_epreuve == '') {
        $message = "<p class='erreur'>Veuillez choirsir une épreuve</p>";
    }
    //on crée un tableau en utilisant la fonction explode qui transforme les données en tableau
    $date = explode("/", $date_perf);
    //verification de la date
    if (!(checkdate($date[1], $date[0], $date[2]))) {
        $message = "<p class='erreur'>la date de performance est invalide</p>";
    }
    if ($message == "") {
        $date_perf = $date[2] . "-" . $date[1] . "-" . $date[0];
        $requete = "INSERT INTO `performance` (`id_nageur`,`id_epreuve`,`saison`,`date_perf`,`temps_total`,`points`) "
                . "VALUES('" . $id_nageur . "','"
                . $id_epreuve . "','" . $saison . "','"
                . $date_perf . "', '" . $temps_total . "' ,'"
                . $points . "')";        
        mysql_query($requete) or die(mysql_error());
        header('Location: ges_performances.php?message=Enregistrement OK');
    }
}
?>
<div id="contenu">
    <h2>Ajouter une performance</h2>
    <div><?= $message ?></div>
    <form method="post">
        <table>
            <tr>
                <td>Nageur: </td>
                <td><select name="id_nageur">
                        <option value="">choisissez</option>
                        <?php
                        //rechercher tous les nageurs
                        $res = mysql_query("SELECT * FROM `nageur`") or die(mysql_error());
                        if (mysql_num_rows($res) != 0) {
                            while ($line = mysql_fetch_array($res)) {
                                //rechercher la categorie correspondant à id_categorie courant
                                $res_cat = mysql_query("SELECT * FROM `categorie` WHERE `id_categorie` = " . $line['id_categorie']) or die(mysql_error());
                                $categorie = mysql_fetch_array($res_cat);
                                if ($id_nageur == $line['id_nageur']) { //pour selectionner l'id courant
                                    echo '<option value="' . $line['id_nageur'] . '" selected="true">' . $line['nom_nageur'] . ' ' . $line['prenom_nageur'] . ' (' . $categorie['nom_categorie'] . ')</option>';
                                } else {
                                    echo '<option value="' . $line['id_nageur'] . '">' . $line['nom_nageur'] . ' ' . $line['prenom_nageur'] . ' (' . $categorie['nom_categorie'] . ')</option>';
                                }
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>Epreuve: </td>
                <td><select name="id_epreuve">
                        <option value="">choisissez</option>
                        <?php
                        //rechercher toutes les epreuves
                        $res = mysql_query("SELECT * FROM `epreuve`") or die(mysql_error());
                        if (mysql_num_rows($res) != 0) {
                            while ($line = mysql_fetch_array($res)) {
                                if ($id_epreuve == $line['id_epreuve']) { //pour selectionner l'id courant
                                    echo '<option value="' . $line['id_epreuve'] . '" selected="true">' . $line['type_epreuve'] . ' (' . $line['distance_epreuve'] . ' m)</option>';
                                } else {
                                    echo '<option value="' . $line['id_epreuve'] . '">' . $line['type_epreuve'] . ' (' . $line['distance_epreuve'] . ' m)</option>';
                                }
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>Saison: </td>
                <td><input type="text" name="saison"  required="true" value="<?= $saison ?>"> (ex: 2010)</td>
            </tr>
            <tr>
                <td>Date (au format JJ/MM/AAAA):</td>
                <td><input type="text" name="date_perf" required="true" value="<?= $date_perf ?>"></td>
            </tr>
            <tr>
                <td>Temps (au format ss.cs ou mm:ss.cs):</td>
                <td><input type="text" name="temps_total" required="true" value="<?= $temps_total ?>"></td>
            </tr>
            <tr>
                <td>Points: </td>
                <td><input type="text" name="points"  required="true" value="<?= $points ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Ajouter"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>

