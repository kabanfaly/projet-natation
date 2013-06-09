<?php include './header.php' ;
include_once("code_connexion_pdo.php");
?>
<div id="contenu">

        <center><h3>Liste des nageurs</h3></center>
        <?php
        //recuperation de tous les nageurs
       $res = mysql_query("SELECT * FROM `nageur`") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            //affichage de chaque ligne trouvée
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                echo '<div><a href="nageur.php?id=' . $ligne['id_nageur'] . '">' . $ligne['nom_nageur']. ' ' .$ligne['prenom_nageur'] . '</a></div>';
            }
        }else{
             echo "contenu vide";
        }       
    
    ?>
</div>
<?php include './footer.php' ?>
