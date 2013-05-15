<?php include './entete.php' ?>
<div class="contenu">
    <br>
    <center>
        <div id="success">
            <?php
            if (isset($_GET['message'])) {
                echo $_GET['message'];
            }
            ?>
        </div>
        <div><a href="formulaire_admin.php">Modifier le mot de passe de l'administrateur courant</a></div>
    </center>
</div>
<?php include './pied_de_page.php' ?>