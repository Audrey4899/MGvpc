<?php
require_once("facade.php");

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $PARRAY = $_POST;
}
else {
    $PARRAY = $_GET;
}

/*selection de l'action */
if (isset($PARRAY["action"]))
{
    $act=$PARRAY["action"];
    
    //---------- CLIENTS ---------- TESTE 16/01/2019
    if($act=="getClients"){
        getClients();
    }
    else if($act=="getClientId"){
        getClientId($PARRAY["id"]);
    }
    else if($act=="getClientsNom"){
        getClientsNom($PARRAY["nom"]);
    }
    else if ($act=="getCommandesParClient"){
        getCommandesParClient($PARRAY["id"]);
    }
    else if($act=="addClient"){
        addClient($PARRAY["nom"],$PARRAY["pre"],$PARRAY["rue"],$PARRAY["cp"],$PARRAY["vil"],$PARRAY["mail"],$PARRAY["tel"]);
    }
    else if ($act=="updateClient"){
        updateClient($PARRAY["id"],$PARRAY["nom"],$PARRAY["pre"],$PARRAY["rue"],$PARRAY["cp"],$PARRAY["vil"],$PARRAY["mail"],$PARRAY["tel"]);
    }
    else if ($act=="deleteClient"){
        deleteClient($PARRAY["id"]);			
    }
        
    //---------- PRODUITS ----------
    else if($act=="getProduits"){
        getProduits();
    }	
    else if($act=="getProduitId"){
        getProduitId($PARRAY["id"]);
    }   
    else if($act=="getProduitsNom"){
        getProduitsNom($PARRAY["nom"]);
    }   
    else if($act=="addProduit"){
        
        addProduit($PARRAY["id"],$PARRAY["nom"],$PARRAY["desc"],$PARRAY["prix"],$PARRAY["garantie"],$PARRAY["idCateg"]);
    }   
    else if($act=="updateProduit"){
        updateProduit($PARRAY["id"],$PARRAY["nom"],$PARRAY["desc"],$PARRAY["prix"],$PARRAY["garantie"],$PARRAY["idCateg"]);
    }   
    else if($act=="deleteProduit"){
        deleteProduit($PARRAY["id"]);
    }
    
    //---------- EMPLOYES ---------- TESTE 16/01/2019
    else if($act=="getEmployes"){
        getEmployes();
    }	
    else if($act=="getEmployeId"){
            getEmployeId($PARRAY["id"]);
    }   
    else if($act=="getEmployesNom"){
        getEmployesNom($PARRAY["nom"]);
    }   
    else if($act=="addEmploye"){
        addEmploye($PARRAY["nom"],$PARRAY["pre"],$PARRAY["tel"],$PARRAY["mail"],$PARRAY["mdp"]);
    }   
    else if($act=="updateEmploye"){
        updateEmploye($PARRAY["id"],$PARRAY["nom"],$PARRAY["pre"],$PARRAY["tel"],$PARRAY["mail"],$PARRAY["mdp"]);
    }   
    else if($act=="deleteEmploye"){
        deleteEmploye($PARRAY["id"]);
    }
    
    //---------- PROCEDURES ---------- //TESTE 16/01/2019
    else if($act=="getProcedures"){
        getProcedures();
    }	
    else if($act=="getProcedureId"){
        getProcedureId($PARRAY["id"]);
    }   
    else if($act=="getProceduresNom"){
        getProceduresNom($PARRAY["nom"]);
    }   
    else if($act=="addProcedure"){
        addProcedure($PARRAY["lib"]);
    }   
    else if($act=="updateProcedure"){
        updateProcedure($PARRAY["id"],$PARRAY["lib"]);
    }   
    else if($act=="deleteProcedure"){
        deleteProcedure($PARRAY["id"]);
    }
    
    //---------- PROBLEMES ---------- TESTE 16/01/2019
    else if($act=="getProblemes"){
        getProblemes();
    }	
    else if($act=="getProblemeId"){
        getProblemeId($PARRAY["id"]);
    }   
    else if($act=="getProblemesTitre"){
        getProblemesTitre($PARRAY["titre"]);
    }   
    else if($act=="addProbleme"){
        addProbleme($PARRAY["titre"],$PARRAY["desc"],$PARRAY["date"],$PARRAY["etat"],$PARRAY["montant"], $PARRAY["idCli"], $PARRAY["idProc"], $PARRAY["idProd"]);
    }   
    else if($act=="updateProbleme"){
        updateProbleme($PARRAY["id"],$PARRAY["titre"],$PARRAY["desc"],$PARRAY["date"],$PARRAY["etat"],$PARRAY["montant"], $PARRAY["idCli"], $PARRAY["idProc"], $PARRAY["idProd"]);
    }   
    else if($act=="deleteProbleme"){
        deleteProbleme($PARRAY["id"]);
    }
    
    //---------- CATEGORIES PRODUIT ---------- TESTE 16/01/2019
    else if($act=="getCategories"){
        getCategories();
    }	
    else if($act=="getCategorieId"){
        getCategorieId($PARRAY["id"]);
    }   
    else if($act=="getCategoriesNom"){
        getCategoriesNom($PARRAY["nom"]);
    }   
    else if($act=="addCategorie"){
        addCategorie($PARRAY["nomCateg"]);
    }   
    else if($act=="updateCategorie"){
        updateCategorie($PARRAY["id"],$PARRAY["nomCateg"]);
    }   
    else if($act=="deleteCategorie"){
        deleteCategorie($PARRAY["id"]);
    }
    
    //---------- COMMANDES ---------- A TESTER
    else if($act=="getCommandes"){
        getCommandes();
    }
    else if($act=="getCommandeId"){
        getCommandeId($PARRAY["id"]);
    }   
    else if($act=="getCommandesEtat"){
        getCommandesEtat($PARRAY["nom"]);
    }
    else if($act=="addCommande"){
        addCommande($PARRAY["idClient"]);
    }
    else{
        echo("Action inconnue !");			
    }
}
else{
        echo ("Erreur, vérifiez les paramètres de votre requête http !");
}


