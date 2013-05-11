<?php include './entete.php' ?>
<div class="contenu">
    <center><h2>Ajouter un nouveau nageur</h2></center>
    <center>
        <div id="formulaire">        
            <table>
                <form method="post" action="">            
                    <tr>
                        <td id="libelle">Nom:</td><td><input type="text" name="nom"/></td>
                    </tr>
                    <tr>
                        <td id="libelle">Pr&eacute;nom:</td><td><input type="text" name="prenom"/></td>
                    </tr>
                    <tr>
                        <td id="libelle">Date de naissance:</td><td><input type="text" name="date_de_naissance"/>&nbsp;JJ/MM/AAAA</td>
                    </tr>
                    <tr>
                        <td id="libelle">Sexe:</td>
                        <td>
                            <select name="sexe">
                                <option value="M">M&acirc;le</option>
                                <option value="F">Femelle</option>
                            </select>
                        </td>
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
