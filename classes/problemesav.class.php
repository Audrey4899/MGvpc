<?php

/**
 * Description of probleme
 *
 * @author Boca
 */
class problemesav implements JsonSerializable {
    private $id;
    private $titre;
    private $desc;
    private $date;
    private $etat;
    private $montant;
    private $client;
    private $procedure;
    private $produit;
    private $employe;

    public function __construct($titre, $desc, $montant,$employe,$client,$procedure,$produit){
        $this->titre = $titre;
        $this->desc = $desc;
        $this->montant = $montant;
        $this->client = $client;
        $this->employe = $employe;
        $this->procedure = $procedure;
        $this->produit = $produit;
        $this->date = date('Y-m-d');
        $this->etat = "A traiter";
    }

    // Mutateurs chargés de modifier les attributs
    public function setId($id){$this->id = $id;}    
    public function setTitre($titre){$this->titre = $titre;}
    public function setDesc($desc){$this->desc = $desc;}
    public function setDate($date){$this->date = $date;}
    public function setEtat($etat){$this->etat = $etat;}
    public function setMontant($montant){$this->montant = $montant;}
    public function setClient($client) {$this->client = $client;}
    public function setProcedure($procedure) {$this->procedure = $procedure;}
    public function setProduit($produit) {$this->produit = $produit;}
    public function setEmploye($employe) {$this->employe = $employe;}

    // Accesseurs chargés d'exposer les attributs
    public function getId(){return $this->id;}
    public function getTitre(){return $this->titre;}
    public function getDesc(){return $this->desc;}
    public function getDate(){return $this->date;}
    public function getEtat(){return $this->etat;}
    public function getMontant(){return $this->montant;}
    public function getClient() {return $this->client;}
    public function getProcedure() {return $this->procedure;}
    public function getProduit() {return $this->produit;}
    public function getEmploye() {return $this->employe;}
    /**
     * Spécifie les données qui doivent être linéarisées en JSON.
     * 
     * Linéarise l'objet en une valeur qui peut être linéarisé nativement par la fonction json_encode().
     * 
     * @return mixed Retourne les données qui peuvent être linéarisées par la fonction json_encode()
     */
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'desc' => $this->desc,
            'date' => $this->date,
            'etat' => $this->etat,
            'montant' => $this->montant,
            'idClient' => $this->client->getId(),
            'idProcedure' => $this->procedure->getId(),
            'idProduit' => $this->produit->getId(),
            'idEmploye' => $this->employe->getId()
        ];
    }
}