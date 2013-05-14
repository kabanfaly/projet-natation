<?php
/**
 * Cette classe gere les competitions (enregistrement, modification, suppression
 *  etc.)
 *
 * @author kaba
 */
if (file_exists('../include/connexion.php')) {
    include_once '../include/connexion.php';
} else {
    include_once 'include/connexion.php';
}

class competition {

    /**
     * Nom de la colonne cle primaire de la table
     * @var string 
     */
    private static $cle_primaire = 'idcompetition';

    /**
     * Nom de la table
     * @var string 
     */
    private static $table = 'competition';


    function __construct() {
    }

    /**
     * Ajoute une nouvelle competition
     * @return boolean
     * @throws Exception
     */
    public static function enregistrer($annee, $idcategorie_maitre, $id_nageur, $id_epreuve) {
        // Rechercher la competition si elle existe
        $res =  mysql_query("SELECT * FROM `".self::$table."` WHERE `annee` =  '$annee' AND `idcategorie_maitre` = '$idcategorie_maitre' AND "
                . "`idnageur` = '$id_nageur' AND `idepreuve` = '$id_epreuve' ") or die(mysql_error());
        if(mysql_numrows($res) != 0){
            throw new Exception('Cette competition existe deja');
        }
        mysql_query("INSERT INTO `".self::$table."` (`annee`, `idcategorie_maitre`, `idnageur`, `idepreuve`) VALUES "
                        . "('$annee', '$idcategorie_maitre', '$id_nageur', '$id_epreuve')") or die(mysql_error());
        return true;
    }

    /**
     * Modification d'une competition suivant l'id
     * @param int $id_competition
     * @param int $annee
     * @param int $idcategorie_maitre
     * @param int $id_nageur
     * @param int $id_epreuve
     * @return boolean
     */
    public static function modifier($id_competition, $annee, $idcategorie_maitre, $id_nageur, $id_epreuve) {
        mysql_query("UPDATE `".self::$table."` SET `annee` = '$annee', `idcategorie_maitre` = '$idcategorie_maitre', `idnageur` = '$id_nageur', `idepreuve` = '$id_epreuve'"
                        . " WHERE `".self::$cle_primaire."` = '$id_competition'") or die(mysql_error());
        return true;
    }

    /**
     * Supprime une competition
     * @param type $id_competition
     */
    public static function supprimer($id_competition) {
        mysql_query("DELETE FROM `".self::$table."` WHERE `".self::$cle_primaire."` = $id_competition") or die(mysql_error());
        return true;
    }

    /**
     * Recherche les competitions  par son id
     * @param int $id_competition l'id de la performance
     * @return boolean | array, false si aucune competition correspondante n'a ete trouvee, sinon retourne la ligne correspondante
     * a la competition
     */
    public static function rechercherParId($id_competition) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `".self::$cle_primaire."` =  '$id_competition'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {           
            return mysql_fetch_array($res);
        }
        return false;
    }
    /**
     * Recherche les competitions d'un nageur
     * @param int $id_nageur l'id du nageur
     * @return boolean | array, false si aucune performance correspondante n'a ete trouvee, sinon retourne les competitions du nageur 
     * dans un tableau
     */
    public static function rechercherParNageur($id_nageur) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `idnageur` =  '$id_nageur'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $competitions = array();
            //Recuperer toutes les lignes trouvées
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $competitions[] = $ligne;
            }
            return $competitions;
        }
        return false;
    }
    /**
     * Recherche les competitions d'une categorie
     * @param int $id_categorie_maitre l'id de categorie_maitre
     * @return boolean | array, false si aucune competition correspondante n'a ete trouvee, sinon retourne les competitions de la categorie_maitre
     * dans un tableau
     */
    public static function rechercherParcategorieMaitre($idcategorie_maitre) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `$idcategorie_maitre` =  '$idcategorie_maitre'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $competitions = array();
            //Recuperer toutes les lignes trouvées
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $competitions[] = $ligne;
            }
            return $competitions;
        }
        return false;
    }
    
    /**
     * Recherche les competitions d'une epreuve
     * @param int $idepreuve l'id de l'epreuve
     * @return boolean | array, false si aucune competition correspondante n'a ete trouvee, sinon retourne les competitions du nageur 
     * dans un tableau
     */
    public static function rechercherParEpreuve($idepreuve) {
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `idepreuve` =  '$idepreuve'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $competitions = array();
            //Recuperer toutes les lignes trouves
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $competitions[] = $ligne;
            }
            return $competitions;
        }
        return false;
    }
    /**
     * Recherche les competitions d'un nageur pour une epreuve donnee
     * @param int $idnageur l'id du nageur
     * @param int $idepreuve l'id de l'epreuve
     * @return boolean | array, false si aucune competitioncorrespondante n'a ete trouvee suivant l'epreuve, sinon retourne les competitions du nageur 
     * dans un tableau
     */
    public static function rechercherParNageurEpreuve($idnageur, $idepreuve){
        $res = mysql_query("SELECT * FROM `".self::$table."` WHERE `idnageur` =  '$idnageur' AND `idepreuve` =  '$idepreuve'") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $competitions = array();
            //Recuperer toutes les lignes trouves
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $competitions[] = $ligne;
            }
            return $competitions;
        }
        return false;
    }
    
    /**
     * Recherche toutes les competitions
     * @return boolean | array
     */
    public static function rechercherTout(){
         //Recuperer toutes les competitions
        $res = mysql_query("SELECT * FROM `".self::$table."`") or die(mysql_error());
        if (mysql_num_rows($res) != 0) {
            $competitions = array();
            //Recuperer toutes les lignes trouvees
            while (($ligne = mysql_fetch_array($res)) !== FALSE) {
                $competitions[] = $ligne;
            }
            return $competitions;
        }
        return false;
    }
}


