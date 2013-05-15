<?php include './entete.php' ?>
<div class="contenu">
    <?php
    include './model/class.nageur.php';
    //si l'on doit afficher les informations du nageur
    if ($_GET) {
        //rechercher le nageur par son id
        $id_nageur = $_GET['id'];
        $nageur = nageur::rechercherParId($id_nageur);
        echo '<center><h3>'.$nageur['nom'] . ' ' . $nageur['prenom'].'</h3></center>';
        
        //performances du nageur
        include './model/class.performance.php';
        $performances = performance::rechercherParNageur($id_nageur);
        
        
    } else {
        ?>
        <center><h3>Liste des nageurs</h3></center>
        <?php
        //recuperation de tous les nageurs
        $nageurs = nageur::rechercherTout();
        foreach ($nageurs as $key => $nageur) {
            echo '<div id="nageur"><a href="?id=' . $nageur['idnageur'] . '">' . $nageur['nom'] . ' ' . $nageur['prenom'] . '</a></div>';
        }
    }
    ?>
</div>
<?php include './pied_de_page.php' ?>
