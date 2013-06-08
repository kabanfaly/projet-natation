<?php
include 'header.php';
include_once("code_connexion_pdo.php");
?>
<div id="contenu">
    <h2>Gestion des épreuves</h2>    
    <a href="formulaire_ajout_nouvelle_epreuve.php">Ajouter une epreuve</a><br>
    <?php
    if ($_GET) {
        echo '<br>'.$_GET['message'].'<br>';
    }
    ?>    
    <table>
        <tr>
            <th>Epreuve</th>
            <th>Distance</th>
            <th>Edition</th>
            <th>Suppression</th>
        </tr>
        <?php
        //recuperation de toutes les épreuves
        $res = mysql_query("SELECT * FROM `epreuve`") or die(mysql_error());
        if (mysql_numrows($res) == 0) {// aucun element trouve
            echo '<tr><td colspan="4" align="center">Contenu vide</td></tr>';
        } else {
            while ($line = mysql_fetch_array($res)) {
                ?>
                <tr>
                    <td><?= $line['type_epreuve'] ?></td>
                    <td align="center"><?= $line['distance_epreuve'] ?></td>
                    <td align="center"><a href="formulaire_modifier_epreuve.php?id=<?= $line['id_epreuve'] ?>">Modifier</a></td>
                    <td align="center"><a href="supprimer_epreuve.php?id=<?= $line['id_epreuve'] ?>" onclick="return confirm('Voulez vous supprimer cette epreuve?')">Supprimer</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
        </div>
</div>
<?php include 'footer.php'; ?>