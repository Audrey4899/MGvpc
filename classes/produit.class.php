<?php
/**
 * Classe représentant les produits.
 * 
 * Les produits sont définis par
 *      <br>- un id unique
 *      <br>- un libellé
 *      <br>- une description
 *      <br>- un prix
 * 
 * @author Ben
 */
class produit implements JsonSerializable {
    private $id;
    private $lib;
    private $desc;
    private $prix;
    private $garantie;
    private $categorie;

    /**
     * Instancie un objet produit.
     * 
     * @param type Libellé du produit
     * @param type Description longue du produit
     * @param type Prix du produit
     */    
    public function __construct($id, $lib, $desc, $pri, $dureeGar, $categorie){
        $this->id = $id;
        $this->lib = $lib;
        $this->desc = $desc;
        $this->prix = $pri;
        $this->garantie = $dureeGar;
        $this->categorie = $categorie;
    }    

    // Mutateurs chargés de modifier les attributs
    public function setId($id){$this->id = $id;}    
    public function setLib($lib){$this->lib = $lib;}
    public function setDesc($desc){$this->desc = $desc;}
    public function setPrix($pri){$this->prix = $pri;}
    public function setGarantie($garantie){$this->garantie = $garantie;}
    public function setCategorie($categorie) {$this->categorie = $categorie;}
    
    // Accesseurs chargés d'exposer les attributs
    public function getId(){return $this->id;}
    public function getLib(){return $this->lib;}
    public function getDesc(){return $this->desc;}
    public function getPrix(){return $this->prix;}
    public function getGarantie(){return $this->garantie;}
    public function getCategorie() {return $this->categorie;}
    
    
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
            'lib' => $this->lib,
            'desc' => $this->desc,
            'prix' => $this->prix,
            'garantie' => $this->garantie,
            'idCateg' => $this->categorie->getId()
        ];
    }
    
}