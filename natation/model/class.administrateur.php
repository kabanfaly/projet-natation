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
    public static function enregistrer($login, $mdp) {
        mysql_query("INSERT INTO `administrateur` (`login`, `mot_de_passe`) VALUES ('$login', '$mdp') ;") or die(mysql_error());
    }

    /**
     * Modifier le login et le mot de passe de l'administrateur
     * @param string $ancien_login
     * @param string $login
     * @param string $mdp
     */
    public static function modifier($ancien_login, $login, $mdp) {
        mysql_query("UPDATE `administrateur` SET `login` = '$login', `mot_de_passe` = '$mdp' WHERE `login` = '$ancien_login'") or die(mysql_error());
    }

    /**
     * Verifie que la table administrateur est vide
     * @return boolean
     */
    public static function aucunAdministrateur() {
        $res = mysql_query("SELECT * FROM `administrateur`") or die(mysql_error());
        //si aucun administrateur n'existe
        if (mysql_num_rows($res) == 0) {
            return true;
        }
        return false;
    }

    /**
     * Rechercher un administrateur par son login et mot de passe
     * @param string $login
     * @param string $mdp
     * @return boolean
     */
    public static function rechercherParLoginMdp($login, $mdp) {
        $res = mysql_query("SELECT * FROM `administrateur` WHERE `login` = '$login' AND `mot_de_passe` = '$mdp'") or die(mysql_error());
        if (mysql_num_rows($res) == 0) {
            return false;
        }
        return mysql_fetch_array($res);
    }

}
