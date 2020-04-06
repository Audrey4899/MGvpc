<?php
require_once ("database.class.php");
require_once 'procedureSAV.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of procedureSAVManager
 *
 * @author etudiant
 */
class procedureSAVManager
{
    private $db;
    
    public function __construct($database)
    {
        $this->db = $database;
    }
    
    public function save(procedureSAV $procSAV)
    {
        $nbRows = 0;
        
        if ($procSAV->getId() != '')
        {
            $query = "SELECT COUNT(*) AS nb FROM proceduresav WHERE idProcedure = ?;";
            $traitement = $this->db->prepare($query);
            $param1=$procSAV->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        // Si le secteur que nous essayons de sauvegarder existe dans la base de données : UPDATE
        if ($nbRows > 0)
        {
            $query = "UPDATE proceduresav SET libelleProcedure = ? WHERE idProcedure = ?;";
            $traitement = $this->db->prepare($query);
            $param1=$procSAV->getNomProc();
            $traitement->bindparam(1,$param1);
            $param2=$procSAV->getId();
            $traitement->bindparam(2,$param2);
            $traitement->execute();
        }
        
        else
        {
            $query = "INSERT INTO proceduresav (libelleProcedure) values (?);";
            $traitement = $this->db->prepare($query);
            $param1=$procSAV->getNomProc();
            $traitement->bindparam(1,$param1);         
            $traitement->execute();
        }
        
        if ($procSAV->getId() == "")
        {
            $procSAV->setId($this->db->lastInsertId());
        }
        return $procSAV->getId();
    }
    
    public function  delete(procedureSAV $procSAV)
    {
        $nbRows = 0;
        
        if ($procSAV->getId() != ''){                    
            $query = "SELECT COUNT(*) AS nb FROM proceduresav WHERE idProcedure = ?;";
            $traitement = $this->db->prepare($query);
            $param1 = $procSAV->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
        if ($nbRows > 0)
        {            
            $query = "DELETE FROM proceduresav WHERE idProcedure = ?;";
            $traitement = $this->db->prepare($query);
            $param1 = $procSAV->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            return TRUE;
        }
        else
            return FALSE;
    }
    
    public function getList($restriction='WHERE 1')
    {
        $query = "SELECT * FROM proceduresav ".$restriction.";";
        $procSAVList = Array();

        //execution de la requete
        try
        {
            $result = $this->db->Query($query);
        }
        catch(PDOException $e)
        {
            die ("Erreur : ".$e->getMessage());
        }
        
        //Parcours du jeu d'enregistrement
        while ($row = $result->fetch())
        {
            //appel du constructeur paramétré
            $procSAV = new procedureSAV($row['libelleProcedure']);
            //positionnement de l'id
            $procSAV->setId($row['idProcedure']);
            //ajout de l'objet à la fin du tableau
            $procSAVList[] = $procSAV;
        }
        //retourne le tableau d'objets 'client'
        return $procSAVList;
    }
    
    public function get($id)
    {
        $query = "SELECT * FROM proceduresav WHERE idProcedure = ?;";

        //Connection et execution de la requete
        try
        {
            $traitement = $this->db->prepare($query);
            $traitement->bindparam(1,$id);
            $traitement->execute();
        }
        catch(PDOException $e)
        {
            die ("Erreur : ".$e->getMessage());
        }
        
        //On récupère la première et seule ligne du jeu d'enregistrement	
        if($row = $traitement->fetch()) 
        {
            //appel du constructeur paramétré
            $procSAV = new procedureSAV($row['libelleProcedure']);
            //positionnement de l'id
            $procSAV->setId($row['idProcedure']);

            return $procSAV;
        }
        else 
            return false;
    }
}
