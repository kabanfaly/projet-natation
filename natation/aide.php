<?php include './entete.php' ?>
<div class="contenu">
    <?php
    //si l'admin est connecte
    if (isset($_SESSION['admin']) && $_SESSION['admin']) {
        ?>
    <center><h2>Notice d'utilisation du site</h2></center>
    <p>
        <i>Cette page explique comment configurer le contenu du site par l'administrateur. 
        Cette configuration requiert un ordre de configuration à respecter.</i>
    </p>
    <p>
    <ol>
        <li>
            <h4>Gestion des cat&eacute;gories:</h4>
            <p>
                Cette page permet d'ajouter, de modifier ou de supprimer une cat&eacute;gorie
            </p>
        </li>
        <li>
            <h4>Gestion des nageurs:</h4>
            <p>
                Cette page permet d'ajouter, de modifier ou de supprimer un nageur
            </p>
        </li>
        <li>
            <h4>Gestion des types de nage:</h4>
            <p>
                Cette page permet d'ajouter, de modifier ou de supprimer un type de nage
            </p>
        </li>
        <li>
            <h4>Gestion des &eacute;preuves:</h4>
            <p>
                Cette page permet d'ajouter, de modifier ou de supprimer une &eacute;preuve
            </p>
        </li>
        <li>
            <h4>Gestion des comp&eacute;titions:</h4>
            <p>
                Cette page permet d'ajouter, de modifier ou de supprimer une comp&eacute;tition
            </p>
        </li>
        <li>
            <h4>Gestion des performances:</h4>
            <p>
                Cette page permet d'ajouter, de modifier ou de supprimer une performance.
                NB: Lors de l'enregistrement ou de la modification d'une performance on v&eacute;rifie le format du temps. 
                Celui ci devra s'&eacute;crire sous la forme suivante: <i>mm:ss.cs</i> <br>
                o&ugrave;: <i>mm</i> = minute <br>
                <i>ss</i> = seconde <br>
                <i>ms</i> = centi&egrave;me de seconde <br>
            </p>
        </li>
    </ol>    
    
    </p>
    
    
        <?php
    }
    ?>
</div>
<?php include './pied_de_page.php' ?>