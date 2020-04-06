<?php

/**
 * Description of employe
 *
 * @author Boca
 */
class employe implements JsonSerializable
{
    private $id;
    private $nom;
    private $prenom;
    private $tel;
    private $mail;
    private $mdp;

    public function __construct($nom, $prenom, $tel, $mail, $mdp){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->tel = $tel;
        $this->mail = $mail;
        $this->mdp = $mdp;
    }    

    // Mutateurs chargés de modifier les attributs
    public function setId($id){$this->id = $id;}    
    public function setNom($nom){$this->nom = $nom;}
    public function setPrenom($prenom){$this->prenom = $prenom;}
    public function setTel($tel){$this->tel = $tel;}
    public function setMail($mail){$this->mail = $mail;}
    public function setMdp($mdp){$this->mdp = $mdp;}
    
   //------------------------ à modifier en desous------------------------------ 
    // Accesseurs chargés d'exposer les attributs
    public function getId(){return $this->id;}
    public function getNom(){return $this->nom;}
    public function getPrenom(){return $this->prenom;}
    public function getTel(){return $this->tel;}
    public function getMail(){return $this->mail;}
    public function getMdp(){return $this->mdp;}
    
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
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'tel' => $this->tel,
            'mail' => $this->mail,
            'mdp' => $this->mdp
        ];
    }
}