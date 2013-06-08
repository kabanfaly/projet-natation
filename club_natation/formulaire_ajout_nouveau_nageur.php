<?php
include 'header.php';
include_once("code_connexion_pdo.php");

$message = "";
$nom_nageur = "";
$prenom_nageur = "";
$annee_naissance = "";
$sexe = "";
$id_categorie = "";
$club = "";
if ($_POST) {
    //recuperation de la valeur des champs
    $nom_nageur = $_POST["nom_nageur"];
    $prenom_nageur = $_POST["prenom_nageur"];
    $annee_naissance = $_POST["annee_naissance"];
    $id_categorie = $_POST["id_categorie"];
    $club = $_POST["club"];

    if (!(isset($_POST["sexe"]))) {
        $message = "<p class='erreur'>Veuillez sélectionner un sexe</p>";
    } elseif ($id_categorie == '') {
        $message = "<p class='erreur'>Veuillez sélectionner une catégorie</p>";
    }
    //on crée un tableau en utilisant la fonction explode qui transforme les données en tableau
    $date = explode("/", $annee_naissance);
    if (!(checkdate($date[1], $date[0], $date[2]))) {
        $message = "<p class='erreur'>année de naissance invalide</p>";
    }
    if ($message == "") {
        $sexe = $_POST["sexe"];
        $date_naissance = $date[2] . "-" . $date[1] . "-" . $date[0];
        $requete = "INSERT INTO nageur (`nom_nageur`,`prenom_nageur`,`sexe`,`annee_naissance`,`id_categorie`,`club`) "
                . "VALUES('" . mysql_escape_string($nom_nageur) . "','" 
                . mysql_escape_string($prenom_nageur) . "','" . $sexe . "','" 
                . $date_naissance . "', " . mysql_escape_string($id_categorie) . " ,'"
                . mysql_escape_string($club) . "')";
        mysql_query($requete) or die(mysql_error());
        header('Location: ges_nageurs.php?message=Enregistrement OK');
    }
}
?>
<div id="contenu">
    <h2>Ajouter un nageur</h2>
    <div><?= $message ?></div>
    <form method="post">
        <table>
            <tr>
                <td>Nom: </td>
                <td><input type="text" name="nom_nageur" required="true" value="<?= $nom_nageur ?>"></td>
            </tr>
            <tr>
                <td>Prénom: </td>
                <td><input type="text" name="prenom_nageur"  required="true" value="<?= $prenom_nageur ?>"> </td>
            </tr>
            <tr>
                <td>Sexe: </td>
                <td>H<input type="radio" name="sexe" <?php if ($sexe == 'Homme') echo 'checked="true"'; ?> value="Homme">F<input type="radio" name="sexe"  <?php if ($sexe == 'Femme') echo 'checked="true"'; ?> value="Femme"></td>
            </tr>
            <tr>
                <td>Année de naissance(au format JJ/MM/AAAA):</td>
                <td><input type="text" name="annee_naissance" required="true" value="<?= $annee_naissance ?>"></td>
            </tr>
            <tr>
                <td>Catégorie: </td>
                <td><select name="id_categorie">
                        <option value="">choisissez</option>
                        <?php
                        $res = mysql_query("SELECT * FROM `categorie`") or die(mysql_error());
                        if (mysql_num_rows($res) != 0) {
                            while ($line = mysql_fetch_array($res)) {
                                if ($id_categorie == $line['id_categorie']) {
                                    echo '<option value="' . $line['id_categorie'] . '" selected="true">' . $line['description'] . '</option>';
                                } else {
                                    echo '<option value="' . $line['id_categorie'] . '">' . $line['description'] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>Club: </td>
                <td><input type="text" name="club"  required="true" value="<?= $club ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Ajouter"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>

