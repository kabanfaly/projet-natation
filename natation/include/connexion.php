<?php

/*
 * Definie la connexion a la base de donnees
 * 
 */
//Se connecter si on est pas deja connecte
if(!defined('CONNEXION')){
    //Ouverture de la connexion
    define('CONNEXION', mysql_connect('localhost', 'root', 'kabamysql'));
    
    //Si connexion invalide : affiche le message d'erreur
    if(CONNEXION === FALSE){
        die (mysql_error());
    }else{
        //Selection de la base de donnees
        mysql_select_db('natation');
    }
}
