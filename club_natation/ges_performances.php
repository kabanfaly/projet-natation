<?php
include 'header.php';
include_once("code_connexion_pdo.php");
?>
<div id="contenu">
    <h2>Gestion des performances</h2>
    <a href="formulaire_ajout_nouvelle_performance.php">Ajouter une performance</a><br>
    <?php
    if ($_GET) {
        echo '<br>' . $_GET['message'] . '<br>';
    }
    ?>    
    <table>
        <tr>
            <th>Nageur</th>
            <th>Epreuve</th>
            <th>Saison</th>
            <th>Date</th>
            <th>Temps total</th>
            <th>Points</th>
            <th>Edition</th>
            <th>Suppression</th>
        </tr>
        <?php
        //recuperation de toutes les performances
        $res = mysql_query("SELECT * FROM `performance`") or die(mysql_error());
        if (mysql_numrows($res) == 0) {// aucun element trouve
            echo '<tr><td colspan="8" align="center">Contenu vide</td></tr>';
        } else {
            while ($line = mysql_fetch_array($res)) {
                //rechercher le nom du nageur correspondant à id_nageur
                $res_nag = mysql_query("SELECT * FROM `nageur` WHERE `id_nageur` = " . $line['id_nageur']);
                $nageur = mysql_fetch_array($res_nag);
                
                //rechercher l'epreuve correspondant à id_epreuve
                $res_epr = mysql_query("SELECT * FROM `epreuve` WHERE `id_epreuve` = " . $line['id_epreuve']);
                $epreuve = mysql_fetch_array($res_epr);
                //formatage pour afficher la date
                $date = explode("-", $line["date_perf"]);
                ?>
                <tr>
                    <td><?= $nageur['nom_nageur'] . ' ' . $nageur['prenom_nageur'] ?></td>
                    <td align="center"><?= $epreuve['type_epreuve']. '('.$epreuve['distance_epreuve'].' m)' ?></td>
                    <td align="center"><?= $line['saison'] ?></td>
                    <td align="center"><?= $date[2].'/'.$date[1].'/'.$date[0] ?></td>
                    <td align="center"><?= $line['temps_total'] ?></td>
                    <td align="center"><?= $line['points'] ?></td>
                    <td align="center"><a href="formulaire_modifier_performance.php?id=<?= $line['id_performance'] ?>">Modifier</a></td>
                    <td align="center"><a href="supprimer_performance.php?id=<?= $line['id_performance'] ?>" onclick="return confirm('Voulez vous supprimer cette performance?')">Supprimer</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
</div>
<?php include 'footer.php'; ?>