<?php
include 'header.php';
include_once("code_connexion_pdo.php");

$message = "";
if ($_POST) {
    $requete = "INSERT INTO categorie (`nom_categorie`,`description`) VALUES('" . mysql_escape_string($_POST['nom_categorie']) . "','" .
            mysql_escape_string($_POST['description']) ."')";

    mysql_query($requete) or die(mysql_error());
    $message = 'Enregistrement OK';
}
?>
<div id="contenu">
    <h2>Gestion des catégories</h2>
    <div><?= $message ?></div>
    <form method="post">
        <table>
            <tr>
                <td>Nom: </td>
                <td><input type="text" name="nom_categorie" required="true"></td>
            </tr>
            <tr>
                <td>Description: </td>
                <td><input type="text" name="description"  required="true"> </td>
            </tr>          
            <tr>
                <td colspan="2"><input type="submit" name="ajouter" value="Ajouter"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>

