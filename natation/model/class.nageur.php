<?php

/**
 * Cette classe gere les nageurs (enregistrement, modification, suppression
 *  etc.)
 *
 * @author kaba
 */
if (file_exists('../include/connexion.php')) {
    include_once '../include/connexion.php';
} else {
    include_once 'include/connexion.php';
}

class nageur {

    /**
     * Nom de la table dans la base de donnees
     * @var string 
     */
    private static $table = 'nageur';

    /**
     * Nom de la colonne cle primaire de la table
     * @var string 
     */
    private static $cle_primaire = 'idnageur';

    function __construct() {
        
    }

    /**
     * Enregistre un nageur s'il n'existe pas
     * @param string $nom le nom du nageur
     * @param string $prenom le prenom du nageur
     * @param string $date_naissance la date de naissance du nageur
     * @param string $sexe le sexe du nageur
     * @param int $idcategorie le groupe du nageur
     * @return boolean si le nageur a ete enregistre
     * @throws Exception si le nageur n'existe pas
     */
    public static function enregistrer($nom, $prenom, $date_naissance, $sexe, $idcategorie) {
        //Recherche si l'element a enregistrer existe dans la table courante
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `nom` =  '$nom' AND `prenom` = '$prenom' AND "
                . "`date_de_naissance` = '$date_naissance' AND `sexe` = '$sexe' AND `idcategorie` = '$idcategorie'") or die(mysql_error());        
        //Exception si le nageur existe 
        if (mysql_num_rows($res) != 0) {
            throw new Exception("Ce nageur existe déjà");
        }
        //si le nageur n'existe pas on l'enregistre
        mysql_query("INSERT INTO `" . self::$table . "` (`nom`,`prenom`,`date_de_naissance`,`sexe`,`idcategorie`) VALUES "
                        . "('$nom', '$prenom', '$date_naissance', '$sexe', '$idcategorie')") or die(mysql_error());
        return true;
    }

    /**
     * Modifie un nageur
     * @param int $id_nageur l'id du nageur
     * @param string $nom le nom du nageur
     * @param string $prenom le prenom du nageur
     * @param string $date_naissance la date de naissance du nageur
     * @param string $sexe le sexe du nageur
     * @param int $idcategorie la categorie
     * @return boolean true si la modification est OK
     */
    public static function modifier($id_nageur, $nom, $prenom, $date_naissance, $sexe, $idcategorie) {
        mysql_query("UPDATE `" . self::$table . "` SET `nom` = '$nom', `prenom` = '$prenom', `date_de_naissance` = '$date_naissance', "
                        . " `sexe` = '$sexe', `idcategorie` = '$idcategorie' WHERE `" . self::$cle_primaire . "` = '$id_nageur'") or die(mysql_error());
        return true;
    }

    /**
     * Supprime un nageur par son ID
     * @param int $id_nageur l'id du nageur
     */
    public static function supprimer($id_nageur) {
        mysql_query("DELETE FROM `" . self::$table . "` WHERE `" . self::$cle_primaire . "` = $id_nageur") or die(mysql_error());
        return true;
    }

    /**
     * Recherche un nageur par son id
     * @param int $id_nageur l'id du nageur
     * @return boolean | array, false si aucun nageur correspondant n'a ete trouve, sinon retourne la ligne correspondant au nageur
     */
    public static function rechercherParId($id_nageur) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `" . self::$cle_primaire . "` =  '$id_nageur'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            return mysql_fetch_array($res);
        }
        return false;
    }

    /**
     * Recherche par nom
     * @param string $nom le nom a rechercher
     * @return boolean | array,  false si aucun nageur n'a ete trouve, sinon retourne tous les nageurs correspondant au nom 
     * 
     */
    public static function rechercherParNom($nom) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `nom` LIKE  '%$nom%'") or die(mysql_error());
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
     * Recherche par prenom
     * @param string $prenom le prenom a rechercher
     * @return boolean | array,  false si aucun nageur n'a ete trouve, sinon retourne tous les nageurs correspondant au prenom 
     * 
     */
    public static function rechercherParPrenom($prenom) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `prenom` LIKE  '%$prenom%'") or die(mysql_error());
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
     * Recherche par groupe
     * @param int $idcategorie la categorie
     * @return boolean | array,  false si aucun nageur n'a ete trouve, sinon retourne tous les nageurs correspondant au groupe 
     * 
     */
    public static function rechercherParCategorie($idcategorie) {
        $res = mysql_query("SELECT * FROM `" . self::$table . "` WHERE `idcategorie` = '$idcategorie'") or die(mysql_error());
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
     * Recherche tous les nageurs
     * @return boolean | array
     */
    public static function rechercherTout() {
        //Recuperer tous les nageurs
        $res = mysql_query("SELECT * FROM `" . self::$table . "`") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $nageurs = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $nageurs[] = $ligne;
            }
            return $nageurs;
        }
        return false;
    }

}

