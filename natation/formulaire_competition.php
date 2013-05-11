<?php include './entete.php' ?>
<div class="contenu">
    <center><h2>Ajouter une nouvelle comp&eacute;tition</h2></center>
    <center>
        <div id="formulaire">        
            <table>
                <form method="post" action="">            
                    <tr>
                        <td id="libelle">Nageur:</td>
                        <td>
                            <select name="idnageur">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td id="libelle">Epreuve:</td>
                        <td>
                            <select name="idepreuve">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td id="libelle">Cat&eacute;gorie ma&icirc;tre:</td>
                        <td>
                            <select name="idcategorie_maitre">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td id="libelle">Ann&eacute;:</td><td><input type="text" name="annee" size="5"/></td>
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
