<?php

/**
 * DCette classe gere les differentes epreuves (enregistrement, modification, suppression
 *  etc.)
 *
 * @author kaba
 */
include_once '../include/connexion.php';

class epreuve {

    /**
     * Nom de la table dans la base de donnees
     * @var string 
     */
    private $table = 'epreuve';

    /**
     * Nom de la colonne cle primaire de la table
     * @var string 
     */
    private static $cle_primaire = 'idpreuve';

    function __construct() {
        
    }

    /**
     * Enregistre une epreuve si elle n'existe pas
     * @param int $id_type_de_nage l'id du type de nage
     * @param int $distance la distance
     * @return boolean true si enregistrement ok
     * @throws Exception si l'epreuve existe deja
     */
    public static function enregistrer($id_type_de_nage, $distance) {
        //Recherche si l'element a enregistrer existe dans la table courante
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `idtype_de_nage` =  '$id_type_de_nage' AND `distance` = '$distance'") or die(mysql_error());

        //Exception si l'epreuve existe 
        if (mysql_num_rows($res) != 0) {
            throw new Exception("Ce type existe deja");
        }
        //si l'epreuve n'existe pas on l'enregistre
        mysql_query("INSERT INTO `" . self::$table . "` (`idtype_de_nage`,`distance`) VALUES ('$id_type_de_nage', '$distance')") or die(mysql_error());
        return true;
    }

    /**
     * Modifie une epreuve suivant l'id 
     * @param int $id_epreuve l'id de l'epreuve
     * @param int $id_type_nage l'id du type de nage
     * @param int $distance la distance
     * @return boolean true si modification OK
     */
    public static function modifier($id_epreuve, $id_type_nage, $distance) {
        mysql_query("UPDATE `" . self::$table . "` SET `idtype_de_nage` = '$id_type_nage', `distance` = '$distance' WHERE `" .
                self::$cle_primaire . "` = '$id_epreuve'") or die(mysql_error());
        return true;
    }

    /**
     * Supprime une epreuve par son ID
     * @param int $id_epreuve
     */
    public static function supprimer($id_epreuve) {
        mysql_query("DELELE FROM `" . self::$table . "` WHERE `" . self::$cle_primaire . "` = $id_epreuve") or die(mysql_error());
        return true;
    }

    /**
     * Recherche une epreuve par son id
     * @param int $id_epreuve l'id de l'epreuve
     * @return boolean | array, false si aucune epreuve correspondante n'a ete trouvee, sinon retourne la ligne correspondante a l'epreuve
     */
    public static function rechercherParId($id_epreuve) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `".self::$cle_primaire."` =  '$id_epreuve'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {           
            return mysql_fetch_array($res);
        }
        return false;
    }
    /**
     * Recherche une epreuve par type de nage
     * @param int $id_type_de_nage le type a rechercher
     * @return boolean | array,  false si l'epreuve n'a pas ete trouvee ou un tableau correspondant
     * a la ligne contenant le type
     */
    public static function rechercherParType($id_type_de_nage) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `idtype_de_nage` =  '$id_type_de_nage'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $epreuves = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $epreuves[] = $ligne;
            }
            return $epreuves;
        }
        return false;
    }

    /**
     * Recherche toutes les epreuves
     * @return boolean | array
     */
    public static function rechercherTout() {
        //Recuperer tous les types
        $res = mysql_query("SELECT * FROM `" . self::$table . "`") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $epreuves = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $epreuves[] = $ligne;
            }
            return $epreuves;
        }
        return false;
    }

}

