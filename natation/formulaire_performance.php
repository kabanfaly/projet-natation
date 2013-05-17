<?php include './entete.php' ?>
<div class="contenu">
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'modif') {
            echo '<center><h2>Modifier la performance</h2></center>';
        } else {
            //supprimer de l'id de la performance enregistre eventuellement
            unset($_SESSION['idperformance']);
            echo '<center><h2>Ajouter une performance</h2></center>';
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
                ?>
            </div>
            <table>
                <?php
                //inclusion des classes
                include 'model/class.nageur.php';
                include 'model/class.epreuve.php';
                include 'model/class.type_nage.php';
                //rechercher tous les nageurs
                $nageurs = nageur::rechercherTout();
                //rechercher toutes les epreuves
                $epreuves = epreuve::rechercherTout();
                ?>
                <form method="post" action="controleur/controleur_performance.php">            
                    <tr>
                        <td id="libelle">Nageur:</td>
                        <td>
                            <select name="idnageur">
                                <option value="">Choisissez</option>
                                <?php
                                if ($nageurs) {
                                    foreach ($nageurs as $key => $nageur) {
                                        if (isset($_SESSION['contenu_performance']) && $_SESSION['contenu_performance']['idnageur'] === $nageur['idnageur']) {
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
                                        if (isset($_SESSION['contenu_performance']) && $_SESSION['contenu_performance']['idepreuve'] === $epreuve['idepreuve']) {
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
                        <td id="libelle">Temps:</td><td><input type="text" name="temps" size="5" value="<?php
                                                                     if (isset($_SESSION['contenu_performance'])) {
                                                                         echo $_SESSION['contenu_performance']['temps'];
                                                                     }
                                                                     ?>" required="true"/>(HH:mm:ss)</td>
                    </tr>
                    </tr>
                        <td id="libelle">Points:</td><td><input type="text" name="points" size="5" value="<?php
                                                                     if (isset($_SESSION['contenu_performance'])) {
                                                                         echo $_SESSION['contenu_performance']['points'];
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
        </div>
    </center>
</div>
<?php include './pied_de_page.php' ?>
