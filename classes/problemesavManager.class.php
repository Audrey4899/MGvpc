<?php
require_once ("database.class.php");

/**
 * Classe d'accès aux données concernant les employes.
 * 
 * <br>TESTS :  OK
 * <br>DOC :    OK
 *
 * @author boca
 */
class problemeSAVManager {
    
    private $db;
    
    /**
     * Instancie un objet problemesavManager.
     * 
     * Permet d'instanicer un objet problemesavManager qui nous permettra ensuite d'accéder aux données de la base spécifiée en paramètre.
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
     * Enregistre ou Modifie le probleme dans la base.
     * 
     * Pour enregistrer le probleme passé en paramètre en base de données :
     *      <br>UPDATE si le probleme est déjà existant;
     *      <br>INSERT sinon (si id non trouvé ou non spécifié).
     * 
     * @param employe Employe à enregister ou mettre à jour.
     * 
     * @return int Retourne l'id de l'employe ajouté ou mis à jour.
     */
    public function save(problemesav $probleme)
    {        
        $nbRows = 0;

        // le secteur que nous essayons de sauvegarder existe-t-il dans la  base de données ?
        if ($probleme->getId()!=''){
            $query = "SELECT COUNT(*) AS nb FROM problemesav WHERE idProblemeSAV = ?;";
            $traitement = $this->db->prepare($query);
            $param1=$probleme->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
        // Si le secteur que nous essayons de sauvegarder existe dans la base de données : UPDATE
        if ($nbRows > 0)
        {
            $query = "UPDATE problemesav SET titreProblemeSAV = ?, descProblemeSAV = ?, dateProblemeSAV = ?, etatProblemeSAV = ?, montantProcedure = ?, idEmploye = ?, idClient = ?"
                    . ", idProcedure = ?, idProduit = ? WHERE idProblemeSAV = ?;";
            $traitement = $this->db->prepare($query);
            $param1=$probleme->getTitre();
            $traitement->bindparam(1,$param1);
            $param2=$probleme->getDesc();
            $traitement->bindparam(2,$param2);
            $param3=$probleme->getDate();
            $traitement->bindparam(3,$param3);
            $param4=$probleme->getEtat();
            $traitement->bindparam(4,$param4);
            $param5=$probleme->getMontant();
            $traitement->bindparam(5,$param5);
            $param6=$probleme->getEmploye()->getId();
            $traitement->bindparam(6,$param6);
            $param7=$probleme->getClient()->getId();
            $traitement->bindparam(7,$param7);
            $param8=$probleme->getProcedure()->getId();
            $traitement->bindparam(8,$param8);
            $param9=$probleme->getProduit()->getId();
            $traitement->bindparam(9,$param9);
            $param10=$probleme->getId();
            $traitement->bindparam(10,$param10);
            $traitement->execute();
        }
        // sinon : INSERT
        else
        {
            $query = "INSERT INTO problemesav (titreProblemeSAV, descProblemeSAV, dateProblemeSAV, etatProblemeSAV, montantProcedure, idEmploye, idClient, idProcedure, idProduit) VALUES (?,?,?,?,?,?,?,?,?);";
            $traitement = $this->db->prepare($query);
            $param1=$probleme->getTitre();
            $traitement->bindparam(1,$param1);
            $param2=$probleme->getDesc();
            $traitement->bindparam(2,$param2);
            $param3=$probleme->getDate();
            $traitement->bindparam(3,$param3);
            $param4=$probleme->getEtat();
            $traitement->bindparam(4,$param4);
            $param5=$probleme->getMontant();
            $traitement->bindparam(5,$param5);
            $param6=$probleme->getEmploye()->getId();
            $traitement->bindparam(6,$param6);
            $param7=$probleme->getClient()->getId();
            $traitement->bindparam(7,$param7);
            $param8=$probleme->getProcedure()->getId();
            $traitement->bindparam(8,$param8);
            $param9=$probleme->getProduit()->getId();
            $traitement->bindparam(9,$param9);
            $traitement->execute();
        }
        if ($probleme->getId() == "")
        {
            $probleme->setId($this->db->lastInsertId());
        }
        return $probleme->getId();
    }

    /**
     * Supprime le probleme de la base.
     * 
     * Supprime le probleme de la base et les lignes de commandes associées de la table "comporter".
     * 
     * @param problemesav probleme devant être supprimé.
     * @return boolean Retourne true si la suppression est un succès, false sinon.
     */
    public function delete(problemesav $probleme) //Voir avec la table Gerer
    {
        $nbRows = 0;

        // le probleme que nous essayons de supprimer existe-t-il dans la  base de données ?
        if ($probleme->getId()!=''){                    
            $query = "SELECT COUNT(*) AS nb FROM problemesav WHERE idProblemeSAV = ?";
            $traitement = $this->db->prepare($query);
            $param1 = $probleme->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }

        // SI le probleme que nous essayons de supprimer existe dans bd
        // ALORS
        //      DELETE FROM problemesav
        //          et retourne TRUE
        if ($nbRows > 0)
        {
            
            // DELETE FROM problemesav
            $query = "DELETE FROM problemesav WHERE idProblemeSAV = ?";
            $traitement = $this->db->prepare($query);
            $param1 = $probleme->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();            
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Sélectionne un(des) probleme(s) dans la base.
     * 
     * Méthode générique de SELECT qui renvoie un tableau de problemes correspondant aux critères de sélection spécifiés.
     * Si aucun paramètre n'est précisé, la valeur par défaut du paramètre 'WHERE 1' permet d'obtenir tous les problemes.
     * 
     * @param string Chaîne de caractère devant être une restriction SQL valide.
     * @return array Renvoie un tableau d'objet(s) probleme.
     */
    public function getList($restriction='WHERE 1')
    {
        $query = "SELECT * FROM problemesav ".$restriction.";";
        $problemeList = Array();

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
            $managerCli = new clientManager(database::getDB());
            $managerProc = new procedureSAVManager(database::getDB());
            $managerProd = new produitManager(database::getDB());
            $managerEmploye = new employeManager(database::getDB());
            
            //appel du constructeur paramétré
            $cli = $managerCli->get($row['idClient']);
            $proc = $managerProc->get($row['idProcedure']);
            $prod = $managerProd->get($row['idProduit']);
            $empl = $managerEmploye->get($row['idEmploye']);
            
            $probleme = new problemesav($row['titreProblemeSAV'],$row['descProblemeSAV'],$row['montantProcedure'], $empl, $cli, $proc, $prod);
            //Positionnement de l'id
            $probleme->setId($row['idProblemeSAV']);
            $probleme->setDate($row['dateProblemeSAV']);
            $probleme->setEtat($row['etatProblemeSAV']);
            //ajout de l'objet à la fin du tableau
            $problemeList[] = $probleme;
        }
        //retourne le tableau d'objets 'probleme'
        return $problemeList;   
    }
    
    /**
     * Sélectionne un probleme dans la base.
     * 
     * Méthode de SELECT qui renvoie le probleme dont l'id est spécifié en paramètre.
     * 
     * @param int ID du probleme recherché
     * @return probleme|boolean Renvoie l'objet probleme recherché ou FALSE s'il n'a pas été trouvé
     */
    public function get($id)
    {
        $query = "SELECT * FROM problemesav WHERE idProblemeSAV = ?;";

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
        if ($row = $traitement->fetch())
        {
            $managerCli = new clientManager(database::getDB());
            $managerProc = new procedureSAVManager(database::getDB());
            $managerProd = new produitManager(database::getDB());
            $managerEmploye = new employeManager(database::getDB());
            
            $cli = $managerCli->get($row['idClient']);
            $proc = $managerProc->get($row['idProcedure']);
            $prod = $managerProd->get($row['idProduit']);
            $empl = $managerEmploye->get($row['idEmploye']);
            
            //On instancie un objet 'probleme' avec les valeurs récupérées
            $probleme = new problemesav($row['titreProblemeSAV'],$row['descProblemeSAV'],$row['montantProcedure'], $empl, $cli, $proc, $prod);
            //Positionnement de l'id
            $probleme->setId($row['idProblemeSAV']);
            $probleme->setDate($row['dateProblemeSAV']);
            $probleme->setEtat($row['etatProblemeSAV']);
            //retourne l'objet 'probleme' correpsondant
            return $probleme;
        }
        else {
            return false;
        }
    }
    
}