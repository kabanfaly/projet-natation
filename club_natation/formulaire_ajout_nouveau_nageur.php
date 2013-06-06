<?php
include 'header.php';
include_once("code_connexion_pdo.php");

$message = "";
if ($_POST) {

    if (!(isset($_POST["sexe"]))) {
        $message = "<p class='erreur'>Veuillez sélectionner un sexe</p>";
    }
    //on crée un tableau en utilisant la fonction explode qui transforme les données en tableau
    $date = explode("/", $_POST["annee_naissance"]);
    if (!(checkdate($date[1], $date[0], $date[2]))) {
        $message = "<p class='erreur'>année de naissance invalide</p>";
    } else {
        $message.="<p class='erreur'>année de naissance invalide</p>";
    }
    if ($message == "") {
        $date_naissance = $date[2] . "-" . $date[1] . "-" . $date[0];
        $requete = "INSERT INTO nageur (`nom_nageur`,`prenom_nageur`,`sexe`,`annee_naissance`,`age`,`id_categorie`,`club`) VALUES('" . mysql_escape_string($_POST['nom_nageur']) . "','" .
                mysql_escape_string($_POST['prenom_nageur']) . "','" . $_POST['sexe'] . "','" . $date_naissance . "', '" . mysql_escape_string($_POST['age']) . "'," . mysql_escape_string($_POST['id_categorie']) . " ,"
                . mysql_escape_string($_POST['club']) . "')";

        mysql_query($requete) or die(mysql_error());
        $message = 'Enregistrement OK';
    }
}
?>
<div id="contenu">
    <h2>Gestion des nageurs</h2>
    <div><?= $message ?></div>
    <form method="post">
        <table>
            <tr>
                <td>Nom: </td>
                <td><input type="text" name="nom_nageur" required="true"></td>
            </tr>
            <tr>
                <td>Prénom: </td>
                <td><input type="text" name="prenom_nageur"  required="true"> </td>
            </tr>
            <tr>
                <td>Sexe: </td>
                <td>H <input type="radio" name="sexe" value="Homme"> F <input type="radio" name="sexe" value="Femme"></td>
            </tr>
            <tr>
                <td>Année de naissance(au format JJ/MM/AAAA):</td>
                <td><input type="text" name="annee_naissance" value=""  required="true"></td>
            </tr>
            <tr>
                <td>Catégorie: </td>
                <td><input type="text" name="id_categorie" ></td>
            </tr>
            <tr>
                <td>Club: </td>
                <td><input type="text" name="club"  required="true"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="ajouter" value="Ajouter"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>

