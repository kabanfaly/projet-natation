<?php include './entete.php' ?>
<div class="contenu">
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'modif') {
            echo '<center><h2>Modifier la comp&eacute;tition</h2></center>';
        } else {
            //supprimer de l'id de la competition enregistre eventuellement
            unset($_SESSION['idcompetition']);
            echo '<center><h2>Ajouter une comp&eacute;tition</h2></center>';
        }
    }
    ?>
    <center>
        <div id="formulaire">
            <div id="messageErreur">
                <?php
                if (isset($_GET['message'])) {
                    echo $_GET['message'];
                }
                //si l'admin est connecte
                if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                    ?>
                </div>
                <table>
                    <?php
                    //inclusion des classes
                    include 'model/class.nageur.php';
                    include 'model/class.epreuve.php';
                    include 'model/class.type_nage.php';
                    include 'model/class.categorie_maitre.php';
                    //rechercher tous les nageurs
                    $nageurs = nageur::rechercherTout();
                    //rechercher toutes les epreuves
                    $epreuves = epreuve::rechercherTout();
                    //rechercher toutes les categories maitres
                    $categorie_maitres = categorie_maitre::rechercherTout();
                    ?>
                    <form method="post" action="controleur/controleur_competition.php">            
                        <tr>
                            <td id="libelle">Nageur:</td>
                            <td>
                                <select name="idnageur">
                                    <option value="">Choisissez</option>
                                    <?php
                                    if ($nageurs) {
                                        foreach ($nageurs as $key => $nageur) {
                                            if (isset($_SESSION['contenu_competition']) && $_SESSION['contenu_competition']['idnageur'] === $nageur['idnageur']) {
                                                echo '<option value="' . $nageur['idnageur'] . '" selected="true">' . $nageur['nom'] . ' ' . $nageur['prenom'] . '</option>';
                                            } else {
                                                echo '<option value="' . $nageur['idnageur'] . '">' . $nageur['nom'] . ' ' . $nageur['prenom'] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td id="libelle">Epreuve:</td>
                            <td>
                                <select name="idepreuve">
                                    <option value="">Choisissez</option>
                                    <?php
                                    if ($nageurs) {
                                        foreach ($epreuves as $key => $epreuve) {
                                            $type_nage = type_nage::rechercherParId($epreuve['idtype_de_nage']);
                                            if (isset($_SESSION['contenu_competition']) && $_SESSION['contenu_competition']['idepreuve'] === $epreuve['idepreuve']) {
                                                echo '<option value="' . $epreuve['idepreuve'] . '" selected="true">' . $type_nage['type'] . ' (' . $epreuve['distance'] . ')' . '</option>';
                                            } else {
                                                echo '<option value="' . $epreuve['idepreuve'] . '">' . $type_nage['type'] . ' (' . $epreuve['distance'] . ')' . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td id="libelle">Cat&eacute;gorie ma&icirc;tre:</td>
                            <td>
                                <select name="idcategorie_maitre">
                                    <option value="">Choisissez</option>
                                    <?php
                                    if ($nageurs) {
                                        foreach ($categorie_maitres as $key => $categorie_maitre) {
                                            if (isset($_SESSION['contenu_competition']) && $_SESSION['contenu_competition']['idcategorie_maitre'] === $categorie_maitre['idcategorie_maitre']) {
                                                echo '<option value="' . $categorie_maitre['idcategorie_maitre'] . '" selected="true">' . $categorie_maitre['categorie']. '</option>';
                                            } else {
                                                echo '<option value="' . $categorie_maitre['idcategorie_maitre'] . '">' . $categorie_maitre['categorie'] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td id="libelle">Ann&eacute;e</td><td><input type="text" name="annee" size="5" value="<?php
                                                                         if (isset($_SESSION['contenu_competition'])) {
                                                                             echo $_SESSION['contenu_competition']['annee'];
                                                                         }
                                                                         ?>" required="true"/></td>
                        </tr>

                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" value="Valider"/>
                            </td>
                        </tr>
                    </form>
                </table>
                <?php
            }
            ?>
        </div>
    </center>
</div>
<?php include './pied_de_page.php' ?>
