<html>
    <head>
        <title>Ajout d'une nouveau nageur</title>
        <meta charset="utf-8"/>
    <h1 align="center">Ajouter un nouveau nageur</h1>
</head>
<body>
    <?php
    include_once("code_connexion_pdo.php");

    if ($_POST) {
        $errors = "";
        if ($_POST["nom_nageur"] == "")
            $errors = $errors . "<p class='erreur'>champ nom invalide</p>";
        if ($_POST["prenom_nageur"] == "")
            $erros = $errors . "<p class='erreur'>champ prenom invalide</p>";
        if (!(isset($_POST["sexe"])))
            $erros = $errors . "<p class='erreur'>Veuillez sélectionner un sexe</p>";

        if ($_POST["annee_naissance"]) {
            //on crée un tableau en utilisant la fonction explode qui transforme les données en tableau
            $date = explode("/", $_POST["annee_naissance"]);
            if (!(checkdate($date[1], $date[0], $date[2])))
                $errors.="<p class='erreur'>année de naissance invalide</p>";
        }
        else {
            $errors.="<p class='erreur'>année de naissance invalide</p>";
        }
        if ($errors == "") {
            $date_naissance = $date[2] . "-" . $date[1] . "-" . $date[0];
            $requete = "INSERT INTO nageur (`nom_nageur`,`prenom_nageur`,`sexe`,`annee_naissance`,`age`,`id_categorie`,`id_categorie_maitre`,`club`) VALUES('" . mysql_escape_string($_POST['nom_nageur']) . "','" . 
                    mysql_escape_string($_POST['prenom_nageur'])  . "','" . $_POST['sexe'] . "','" . $date_naissance . "', '" . mysql_escape_string($_POST['age']) . "'," . mysql_escape_string($_POST['id_categorie']) . " ," 
                    . mysql_escape_string($_POST['id_categorie_maitre']) . " , '" . mysql_escape_string($_POST['club']) . "')";
            
            mysql_query($requete) or die(mysql_error());
            echo 'Enregistrement OK';
        } else {
            echo $errors;
        }
    }
    ?>


    <form method="post">

        <p>Nom: <input type="text" name="nom_nageur" ></p>
        <p>Prénom: <input type="text" name="prenom_nageur" ></p>
        <p>Sexe: H <input type="radio" name="sexe" value="Homme"> F <input type="radio" name="sexe" value="Femme"></p>
        <p>Année de naissance(au format JJ/MM/AAAA):<input type="text" name="annee_naissance" value=""></p>
        <p>Age: <input type="text" name="age" ></p>
        <p>ID catégorie: <input type="text" name="id_categorie" ></p>
        <p>ID categorie maître: <input type="text" name="id_categorie_maitre" ></p>
        <p>Club: <input type="text" name="club" ></p>
        <p><input type="submit" name="ajouter" value="Ajouter"></p>

    </form>



</body>
</html>