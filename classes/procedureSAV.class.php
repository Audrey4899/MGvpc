<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of procedureSAV
 *
 * @author etudiant
 */
class procedureSAV implements JsonSerializable
{
    private $id;
    private $nomProc;
    
    public function __construct($nomProc)
    {
        $this->nomProc = $nomProc;
    }
    
    function getId() {
        return $this->id;
    }

    function getNomProc() {
        return $this->nomProc;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNomProc($nomProc) {
        $this->nomProc = $nomProc;
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
            'nomProc' => $this->nomProc         
        ];
    }
}
