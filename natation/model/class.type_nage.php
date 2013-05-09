<?php

/**
 * Cette classe gere les types de nage (enregistrement, modification, suppression
 *  etc.)
 * @author kaba
 */
include_once '../include/connexion.php';

class type_nage {

    /**
     * Nom de la table dans la base de donnees
     * @var string 
     */
    private static $table = 'type_de_nage';

    /**
     * Nom de la colonne cle primaire de la table
     * @var string 
     */
    private static $cle_primaire = 'idtype_de_nage';

    function __construct() {
        
    }

    /**
     * Enregistre un type de nage s'il n'existe pas
     * @param string $type le type a enregistrer
     * @return boolean true si enregistrement ok
     * @throws Exception si le type existe deja
     */
    public static function enregistrer($type) {
        //Recherche si l'element a enregistrer existe dans la table courante
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `type` =  '$type'") or die(mysql_error());

        //Exception si le type existe 
        if (mysql_num_rows($res) != 0) {
            throw new Exception("Ce type existe deja");
        }
        //si le type n'existe pas on l'enregistre
        mysql_query("INSERT INTO `" . self::$table . "` (`type`) VALUES ('$type')") or die(mysql_error());
        return true;
    }

    /**
     * Modifie le type courant suivant l'id 
     * @param int $idtype_nage l'id du type
     * @param string $nouveau_type le nouveau type
     * @return boolean true si modification OK
     */
    public static function modifier($id_type_nage, $nouveau_type) {
        mysql_query("UPDATE `" . self::$table . "` SET `type` = '$nouveau_type' WHERE `" . self::$cle_primaire . "` = '$id_type_nage'") or die(mysql_error());
        return true;
    }

    /**
     * Supprime un type par son ID
     * @param int $id_type_nage
     */
    public static function supprimer($id_type_nage) {
        mysql_query("DELELE FROM `" . self::$table . "` WHERE `" . self::$cle_primaire . "` = $id_type_nage") or die(mysql_error());
        return true;
    }

   /**
     * Recherche un type de nage par son id
     * @param int $id_type_nage l'id du type de nage
     * @return boolean | array, false si aucun type correspondant n'a ete trouve, sinon retourne la ligne correspondante au type de nage
     */
    public static function rechercherParId($id_type_nage) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `".self::$cle_primaire."` =  '$id_type_nage'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            return mysql_fetch_array($res);
        }
        return false;
    }
    /**
     * Recherche par type de nage
     * @param string $type le type a rechercher
     * @return boolean | array,  false si le type n'a pas ete trouve ou tous les types de nage correspondant au type
     */
    public static function rechercherParType($type) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `type` LIKE  '%$type%'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $types = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $types[] = $ligne;
            }
            return $types;
        }
        return false;
    }

    /**
     * Recherche tous les types
     * @return boolean | array
     */
    public static function rechercherTout() {
        //Recuperer tous les types
        $res = mysql_query("SELECT * FROM `" . self::$table . "`") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $types = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $types[] = $ligne;
            }
            return $types;
        }
        return false;
    }

}

