<?php

/**
 * Gere la performance des joueurs (enregistrement, modification, suppression
 *  etc.)
 * @author kaba
 */
if (file_exists('../include/connexion.php')) {
    include_once '../include/connexion.php';
} else {
    include_once 'include/connexion.php';
}


class performance {

    /**
     * Nom de la colonne cle primaire de la table
     * @var string 
     */
    private static $cle_primaire = 'idperformance';

    /**
     * Nom de la table
     * @var string 
     */
    private static $table = 'performance';


    function __construct() {
    }

    /**
     * Ajoute une nouvelle performance
     * @return boolean
     */
    public static function enregistrer($points, $temps, $id_nageur, $id_epreuve, $annee) {
        mysql_query("INSERT INTO `".self::$table."` (`points`, `temps`, `idnageur`, `idepreuve`, `annee`) VALUES "
                        . "('$points', '$temps', '$id_nageur', '$id_epreuve', '$annee')") or die(mysql_error());
        return true;
    }

    /**
     * Modification d'une performance suivant l'id
     * @param int $idperformance
     * @param int $points
     * @param string $temps
     * @param int $id_nageur
     * @param int $id_epreuve
     * @return boolean
     */
    public static function modifier($idperformance, $points, $temps, $id_nageur, $id_epreuve, $annee) {
        mysql_query("UPDATE `".self::$table."` SET `points` = '$points', `temps` = '$temps', `idnageur` = '$id_nageur', `idepreuve` = '$id_epreuve', `annee` = '$annee'"
                        . " WHERE `".self::$cle_primaire."` = '$idperformance'") or die(mysql_error());
        return true;
    }

    /**
     * Supprime une performance
     * @param type $id_performance
     */
    public static function supprimer($id_performance) {
        mysql_query("DELETE FROM `".self::$table."` WHERE `".self::$cle_primaire."` = $id_performance") or die(mysql_error());
        return true;
    }

    /**
     * Recherche les performances par son id
     * @param int $id_performance l'id de la performance
     * @return boolean | array, false si aucune performance correspondante n'a ete trouvee, sinon retourne la ligne correspondante
     * a la performance
     */
    public static function rechercherParId($id_performance) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `".self::$cle_primaire."` =  '$id_performance'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {           
            return mysql_fetch_array($res);
        }
        return false;
    }
    /**
     * Recherche les performances d'un nageur
     * @param int $id_nageur l'id du nageur
     * @return boolean | array, false si aucune performance correspondante n'a ete trouvee, sinon retourne les performances du nageur 
     * dans un tableau
     */
    public static function rechercherParNageur($id_nageur) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `idnageur` =  '$id_nageur'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $performances = array();
            //Recuperer toutes les lignes trouves
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $performances[] = $ligne;
            }
            return $performances;
        }
        return false;
    }

        /**
     * Recherche les performances d'un nageur
     * @param int $id_nageur l'id du nageur
     * @return boolean | array, false si aucune performance correspondante n'a ete trouvee, sinon retourne les performances du nageur 
     * dans un tableau
     */
    public static function rechercherParNageurAnnee($id_nageur, $annee) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `idnageur` =  '$id_nageur' AND `annee` = '$annee' ORDER BY `idperformance` DESC") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $performances = array();
            //Recuperer toutes les lignes trouves
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $performances[] = $ligne;
            }
            return $performances;
        }
        return false;
    }

    /**
     * Recherche les performances d'une epreuve
     * @param int $idepreuve l'id de l'epreuve
     * @return boolean | array, false si aucune performance correspondante n'a ete trouvee, sinon retourne les performances du nageur 
     * dans un tableau
     */
    public static function rechercherParEpreuve($idepreuve) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `idepreuve` =  '$idepreuve'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $performances = array();
            //Recuperer toutes les lignes trouves
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $performances[] = $ligne;
            }
            return $performances;
        }
        return false;
    }
    /**
     * Recherche les performances d'un nageur pour une epreuve donnee
     * @param int $idnageur l'id du nageur
     * @param int $idepreuve l'id de l'epreuve
     * @return boolean | array, false si aucune performance correspondante n'a ete trouvee suivant l'epreuve, sinon retourne les performances du nageur 
     * dans un tableau
     */
    public static function rechercherParNageurEpreuve($idnageur, $idepreuve){
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `idnageur` =  '$idnageur' AND `idepreuve` =  '$idepreuve'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $performances = array();
            //Recuperer toutes les lignes trouves
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $performances[] = $ligne;
            }
            return $performances;
        }
        return false;
    }
    /**
     * Recherche les performances d'un nageur pour une epreuve donnee et pour une annee donnee
     * @param int $idnageur l'id du nageur
     * @param int $idepreuve l'id de l'epreuve
     * @return boolean | array, false si aucune performance correspondante n'a ete trouvee suivant l'epreuve, sinon retourne les performances du nageur 
     * dans un tableau
     */
    public static function rechercherParNageurEpreveuveAnnee($idnageur, $idepreuve, $annee){
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `idnageur` =  '$idnageur' AND `idepreuve` =  '$idepreuve' AND `annee` = '$annee'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $performances = array();
            //Recuperer toutes les lignes trouves
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $performances[] = $ligne;
            }
            return $performances;
        }
        return false;
    }
    
    /**
     * Recherche toutes les performances
     * @return boolean | array
     */
    public static function rechercherTout(){
         //Recuperer toutes les performances
        $res = mysql_query("SELECT * FROM `".self::$table."` ORDER BY `idnageur` DESC") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $performances = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $performances[] = $ligne;
            }
            return $performances;
        }
        return false;
    }
}

