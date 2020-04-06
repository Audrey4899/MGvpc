<?php
function __autoload($class_name){
    require_once('../classes/' . $class_name . '.class.php'); 
}


// ---------- CLIENTS ---------- TESTE 16/01/2019
// Retourne la liste de tous les clients
function getClients(){
    $manager = new clientManager(database::getDB());
    $tabClients = $manager->getList();
    echo json_encode($tabClients, JSON_UNESCAPED_UNICODE);
}

// Retourne le client dont l'id est passé en paramètre au format JSON.
function getClientId($id){
    $manager = new clientManager(database::getDB());
    $client = $manager->get($id);
    echo json_encode($client, JSON_UNESCAPED_UNICODE);
}

//retourne les clients correspondant au nom est passé en paramètre
function getClientsNom($nom){
    $manager = new clientManager(database::getDB());
    $tabClients = $manager->getList("WHERE nomClient LIKE '%".$nom."%'");
    echo json_encode($tabClients, JSON_UNESCAPED_UNICODE);
}

//retourne la liste de toutes les commandes pour un client donné
function getCommandesParClient($idCli){
    $manager = new commandeManager(database::getDB());
    $tabCdes = $manager->getList("WHERE idClient=".$idCli);
    echo json_encode($tabCdes, JSON_UNESCAPED_UNICODE);
}

