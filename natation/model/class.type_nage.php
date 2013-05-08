<?php

/**
 * Cette classe gere les types de nage (enregistrement, modification, suppression
 *  etc.)
 * @author kaba
 */
include_once '../include/connexion.php';

class type_nage {

    /**
     * Le type de nage
     * @var string
     */
    private $type;
    /**
     * Nom de la table dans la base de donnees
     * @var string 
     */
    private $table = 'type_de_nage';
    /**
     * Nom de la cle primaire de la table
     * @var string 
     */
    private $cle_primaire = 'id_type_de_nage';

    function __construct($type) {
        $this->type = $type;
    }

    /**
     * Enregistre un type de nage s'il n'existe pas
     * @param string $type le type a enregistrer
     * @return boolean true si enregistrement ok
     * @throws Exception si le type existe deja
     */
    public function enregistrer() {
        //Recherche si l'element a enregistrer existe dans la table courante
        $res = mysql_query("SELECT * FROM `$this->table` WHERE `type` =  '$this->type'") or die(mysql_error());
        
        //Exception si le type existe 
        if (mysql_num_rows($res) != 0) {
            throw new Exception("Ce type existe deja");
        }
        //si le type n'existe pas on l'enregistre
        mysql_query("INSERT INTO `$this->table` (`type`) VALUES ('$this->type')") or die(mysql_error());
        return true;
    }
    /**
     * Modifie le type courant
     * @param string $nouveau_type le nouveau type
     * @return boolean true si modification OK
     */
    public function modifier($nouveau_type){
        mysql_query("UPDATE `$this->table` SET `type` = '$nouveau_type' WHERE `type` = '$this->type'") or die(mysql_error());
        return true;
    }

    /**
     * Supprime un type par son ID
     * @param int $idType
     */
    public static function  supprimerParId($idType){
        mysql_query("DELELE FROM `$this->type` WHERE `$this->cle_primaire` = $idType") or die(mysql_error());
        return true;
    }
}

