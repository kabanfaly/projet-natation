<?php

/**
 * Gere les acces administrateur
 *
 * @author kaba
 */
if (file_exists('../include/connexion.php')) {
    include_once '../include/connexion.php';
} else {
    include_once 'include/connexion.php';
}


class administrateur {
    /**
     * Creer un nouvel administrateur s'il n'existe aucun administrateur ou bien modifie le mot de passe 
     * de l'administrateur dont le login correspond au login donne
     * @param string $login
     * @param string $mdp
     */
    public static function creerAdmin($login, $mdp){
        $res = mysql_query("SELECT * FROM `administrateur` WHERE `login` = '$login'") or die(mysql_error());
        //si aucun administrateur n'existe
        if(mysql_num_rows($res) == 0){
            mysql_query("INSERT INTO `administrateur` (`login`, `mot_de_passe`) VALUES ('$login', '$mdp') ;");
        }else{
            mysql_query("UPDATE `administrateur` SET `mot_de_passe` = '$mdp' WHERE `login` = '$login'");
        }
    }
}
