<?php
include 'header.php';
include_once("code_connexion_pdo.php");

$message = "";
if ($_POST) {
    $requete = "INSERT INTO epreuve (`type_epreuve`,`distance_epreuve`) VALUES('" . mysql_escape_string($_POST['type_epreuve']) . "','" .
            mysql_escape_string($_POST['distance_epreuve']) ."')";

    mysql_query($requete) or die(mysql_error());
    header('Location: ges_epreuves.php?message=Enregistrement OK');
}
?>
<div id="contenu">
    <h2>Ajouter une épreuve</h2>
    <div><?= $message ?></div>
    <form method="post">
        <table>
            <tr>
                <td>Type de l'epreuve: </td>
                <td><input type="text" name="type_epreuve" required="true"></td>
            </tr>
            <tr>
                <td>Distance: </td>
                <td><input type="text" name="distance_epreuve"  required="true"> </td>
            </tr>          
            <tr>
                <td colspan="2"><input type="submit" name="ajouter" value="Ajouter"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>

