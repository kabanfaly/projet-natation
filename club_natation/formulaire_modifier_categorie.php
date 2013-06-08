<?php
include 'header.php';
include_once("code_connexion_pdo.php");

$message = "";
$nom_categorie = "";
$description = "";
if ($_GET) {
    $id = $_GET['id'];
    $res = mysql_query("SELECT * FROM `categorie` WHERE `id_categorie` =  $id") or die(mysql_error());
    $epreuve = '';
    if (mysql_num_rows($res) == 0) {
        $message = '<span>Aucune catégorie correspondante trouvée</span>';
    } else {
        $epreuve = mysql_fetch_array($res);
        $nom_categorie = $epreuve['nom_categorie'];
        $description = $epreuve['description'];
    }
}
if ($_POST) {
    $requete = "UPDATE `categorie` SET `nom_categorie` = '" . mysql_escape_string($_POST['nom_categorie']) . "', `description` = '" .
            mysql_escape_string($_POST['description']) . "' WHERE `id_categorie` = ".$_GET['id'];
    
    mysql_query($requete) or die(mysql_error());
    header('Location: ges_categories.php?message=Modification OK');
}
?>
<div id="contenu">
    <h2>Mofier une categorie</h2>
    <div><?= $message ?></div>
    <form method="post">
        <table>
            <tr>
                <td>Catégorie: </td>
                <td><input type="text" name="nom_categorie" required="true" value="<?=$nom_categorie?>"></td>
            </tr>
            <tr>
                <td>Description: </td>
                <td><input type="text" name="description"  required="true" value="<?=$description?>"> </td>
            </tr>          
            <tr>
                <td colspan="2"><input type="submit" value="Modifier"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>