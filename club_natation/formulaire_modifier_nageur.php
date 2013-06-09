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

//recuperation du nageur
if ($_GET) {
    $id = $_GET['id'];
    $res = mysql_query("SELECT * FROM `nageur` WHERE `id_nageur` =  $id") or die(mysql_error());
    $nageur = '';
    //le nageur n'existe pas
    if (mysql_num_rows($res) == 0) {
        $message = '<span>Aucun nageur correspondant trouvé</span>';
    } else {
        //infos du nageur
        $nageur = mysql_fetch_array($res);
        $nom_nageur = $nageur['nom_nageur'];
        $prenom_nageur = $nageur['prenom_nageur'];
        $date = explode("-", $nageur["annee_naissance"]);        
        $annee_naissance = $date[2] . '/' . $date[1] . '/' . $date[0];        
        $sexe = $nageur['sexe'];
        $id_categorie = $nageur['id_categorie'];
        $club = $nageur['club'];
    }
}
//enregistrement des modification
if ($_POST) {
    if (!(isset($_POST["sexe"]))) {
        $message = "<p class='erreur'>Veuillez sélectionner un sexe</p>";
    }elseif ($_POST['id_categorie'] == '') {
        $message = "<p class='erreur'>Veuillez sélectionner une catégorie</p>";
    }
    //vérification de l'année de naissance
    $date = explode("/", $_POST["annee_naissance"]);
    if (!(checkdate($date[1], $date[0], $date[2]))) {        
        $message = "<p class='erreur'>année de naissance invalide</p>";
    } 
    if ($message == "") {
        $date_naissance = $date[2] . "-" . $date[1] . "-" . $date[0];        
        $requete = "UPDATE `nageur` SET `nom_nageur` = '" . mysql_escape_string($_POST['nom_nageur']) .
                "', `prenom_nageur` = '" . mysql_escape_string($_POST['prenom_nageur'])  .
                "', `sexe` = '" . mysql_escape_string($_POST['sexe']) .
                "', `annee_naissance` = '" . $date_naissance .
                "', `club` = '" . $_POST['club'] . "'" .
                " WHERE `id_nageur` = " . $_GET['id'];    
        mysql_query($requete) or die(mysql_error());
        header('Location: ges_nageurs.php?message=Modification OK');
    }
}
?>
<div id="contenu">
    <h2>Modifier un nageur</h2>
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
                <td colspan="2"><input type="submit" value="Modifier"></td>
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>