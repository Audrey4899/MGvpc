<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categorieProduit
 *
 * @author etudiant
 */
class categorieProduit implements JsonSerializable
{
    private $id;
    private $nomCateg;
    
    public function __construct($nomCateg) 
    {
        $this->nomCateg = $nomCateg;
    }
    
    function getId() {
        return $this->id;
    }

    function getNomCateg() {
        return $this->nomCateg;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNomCateg($nomCateg) {
        $this->nomCateg = $nomCateg;
    }
    
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
            'nomCateg' => $this->nomCateg
        ];
    }
}