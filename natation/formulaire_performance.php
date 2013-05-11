<?php include './entete.php' ?>
<div class="contenu">
    <center><h2>Ajouter une nouvelle performance</h2></center>
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
                        <td id="libelle">Temps:</td><td><input type="text" name="temps" size="5"/></td>
                    </tr>
                    <tr>
                        <td id="libelle">Points:</td><td><input type="text" name="points" size="5"/></td>
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
