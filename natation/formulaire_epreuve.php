<?php include './entete.php' ?>
<div class="contenu">
    <center><h2>Ajouter un nouvelle &eacute;preuve</h2></center>
    <center>
        <div id="formulaire">        
            <table>
                <form method="post" action="">            
                    <tr>
                        <td id="libelle">Type de nage:</td>
                        <td>
                            <select name="idtype_de_nage">
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Distance:</td>
                        <td><input type="text" name="distance" size="5"/></td>
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
