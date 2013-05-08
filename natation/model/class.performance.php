<?php

/**
 * Gere la performance des joueurs (enregistrement, modification, suppression
 *  etc.)
 * @author kaba
 */
include_once '../include/connexion.php';
class performance {
    
    /**
     * Nom de la cle primaire de la table
     * @var string 
     */
    private $cle_primaire = 'idperformance';
    /**
     * Nom de la table
     * @var string 
     */
    private $table = 'performance';
    /**
     * Le nombre de points
     * @var int 
     */
    private $points;
    /**
     * Le temps (chrono)
     * @var string
     */
    private $temps;
    /**
     * L'id du nageur
     * @var int 
     */
    private $id_nageur;
    /**
     * L'id de l'epreuve
     * @var int 
     */
    private $id_epreuve;
            
    function __construct($points, $temps, $id_nageur, $id_epreuve) {
        $this->points = $points;
        $this->temps = $temps;
        $this->id_nageur = $id_nageur;
        $this->id_epreuve = $id_epreuve;
    }
    
    /**
     * 
     * @return boolean
     * @throws Exception
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
}

