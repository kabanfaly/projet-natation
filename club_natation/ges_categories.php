<?php
include 'header.php';
include_once("code_connexion_pdo.php");
?>
<div id="contenu">
    <h2>Gestion des catégories</h2>    
    <a href="formulaire_ajout_nouvelle_categorie.php">Ajouter une catégorie</a><br>
    <?php
    if ($_GET) {
        echo '<br>'.$_GET['message'].'<br>';
    }
    ?>    
    <table>
        <tr>
            <th>Catégorie</th>
            <th>Description</th>
            <th>Edition</th>
            <th>Suppression</th>
        </tr>
        <?php
        //recuperation de toutes les categories
        $res = mysql_query("SELECT * FROM `categorie`") or die(mysql_error());
        if (mysql_numrows($res) == 0) {// aucun element trouve
            echo '<tr><td colspan="4" align="center">Contenu vide</td></tr>';
        } else {
            while ($line = mysql_fetch_array($res)) {
                ?>
                <tr>
                    <td><?= $line['nom_categorie'] ?></td>
                    <td align="center"><?= $line['description'] ?></td>
                    <td align="center"><a href="formulaire_modifier_categorie.php?id=<?= $line['id_categorie'] ?>">Modifier</a></td>
                    <td align="center"><a href="supprimer_categorie.php?id=<?= $line['id_categorie'] ?>" onclick="return confirm('Voulez vous supprimer cette categorie?')">Supprimer</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
        </div>
</div>
<?php include 'footer.php'; ?>