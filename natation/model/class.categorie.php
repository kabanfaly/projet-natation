<?php
/**
 * Cette classe gere les categories maitres (enregistrement, modification, suppression
 *  etc.)
 *
 * @author kaba
 */
if (file_exists('../include/connexion.php')) {
    include_once '../include/connexion.php';
} else {
    include_once 'include/connexion.php';
}

class categorie {

    /**
     * Nom de la table dans la base de donnees
     * @var string 
     */
    private static $table = 'categorie';

    /**
     * Nom de la colonne cle primaire de la table
     * @var string 
     */
    private static $cle_primaire = 'idcategorie';

    function __construct() {
    }

    /**
     * Enregistre une categorie de maitre s'il n'existe pas
     * @param string $categorie  la categorie a enregistrer
     * @param string $description  la description a annuler
     * @return boolean true si enregistrement ok
     * @throws Exception si le type existe deja
     */
    public static function enregistrer($categorie, $description) {
        //Recherche si l'element a enregistrer existe dans la table courante
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `categorie` =  '$categorie'") or die(mysql_error());

        //Exception si la categorie existe 
        if (mysql_num_rows($res) != 0) {
            throw new Exception("Cette categorie existe deja");
        }
        //si le type n'existe pas on l'enregistre
        mysql_query("INSERT INTO `" . self::$table . "` (`categorie`, `description`) VALUES ('$categorie', '$description')") or die(mysql_error());
        return true;
    }

    /**
     * Modifie la categorie courant suivant l'id 
     * @param int $idtype_nage l'id du type
     * @param string $nouvelle_categorie la  nouvelle categorie
     * @param string $nouvelle_description la  nouvelle description
     * @return boolean true si modification OK
     */
    public static function modifier($id_categorie, $nouvelle_categorie, $nouvelle_description) {
        mysql_query("UPDATE `" . self::$table . "` SET `categorie` = '$nouvelle_categorie', `description` = '$nouvelle_description' WHERE `" . self::$cle_primaire . "` = '$id_categorie'") or die(mysql_error());
        return true;
    }

    /**
     * Supprime une categorie par son ID
     * @param int $id_categorie
     */
    public static function supprimer($id_categorie) {
        mysql_query("DELETE FROM `" . self::$table . "` WHERE `" . self::$cle_primaire . "` = $id_categorie") or die(mysql_error());
        return true;
    }

   /**
     * Recherche une categorie de maitre par son id
     * @param int $id_categorie l'id de la categorie de maitre
     * @return boolean | array, false si aucune categorie correspondante n'a ete trouvée, sinon retourne la ligne correspondante à la categorie de maitre
     */
    public static function rechercherParId($id_categorie) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `".self::$cle_primaire."` =  '$id_categorie'") or die(mysql_error());        
        if (mysql_num_rows($res) != 0) {
            return mysql_fetch_array($res);
        }
        
        return false;
    }
    /**
     * Recherche par  categorie de maitre
     * @param string $categorie la categorie à rechercher
     * @return boolean | array,  false si la categorie n'a pas ete trouvée ou toutes les categories de maitre correspondant à la categorie de maitre
     */
    public static function rechercherParCategorie($categorie) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `categorie` LIKE  '%$categorie%'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $categories = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $categories[] = $ligne;
            }
            return $categories;
        }
        return false;
    }

    /**
     * Recherche toutes les categories
     * @return boolean | array
     */
    public static function rechercherTout() {
        //Recuperer toutes les categories
        $res = mysql_query("SELECT * FROM `" . self::$table . "`") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $categories = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $categories[] = $ligne;
            }
            return $categories;
        }
        return false;
    }

}