// Ajoute un client à la base de donnée
function addClient($nom, $prenom, $rue, $cp, $ville, $mail, $tel){
    $unClient = new client($nom, $prenom, $rue, $cp, $ville, $mail, $tel);
    $manager = new clientManager(database::getDB());
    $result = $manager->save($unClient);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Modifie un client de la base de données
function updateClient($id,$nom, $prenom, $rue, $cp, $ville, $mail, $tel){
    $leClient = new client($nom, $prenom, $rue, $cp, $ville, $mail, $tel);
    $leClient->setId($id);
    $manager = new clientManager(database::getDB());
    $result = $manager->save($leClient);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Supprime un client de la base de données
function deleteClient($id){   
    $manager = new clientManager(database::getDB());
    $leClient = $manager->get($id);
    if (!is_object($leClient)) {
        echo json_encode('{"resultat":false}', JSON_UNESCAPED_UNICODE);
    }
    else {
        $result = $manager->delete($leClient);
        echo json_encode('{"resultat":'.$result.'}', JSON_UNESCAPED_UNICODE);
    }
}

// ---------- EMPLOYE ---------- //TESTE 16/01/2019
// Retourne la liste de tous les employes
function getEmployes(){
    $manager = new EmployeManager(database::getDB());
    $tabEmployes = $manager->getList();
    echo json_encode($tabEmployes, JSON_UNESCAPED_UNICODE);
}

// Retourne l'employe dont l'id est passé en paramètre au format JSON.
function getEmployeId($id){
    $manager = new EmployeManager(database::getDB());
    $employe = $manager->get($id);
    echo json_encode($employe, JSON_UNESCAPED_UNICODE);
}

//retourne les employes correspondant au nom est passé en paramètre
function getEmployesNom($nom){
    $manager = new EmployeManager(database::getDB());
    $tabEmployes = $manager->getList("WHERE nomemploye LIKE '%".$nom."%'");
    echo json_encode($tabEmployes, JSON_UNESCAPED_UNICODE);
}

// Ajoute un employe à la base de donnée
function addEmploye($nom, $prenom, $tel, $mail, $mdp){
    $unEmploye = new employe($nom, $prenom, $tel, $mail, $mdp);
    $manager = new EmployeManager(database::getDB());
    $result = $manager->save($unEmploye);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Modifie un employe de la base de données
function updateEmploye($id, $nom, $prenom, $tel, $mail, $mdp){
    $unEmploye = new employe($nom, $prenom, $tel, $mail, $mdp);
    $unEmploye->setId($id);
    $manager = new EmployeManager(database::getDB());
    $result = $manager->save($unEmploye);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Supprime un employe de la base de données
function deleteEmploye($id){   
    $manager = new EmployeManager(database::getDB());
    $unEmploye = $manager->get($id);
    if (!is_object($unEmploye)) {
        echo json_encode('{"resultat":false}', JSON_UNESCAPED_UNICODE);
    }
    else {
        $result = $manager->delete($unEmploye);
        echo json_encode('{"resultat":'.$result.'}', JSON_UNESCAPED_UNICODE);
    }
}

// ---------- PROCEDURE ---------- //TESTE 16/01/2019
// Retourne la liste de toutes les procedures
function getProcedures(){
    $manager = new procedureSAVManager(database::getDB());
    $tabProcedures = $manager->getList();
    echo json_encode($tabProcedures, JSON_UNESCAPED_UNICODE);
}

// Retourne la procedure dont l'id est passé en paramètre au format JSON.
function getProcedureId($id){
    $manager = new procedureSAVManager(database::getDB());
    $procedure = $manager->get($id);
    echo json_encode($procedure, JSON_UNESCAPED_UNICODE);
}

//retourne les procedures correspondant au nom est passé en paramètre
function getProceduresNom($nom){
    $manager = new procedureSAVManager(database::getDB());
    $tabProcedures = $manager->getList("WHERE libelleProcedure LIKE '%".$nom."%'");
    echo json_encode($tabProcedures, JSON_UNESCAPED_UNICODE);
}

// Ajoute une procedure à la base de donnée
function addProcedure($lib){
    $uneProcedure = new procedureSAV($lib);
    $manager = new procedureSAVManager(database::getDB());
    $result = $manager->save($uneProcedure);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Modifie une procedure de la base de données
function updateProcedure($id,$lib){
    $uneProcedure = new procedureSAV($lib);
    $uneProcedure->setId($id);
    $manager = new procedureSAVManager(database::getDB());
    $result = $manager->save($uneProcedure);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Supprime une procedure de la base de données
function deleteProcedure($id){   
    $manager = new procedureSAVManager(database::getDB());
    $uneProcedure = $manager->get($id);
    if (!is_object($uneProcedure)) {
        echo json_encode('{"resultat":false}', JSON_UNESCAPED_UNICODE);
    }
    else {
        $result = $manager->delete($uneProcedure);
        echo json_encode('{"resultat":'.$result.'}', JSON_UNESCAPED_UNICODE);
    }
}

// ---------- PROBLEME ---------- TESTE 20/01/2019
// Retourne la liste de tous les problèmes
function getProblemes(){
    $manager = new problemeSAVManager(database::getDB());
    $tabProblemes = $manager->getList();
    echo json_encode($tabProblemes, JSON_UNESCAPED_UNICODE);
}

// Retourne le problème dont l'id est passé en paramètre au format JSON.
function getProblemeId($id){
    $manager = new problemeSAVManager(database::getDB());
    $probleme = $manager->get($id);
    echo json_encode($probleme, JSON_UNESCAPED_UNICODE);
}

//retourne les problèmes correspondant au nom est passé en paramètre
function getProblemesTitre($titre){
    $manager = new problemeSAVManager(database::getDB());
    $tabProblemes = $manager->getList("WHERE titreProblemeSAV LIKE '%".$titre."%'");
    echo json_encode($tabProblemes, JSON_UNESCAPED_UNICODE);
}

// Ajoute un problème à la base de donnée
function addProbleme($titre, $desc, $date, $etat, $montant, $idCli, $idProc, $idProd){
    $managerCli = new clientManager(database::getDB());
    $Cli = $managerCli->get($idCli);
    $managerProc = new procedureSAVManager(database::getDB());
    $Proc = $managerProc->get($idProc);
    $managerProd = new produitManager(database::getDB());
    $Prod = $managerProd->get($idProd);
    $unProblème = new problemesav($titre, $desc, $date, $etat, $montant, $Cli, $Proc, $Prod);
    $manager = new problemeSAVManager(database::getDB());
    $result = $manager->save($unProblème);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Modifie un problème de la base de données
function updateProbleme($id,$titre, $desc, $date, $etat, $montant, $idCli, $idProc, $idProd){
    $managerCli = new clientManager(database::getDB());
    $Cli = $managerCli->get($idCli);
    $managerProc = new procedureSAVManager(database::getDB());
    $Proc = $managerProc->get($idProc);
    $managerProd = new produitManager(database::getDB());
    $Prod = $managerProd->get($idProd);
    $unProblème = new problemesav($titre, $desc, $date, $etat, $montant, $Cli, $Proc, $Prod);
    $unProblème->setId($id);
    $manager = new problemeSAVManager(database::getDB());
    $result = $manager->save($unProblème);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Supprime un problème de la base de données
function deleteProbleme($id){   
    $manager = new problemeSAVManager(database::getDB());
    $unProblème = $manager->get($id);
    if (!is_object($unProblème)) {
        echo json_encode('{"resultat":false}', JSON_UNESCAPED_UNICODE);
    }
    else {
        $result = $manager->delete($unProblème);
        echo json_encode('{"resultat":'.$result.'}', JSON_UNESCAPED_UNICODE);
    }
}

// ---------- CATEGORIES PRODUIT ----------
// Retourne la liste de toutes les catégories
function getCategories(){
    $manager = new categorieProduitManager(database::getDB());
    $tabCategories = $manager->getList();
    echo json_encode($tabCategories, JSON_UNESCAPED_UNICODE);
}

// Retourne la catégorie dont l'id est passé en paramètre au format JSON.
function getCategorieId($id){
    $manager = new categorieProduitManager(database::getDB());
    $categorie = $manager->get($id);
    echo json_encode($categorie, JSON_UNESCAPED_UNICODE);
}

//retourne les catégories correspondantes au nom est passé en paramètre
function getCategoriesNom($nom){
    $manager = new categorieProduitManager(database::getDB());
    $tabCategories = $manager->getList("WHERE nomCategorie LIKE '%".$nom."%'");
    echo json_encode($tabCategories, JSON_UNESCAPED_UNICODE);
}

// Ajoute une catégorie à la base de donnée
function addCategorie($nomCateg){
    $uneCateg = new categorieProduit($nomCateg);
    $manager = new categorieProduitManager(database::getDB());
    $result = $manager->save($uneCateg);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Modifie une catégorie de la base de données
function updateCategorie($id,$nomCateg){
    $uneCateg = new categorieProduit($nomCateg);
    $uneCateg->setId($id);
    $manager = new categorieProduitManager(database::getDB());
    $result = $manager->save($uneCateg);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Supprime une catégorie de la base de données
function deleteCategorie($id){   
    $manager = new categorieProduitManager(database::getDB());
    $uneCateg = $manager->get($id);
    if (!is_object($uneCateg)) {
        echo json_encode('{"resultat":false}', JSON_UNESCAPED_UNICODE);
    }
    else {
        $result = $manager->delete($uneCateg);
        echo json_encode('{"resultat":'.$result.'}', JSON_UNESCAPED_UNICODE);
    }
}

// ---------- PRODUIT ---------- TESTE 20/01/2019
// Retourne la liste de tous les produits
function getProduits(){
    $manager = new produitManager(database::getDB());
    $tabProduits = $manager->getList();
    echo json_encode($tabProduits, JSON_UNESCAPED_UNICODE);
}

// Retourne le produit dont l'id est passé en paramètre au format JSON.
function getProduitId($id){
    $manager = new produitManager(database::getDB());
    $produit = $manager->get($id);
    echo json_encode($produit, JSON_UNESCAPED_UNICODE);
}

//retourne les produits correspondants au nom est passé en paramètre
function getProduitsNom($nom){
    $manager = new produitManager(database::getDB());
    $tabProduits = $manager->getList("WHERE nomProduit LIKE '%".$nom."%'");
    echo json_encode($tabProduits, JSON_UNESCAPED_UNICODE);
}

// Ajoute un produit à la base de donnée
function addProduit($id, $nom, $desc, $prix, $garantie, $idCateg){
    $managerCateg = new categorieProduitManager(database::getDB());
    $categ = $managerCateg->get($idCateg);
    $unProduit = new produit($id, $nom, $desc, $prix, $garantie, $categ);
    $manager = new produitManager(database::getDB());
    $result = $manager->save($unProduit);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Modifie un produit de la base de données
function updateProduit($id, $nom, $desc, $prix, $garantie, $idCateg){
    $managerCateg = new categorieProduitManager(database::getDB());
    $categ = $managerCateg->get($idCateg);
    $uneCateg = new produit($id, $nom, $desc, $prix, $garantie, $categ);
    $manager = new produitManager(database::getDB());
    $result = $manager->save($uneCateg);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}

// Supprime un produit de la base de données
function deleteProduit($id){   
    $manager = new produitManager(database::getDB());
    $unProduit = $manager->get($id);
    if (!is_object($unProduit)) {
        echo json_encode('{"resultat":false}', JSON_UNESCAPED_UNICODE);
    }
    else {
        $result = $manager->delete($unProduit);
        echo json_encode('{"resultat":'.$result.'}', JSON_UNESCAPED_UNICODE);
    }
}

// ---------- COMMANDE ---------- A FINIR
// Retourne la liste de toutes les commandes
function getCommandes(){
    $manager = new commandeManager(database::getDB());
    $tabCommandes = $manager->getList();
    echo json_encode($tabCommandes, JSON_UNESCAPED_UNICODE);
}

// Retourne la commande dont l'id est passé en paramètre au format JSON.
function getCommandeId($id){
    $manager = new commandeManager(database::getDB());
    $commande = $manager->get($id);
    echo json_encode($commande, JSON_UNESCAPED_UNICODE);
}

//retourne les commandes correspondantes à l'état passé en paramètre
function getCommandesEtat($etat){
    $manager = new commandeManager(database::getDB());
    $tabCommandes = $manager->getList("WHERE etatCommande LIKE '%".$nom."%'");
    echo json_encode($tabCommandes, JSON_UNESCAPED_UNICODE);
}

// Ajoute une commande à la base de donnée
function addCommande($idClient){
    $managerCli = new clientManager(database::getDB());
    $client = $managerCli->get($idClient);
    $uneCommande = new commande($client);
    $manager = new commandeManager(database::getDB());
    $result = $manager->save($uneCommande);
    echo json_encode('{"id":"'.$result.'"}', JSON_UNESCAPED_UNICODE);
}