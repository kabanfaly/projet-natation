<?php include './entete.php' ?>
<div class="contenu">
    <center><h2>Gestion des nageurs</h2></center>
    <span><a href="formulaire_nageur.php"><button>Ajouter un nouveau nageur</button></a></span>
    <center>
        <div id="afficheur">
            <table>
                <tr>
                    <th align="left">Nom</th>
                    <th>Date de naissance</th>
                    <th>Sexe</th>
                    <th>Groupe</th>
                    <?php
                    //Inclusion de la classe de la classe nageur
                    include 'model/class.nageur.php';

                    //Recuperation de tous les nageurs
                    $nageurs = nageur::rechercherTout();

                    //si aucun nageur n'existe
                    if (!$nageurs) {
                        echo "Il n'existe aucun nageur enregistr&eacute;";
                    } else {//sinon afficher tous les nageurs dans un tableau
                        $style = "lignePaire";
                        foreach ($nageurs as $key => $nageur) {
                            if($key % 2 == 0){
                                 $style = "lignePaire";
                            }else{
                                 $style = "ligneImpaire";
                            }
                            $explode = explode('-', $nageur['date_de_naissance']);
                            $nageur['date_de_naissance'] = $explode[2].'/'.$explode[1].'/'.$explode[0];
                            ?>
                        <tr id="<?= $style ?>">
                            <td><?= $nageur['nom'].' '.$nageur['prenom'] ?> </td>
                            <td align="center"><?= $nageur['date_de_naissance'] ?> </td>
                            <td align="center"><?= $nageur['sexe'] ?> </td>
                            <td align="center"><?= $nageur['groupe'] ?> </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tr>
            </table>
        </div>
    </center>
</div>
<?php include './pied_de_page.php' ?>
