<?php
include 'header.php';
include_once("code_connexion_pdo.php");
?>
<div id="contenu">
    <h2>Gestion des épreuves</h2>    
    <a href="formulaire_ajout_nouvelle_epreuve.php">Ajouter un nageur</a>
    <?php
    if ($_GET) {
        echo $_GET['message'];
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
        //recuperation de tous les nageurs
        $res = mysql_query("SELECT * FROM `epreuve`") or die(mysql_error());
        if (mysql_numrows($res) == 0) {// aucun elemen trouve
            echo '<tr><td colspan="4" align="center">Contenu vide</td></tr>';
        } else {
            while ($line = mysql_fetch_array($result)) {
                ?>
                <tr>
                    <td><?= $line['type_epreuve'] ?></td>
                    <td><?= $line['distance_epreuve'] ?></td>
                    <td><a href="formulaire_modifer_epreuve.php?id=<?= $line['id_epreuve'] ?>">Modifier</a></td>
                    <td><a href=supprimer_epreuve.php?id=<?= $line['id_epreuve'] ?>" onclick="return confirm('Voulez vous supprimer cette epreuve?')">Supprimer</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<?php include 'footer.php'; ?>