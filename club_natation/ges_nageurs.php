<?php
include 'header.php';
include_once("code_connexion_pdo.php");
?>
<div id="contenu">
    <h2>Gestion des nageurs</h2>
    <a href="formulaire_ajout_nouveau_nageur.php">Ajouter un nageur</a><br>
    <?php
    if ($_GET) {
        echo '<br>' . $_GET['message'] . '<br>';
    }
    ?>    
    <table>
        <tr>
            <th>Nageur</th>
            <th>Sexe</th>
            <th>Date de naissance</th>
            <th>Catégorie</th>
            <th>Club</th>
            <th>Edition</th>
            <th>Suppression</th>
        </tr>
        <?php
        //recuperation de tous les nageurs
        $res = mysql_query("SELECT * FROM `nageur`") or die(mysql_error());
        if (mysql_numrows($res) == 0) {// aucun element trouve
            echo '<tr><td colspan="4" align="center">Contenu vide</td></tr>';
        } else {
            while ($line = mysql_fetch_array($res)) {
                //rechercher le nom de la categorie correspondant à id_categorie
                $res_cat = mysql_query("SELECT * FROM `categorie` WHERE `id_categorie` = " . $line['id_categorie']);
                $cat = mysql_fetch_array($res_cat);
                //formatage pour afficher la date
                $date = explode("-", $line["annee_naissance"]);
                ?>
                <tr>
                    <td><?= $line['nom_nageur'] . ' ' . $line['prenom_nageur'] ?></td>
                    <td align="center"><?= $line['sexe'] ?></td>
                    <td align="center"><?= $date[2].'/'.$date[1].'/'.$date[0] ?></td>
                    <td align="center"><?= $cat['nom_categorie'] ?></td>
                    <td align="center"><?= $line['club'] ?></td>
                    <td align="center"><a href="formulaire_modifier_nageur.php?id=<?= $line['id_nageur'] ?>">Modifier</a></td>
                    <td align="center"><a href="supprimer_nageur.php?id=<?= $line['id_nageur'] ?>" onclick="return confirm('Voulez vous supprimer ce nageur?')">Supprimer</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
</div>
<?php include 'footer.php'; ?>