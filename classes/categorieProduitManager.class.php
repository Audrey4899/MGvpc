<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categorieProduitManager
 *
 * @author etudiant
 */

require_once 'database.class.php';

class categorieProduitManager 
{
    private $db;
    
    public function __construct($database)
    {
        $this->db = $database;
    }
    
    public function save(categorieProduit $categProd)
    {
        $nbRows = 0;
        
        if($categProd->getId()!='') //Si la categ qu'on veut enregistrer a un id
        {
            $query = 'SELECT COUNT(*) AS nb FROM categorieproduit WHERE idCategorie = ?;'; //nb de lignes de cette categ
            $traitement = $this->db->prepare($query);
            $param1 = $categProd->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
        if ($nbRows > 0) //La categ existe déja : modification 
        {
            $query = "UPDATE categorieproduit SET nomCategorie = ? WHERE idCategorie = ?;";
            $traitement = $this->db->prepare($query);
            $param1 = $categProd->getNomCateg();
            $traitement->bindparam(1,$param1);
            $param2 = $categProd->getId();
            $traitement->bindparam(2,$param2);
            $traitement->execute();
        }
        
        else //La categ n'existe pas : ajout 
        {
            $query = "INSERT INTO categorieproduit (nomCategorie) VALUES (?);";
            $traitement = $this->db->prepare($query);
            $param1 = $categProd->getNomCateg();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
        }
        
        if ($categProd->getId() == "") //Si la categ n'a pas d'id
        {
            $categProd->setId($this->db->lastInsertId()); //On lui affecte le dernier id enregistré dans la table categorieproduit 
        }
        return $categProd->getId();
    }
    
    public function delete(categorieProduit $categProd)
    {
        $nbRows = 0;
        
        if($categProd->getId() != "") //Si la categ qu'on veut supprimer a un id
        {
            $query = "SELECT COUNT(*) AS nb FROM categorieproduit WHERE idCategorie = ?;"; //nb de lignes de cette categ
            $traitement = $this->db->prepare($query);
            $param1 = $categProd->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
        if ($nbRows > 0) //Si la categ existe : supprime
        {
            $query = "DELETE FROM categorieproduit WHERE idCategorie = ?;";
            $traitement = $this->db->prepare($query);
            $param1 = $categProd->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            return true;
        }
        else 
            return false;
    }
    
    public function getList($restriction='WHERE 1')
    {
        $query = "SELECT * FROM categorieproduit ".$restriction.";";
        $categProdList = Array();

        //execution de la requete
        try
        {
            $traitement = $this->db->Query($query);
        }
        catch(PDOException $e)
        {
            die ("Erreur : ".$e->getMessage());
        }

        //Parcours du jeu d'enregistrement
        $row = $traitement->fetch();
        while($row)
        {
            //appel du constructeur paramétré
            $categProd = new categorieProduit($row['nomCategorie']);
            //positionnement de l'id
            $categProd->setId($row['idCategorie']);
            //ajout de l'objet au tableau
            $categProdList[] = $categProd;
        }
        return $categProdList;
    }
    
    public function get($id)
    {
        $query = "SELECT * FROM categorieproduit WHERE idCategorie = ?;";
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
        $row = $traitement->fetch();
        if($row) 
        {
            //appel du constructeur paramétré
            $categProd = new categorieProduit($row['nomCategorie']);
            //positionnement de l'id
            $categProd->setId($row['idCategorie']);

            return $categProd;
        }
        else 
            return false;
    }
}
