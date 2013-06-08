<?php
include 'header.php';
include_once("code_connexion_pdo.php");

$message = "";
$type_epreuve = "";
$distance_epreuve = "";
if ($_GET) {
    $id = $_GET['id'];
    $res = mysql_query("SELECT * FROM `epreuve` WHERE `id_epreuve` =  $id") or die(mysql_error());
    $epreuve = '';
    if (mysql_num_rows($res) == 0) {
        $message = '<span>Aucune epreuve correspondante trouvée</span>';
    } else {
        $epreuve = mysql_fetch_array($res);
        $type_epreuve = $epreuve['type_epreuve'];
        $distance_epreuve = $epreuve['distance_epreuve'];
    }
}
if ($_POST) {
    $requete = "UPDATE `epreuve` SET `type_epreuve` = '" . mysql_escape_string($_POST['type_epreuve']) . "', `distance_epreuve` = '" .
            mysql_escape_string($_POST['distance_epreuve']) . "' WHERE `id_epreuve` = ".$_GET['id'];
    
    mysql_query($requete) or die(mysql_error());
    header('Location: ges_epreuves.php?message=Modification OK');
}
?>
<div id="contenu">
    <h2>Modifier une épreuve</h2>
    <div><?= $message ?></div>
    <form method="post">
        <table>
            <tr>
                <td>Type de l'epreuve: </td>
                <td><input type="text" name="type_epreuve" required="true" value="<?=$type_epreuve?>"></td>
            </tr>
            <tr>
                <td>Distance: </td>
                <td><input type="text" name="distance_epreuve"  required="true" value="<?=$distance_epreuve?>"> </td>
            </tr>          
            <tr>
                <td colspan="2"><input type="submit" value="Modifier"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>