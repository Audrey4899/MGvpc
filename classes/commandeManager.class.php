<?php
require_once ("database.class.php");

/**
 * Classe d'accès aux données concernant les clients.
 * 
 * @author Ben
 */
class commandeManager {
    
    private $db;
    
    /**
     * Instancie un objet commandeManager.
     * 
     * Permet d'instanicer un objet clommandeManager qui nous permettra ensuite d'accéder aux données de la base spécifiée en paramètre.
     *  
     * @param database Instance de la classe database.
     */    
    public function __construct($database)
    {
        //Dès le constructeur du manager on récupère la connection
        // à la base de données défini dans la classe database
        $this->db=$database;
    }    
    
    /**
     * Enregistre ou Modifie la commande dans la base.
     * 
     * Pour enregistrer la commande passée en paramètre dans la base de données :
     *      <br>UPDATE si la commande est déjà existante;
     *      <br>INSERT sinon (si num non trouvé ou non spécifié).
     * 
     * @param commande Commande à enregister ou mettre à jour.
     * 
     * @return int Retourne le numéro de la commande ajoutée ou mise à jour.
     */
    public function save(commande $cde)
    {        
        $nbRows = 0;

        // la commande que nous essayons de sauvegarder existe-t-elle dans la  base de données ?
        if ($cde->getNum()!=''){
            $query = "SELECT COUNT(*) AS nb FROM `commande` WHERE `idCommande`= ?";
            $traitement = $this->db->prepare($query);
            $param1=$cde->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
        // Si la commande que nous sauvegardons existe dans la bd : UPDATE
        if ($nbRows > 0)
        {
            //Supression des tuples existant dans contenir
            $query = "DELETE FROM contenir WHERE idCommande=?;";
            $traitement = $this->db->prepare($query);
            $param1 = $cde->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            
            //On récupère les tableaux de produits et de quantités de la cde
            $tabProd = $cde->getProduits();
            $tabQte = $cde->getQuantites();
            
            //parcours du tableau de produits et insertion des tuples dans comporter
            foreach ($tabProd as $prod) {
                $query = "INSERT INTO `contenir` (idProduit, idCommande, quantite) values (?,?,?);";
                $traitement = $this->db->prepare($query);
                $param1=$prod->getId();
                $traitement->bindparam(1,$param1);
                $param2=$cde->getNum();
                $traitement->bindparam(2,$param2);
                $param3=$tabQte[$prod->getId()];
                $traitement->bindparam(3,$param3);            
                $traitement->execute();
            }

            //Mis à jour de la table commande
            $query = "UPDATE `commande` SET `dateCommande`=?, `etatCommande`=?, `idClient`=? WHERE `idCommande`=?;";
            $traitement = $this->db->prepare($query);
            $param1=$cde->getDate();
            $traitement->bindparam(1,$param1);
            $param2=$cde->getEtat();
            $traitement->bindparam(2,$param2);
            $param3=$cde->getClient()->getId();
            $traitement->bindparam(3,$param3);
            $param4=$cde->getNum();
            $traitement->bindparam(4,$param4);
            $traitement->execute();
        }
        // sinon nouvelle commande : INSERT
        else
        {
            $query = "INSERT INTO `commande` (`dateCommande`, `etatCommande`,`idClient`) VALUES (?,?,?);";
            $traitement = $this->db->prepare($query);
            $param1=$cde->getDate();
            $traitement->bindparam(1,$param1);
            $param2=$cde->getEtat();
            $traitement->bindparam(2,$param2);
            $param3=$cde->getClient()->getId();
            $traitement->bindparam(3,$param3);            
            $traitement->execute();
            //var_dump($traitement);
            
            $cde->setNum($this->db->lastInsertId());
            
            //On récupère les tableaux de produits et de quantités de la cde
            $tabProd = $cde->getProduits();
            $tabQte = $cde->getQuantites();
            
            //parcours du tableau de produits et insertion des tuples dans contenir
            foreach ($tabProd as $prod) {                
                $query = "INSERT INTO `contenir` (`idProduit`, `idCommande`, `quantite`) VALUES (?,?,?);";
                $traitement = $this->db->prepare($query);
                $param1=$prod->getId();
                $traitement->bindparam(1,$param1);
                $param2=$cde->getNum();
                $traitement->bindparam(2,$param2);
                $param3=$tabQte[$prod->getId()];
                $traitement->bindparam(3,$param3);            
                $traitement->execute();
            }            
        }
        
        if ($cde->getNum() == "")
        {
            $cde->setNum($this->db->lastInsertId());
        }
        return $cde->getNum();
    }
    /**
     * Supprime la commande de la base.
     * 
     * Supprime de la base la commande passée en paramètre. Seront aussi suppprimées les lignes de commandes (table "comporter") associées à cette commande.
     * 
     * @param commande Objet commande devant être supprimé.
     * @return boolean Retourne true si la suppression est un succès, false sinon.
     */
    public function delete(commande $cde)
    {
        $nbRows = 0;

        // la commande que nous essayons de supprimer existe-t-elle dans la  bd ?
        if ($cde->getNum()!=''){                    
            $query = "select count(*) as nb from `commande` where `idCommande`=?";
            $traitement = $this->db->prepare($query);
            $param1 = $cde->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        // SI la commande que nous essayons de supprimer existe dans bd
        // ALORS
        //      DELETE FROM comporter, commande
        //          et retourne TRUE
        if ($nbRows > 0)
        {
            // DELETE FROM comporter
            $query = "DELETE FROM contenir WHERE idCommande=?;";
            $traitement = $this->db->prepare($query);
            $param1 = $cde->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            
            // DELETE FROM commande
            $query = "DELETE FROM commande WHERE idCommande=?;";
            $traitement = $this->db->prepare($query);
            $param1 = $cde->getNum();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            
            return true;
        }
        // SINON
        //      retourne FALSE
        else {
            return false;
        }
    }
    
    /**
     * Sélectionne un(des) commande(s) dans la base.
     * 
     * Méthode générique de SELECT qui renvoie un tableau de commande correspondant aux critères de sélection spécifiés.
     * Si aucun paramètre n'est précisé, la valeur par défaut du paramètre 'WHERE 1' permet d'obtenir toutes les commandes.
     * 
     * @param string Chaîne de caractère devant être une restriction SQL valide.
     * @return array Renvoie un tableau d'objet(s) commande.
     */
    public function getList($restriction='WHERE 1')
    {
        $query = "SELECT * FROM `commande` ".$restriction.";";
        $cdeList = Array();

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
        //Chaque ligne comporte les colonnes numCde, dateCde, etatCde et idCliCde
        while ($row = $result->fetch())
        {
            //appel du constructeur paramétré avec le client correspondant à l'id de la base de données
            $managerCli = new clientManager(database::getDB());
            $commande = new commande($managerCli->get($row['idClient']));

            //positionnement des valeurs dans les attributs
            $commande->setNum($row['idCommande']);
            $commande->setDate($row['dateCommande']);
            $commande->setEtat($row['etatCommande']);

            //parcours de la table comporter pour trouver le contenu de la commande
            $queryContenir = "SELECT * FROM `contenir` WHERE idCommande='".$row['idCommande']."'";
            try
            {
                $resultContenir = $this->db->Query($queryContenir);
            }
            catch(PDOException $e)
            {
                die ("Erreur : ".$e->getMessage());
            }

            //Parcours du jeu d'enregistrement de comporter
            //Chaque ligne comporte les colonnes numCde, idProd et qte
            while ($rowContenir = $resultContenir->fetch())
            {
                //On instancie un objet produit
                $managerProd = new produitManager(database::getDB());
                $produit = $managerProd->get($rowContenir['idProduit']);
                $commande->addProduitQte($produit,$rowContenir['quantite']);
            }

            //ajout de l'objet commande bien rempli à la fin du tableau
            $cdeList[] = $commande;
        }
        //retourne le tableau d'objets 'commande'
        return $cdeList;   
    }
    
    /**
     * Sélectionne une commande dans la base.
     * 
     * Méthode de SELECT qui renvoie la commande dont le numéro est spécifié en paramètre.
     * 
     * @param int Numéro de la commande recherchée
     * @return produit|boolean Renvoie la commande recherchée ou FALSE si elle n'a pas été trouvée
     */
    public function get($num)
    {
        $query = "select * from `commande` WHERE `idCommande`=?;";

        //Connection et execution de la requete
        try
        {
            $traitement = $this->db->prepare($query);
            $traitement->bindparam(1,$num);
            $traitement->execute();
        }
        catch(PDOException $e)
        {
            die ("Erreur : ".$e->getMessage());
        }

        //On récupère la première et seule ligne du jeu d'enregistrement	
        if ($row = $traitement->fetch()) {        
            //appel du constructeur paramétré avec le client correspondant à l'id de la base de données
            $managerCli = new clientManager(database::getDB());
            $commande = new commande($managerCli->get($row['idClient']));

            //positionnement des valeurs dans les attributs
            $commande->setNum($row['idCommande']);
            $commande->setDate($row['dateCommande']);
            $commande->setEtat($row['etatCommande']);

            //parcours de la table comporter pour trouver le contenu de la commande
            $queryContenir = "SELECT * FROM contenir WHERE idCommande='".$num."'";
            try
            {
                $resultContenir = $this->db->Query($queryContenir);
            }
            catch(PDOException $e)
            {
                die ("Erreur : ".$e->getMessage());
            }

            //Parcours du jeu d'enregistrement de comporter
            //Chaque ligne comporte les colonnes numCde, idProd et qte
            while ($rowContenir = $resultContenir->fetch())
            {
                //On instancie un objet produit
                $managerProd = new produitManager(database::getDB());
                $produit = $managerProd->get($rowContenir['idProduit']);
                $commande->addProduitQte($produit,$rowContenir['quantite']);
            }
            //retourne l'objet 'commande' correpsondant
            return $commande;
        }
        else {
            return false;
        }
    }

    /**
     * Sélectionne les commandes du client passé en paramètre dans la base.
     * 
     * Méthode qui renvoie un tableau de commande correspondant au client.
     * 
     * @param client Client dont on cherche les commandes.
     */
    public function getCdesClient(client $client)
    {
        $tabCde = $this->getList();
        
        foreach ($tabCde as $cde)
        {            
            if ($client->getId()==$cde->getClient()->getId()) {
                $cdeList[] = $cde;
            }            
        }
        //retourne le tableau d'objets 'commande'
        return $cdeList;   
    }
    
}