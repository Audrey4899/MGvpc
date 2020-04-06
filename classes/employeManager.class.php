<?php
require_once ("database.class.php");
require_once 'employe.class.php';

/**
 * Classe d'accès aux données concernant les employes.
 * 
 * <br>TESTS :  OK
 * <br>DOC :    OK
 *
 * @author boca
 */
class EmployeManager {
    
    private $db;
    
    /**
     * Instancie un objet employeManager.
     * 
     * Permet d'instanicer un objet employeManager qui nous permettra ensuite d'accéder aux données de la base spécifiée en paramètre.
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
     * Enregistre ou Modifie l'employe dans la base.
     * 
     * Pour enregistrer l'employe passé en paramètre en base de données :
     *      <br>UPDATE si l'employe est déjà existant;
     *      <br>INSERT sinon (si id non trouvé ou non spécifié).
     * 
     * @param employe Employe à enregister ou mettre à jour.
     * 
     * @return int Retourne l'id de l'employe ajouté ou mis à jour.
     */
    public function save(employe $employ)
    {        
        $nbRows = 0;

        // le secteur que nous essayons de sauvegarder existe-t-il dans la  base de données ?
        if ($employ->getId()!=''){
            $query = "select count(*) as nb from `employesav` where `idEmploye`=?";
            $traitement = $this->db->prepare($query);
            $param1=$employ->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }
        
        // Si le secteur que nous essayons de sauvegarder existe dans la base de données : UPDATE
        if ($nbRows > 0)
        {
            $query = "update `employesav` set `nomEmploye`=?, `prenomEmploye`=?, `telEmploye`=?, `mailEmploye`=?, `mdpEmploye`=? where `idEmploye`=?;";
            $traitement = $this->db->prepare($query);
            $param1=$employ->getNom();
            $traitement->bindparam(1,$param1);
            $param2=$employ->getPrenom();
            $traitement->bindparam(2,$param2);
            $param3=$employ->getTel();
            $traitement->bindparam(3,$param3);
            $param4=$employ->getMail();
            $traitement->bindparam(4,$param4);
            $param5=$employ->getMdp();
            $traitement->bindparam(5,$param5);
            $param6=$employ->getId();
            $traitement->bindparam(6,$param6);
            $traitement->execute();
        }
        // sinon : INSERT
        else
        {
            $query = "insert into `employesav` (`nomEmploye`, `prenomEmploye`,`telEmploye`, `mailEmploye`, `mdpEmploye`) values (?,?,?,?,?);";
            $traitement = $this->db->prepare($query);
            $param1=$employ->getNom();
            $traitement->bindparam(1,$param1);
            $param2=$employ->getPrenom();
            $traitement->bindparam(2,$param2);
            $param3=$employ->getTel();
            $traitement->bindparam(3,$param3);
            $param4=$employ->getMail();
            $traitement->bindparam(4,$param4);
            $param5=$employ->getMdp();
            $traitement->bindparam(5,$param5);
            $traitement->execute();              
        }
        if ($employ->getId() == "")
        {
            $employ->setId($this->db->lastInsertId());
        }
        return $employ->getId();
    }

    /**
     * Supprime l'employe de la base.
     * 
     * Supprime l'employe de la base et les lignes de commandes associées de la table "comporter".
     * 
     * @param employe Employe devant être supprimé.
     * @return boolean Retourne true si la suppression est un succès, false sinon.
     */
    public function delete(employe $employ)
    {
        $nbRows = 0;

        // l'employe que nous essayons de supprimer existe-t-il dans la  base de données ?
        if ($employ->getId()!=''){                    
            $query = "select count(*) as nb from `employesav` where `idEmploye`=?";
            $traitement = $this->db->prepare($query);
            $param1 = $employ->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();
            $ligne = $traitement->fetch();
            $nbRows=$ligne[0];
        }

        // SI l'employe que nous essayons de supprimer existe dans bd
        // ALORS
        //      DELETE FROM employesav
        //          et retourne TRUE
        if ($nbRows > 0)
        {
            
            // DELETE FROM employesav
            $query = "delete from `employesav` where `idEmploye`=?";
            $traitement = $this->db->prepare($query);
            $param1 = $employ->getId();
            $traitement->bindparam(1,$param1);
            $traitement->execute();            
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Sélectionne un(des) employe(s) dans la base.
     * 
     * Méthode générique de SELECT qui renvoie un tableau d'employe correspondant aux critères de sélection spécifiés.
     * Si aucun paramètre n'est précisé, la valeur par défaut du paramètre 'WHERE 1' permet d'obtenir tous les employes.
     * 
     * @param string Chaîne de caractère devant être une restriction SQL valide.
     * @return array Renvoie un tableau d'objet(s) employes.
     */
    public function getList($restriction='WHERE 1')
    {
        $query = "select * from `employesav` ".$restriction.";";
        $employList = Array();

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
            $employe = new employe($row['nomEmploye'],$row['prenomEmploye'],$row['telEmploye'],$row['mailEmploye'],$row['mdpEmploye']);
            $employe->setId($row['idEmploye']);
            //ajout de l'objet à la fin du tableau
            $employList[] = $employe;
        }
        //retourne le tableau d'objets 'employe'
        return $employList;   
    }
    
    /**
     * Sélectionne un employe dans la base.
     * 
     * Méthode de SELECT qui renvoie l'employe dont l'id est spécifié en paramètre.
     * 
     * @param int ID de l'employe recherché
     * @return employe|boolean Renvoie l'objet employe recherché ou FALSE s'il n'a pas été trouvé
     */
    public function get($id)
    {
        $query = "select * from `employesav` WHERE `idEmploye`=?;";

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
        if ($row = $traitement->fetch()) {
            //On instancie un objet 'produit' avec les valeurs récupérées
            $employe = new employe($row['nomEmploye'],$row['prenomEmploye'],$row['telEmploye'],$row['mailEmploye'],$row['mdpEmploye']);
            $employe->setId($row['idEmploye']);
            //retourne l'objet 'employe' correpsondant
            return $employe;
        }
        else {
            return false;
        }
    }
    
}