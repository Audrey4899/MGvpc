<!-- AFFICHAGE DU HAUT DE LA PAGE -->
<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include ("../inc/header.inc.php");
include ("../inc/menu.inc.php");

spl_autoload_register(function($class) {
    include '../../classes/' . $class . '.class.php';
});

if (isset($_SESSION['idE']))
{
?>

    <!-- Enregistrement du problème en base de données -->
    <?php
    $procManager = new procedureSAVManager(database::getDB());
    $cliManager = new clientManager(database::getDB());
    $prodManager = new produitManager(database::getDB());
    $emplManager = new employeManager(database::getDB());
    $probManager = new problemesavManager(database::getDB());

    $empl = $emplManager->getList("WHERE nomEmploye ='".$_GET['nomEmploye']."'");
    $idEmpl = $empl[0]->getId();

    $cli = $cliManager->getList("WHERE prenomClient ='".$_GET['prenomClient']."'");
    $idCli = $cli[0]->getId();

    $prod = $prodManager->getList("WHERE nomProduit ='".$_GET['ref']."'");
    $ref = $prod[0]->getId();

    $dateP = $_GET['dateProb'];
    $titreP = $_GET['titreProb'];
    $descP = $_GET['descProb'];
    $etat = $_GET["etat"];
    $idProb = $_GET["idProb"];
    
    $proc = $procManager->getList("WHERE libelleProcedure ='".$_GET["solutionProb"]."'");
    $idProc = $proc[0]->getId();

    $mtt_complet = $_GET['totalttc'];
    $montant = mb_substr($mtt_complet, 0, -2, 'UTF-8'); //On enlève le signe €.

    if(isset($_GET['prenomClient']) && !empty($_GET['prenomClient'])
        && isset($_GET['nomEmploye']) && !empty($_GET['nomEmploye'])
        && isset($_GET['ref']) && !empty($_GET['ref'])
        && isset($_GET['titreProb']) && !empty($_GET['titreProb'])
        && isset($_GET['descProb']) && !empty($_GET['descProb'])
        && isset($_GET['solutionProb']) && !empty($_GET['solutionProb'])
        && isset($_GET['etat']) && !empty($_GET['etat'])
        && isset($_GET['dateProb']) && !empty($_GET['dateProb'])
        && isset($_GET['totalttc']) && !empty($_GET['totalttc']))   
    {
        $client = $cliManager->get($idCli);
        $employe = $emplManager->get($idEmpl);
        $prod = $prodManager->get($ref);
        $proc = $procManager->get($idProc);

        $prob = new problemesav($titreP, $descP, $montant, $employe, $client, $proc, $prod);
        $prob->setEtat($etat);
        $prob->setId($idProb);
        $prob->setDate($dateP);
        $probManager->save($prob);

        ?>
        <!-- AFFICHAGE DU CENTRE DE PAGE -->
        <div id="content">

            <!-- Affichage du contenu "utile" de la page -->
            <div class="left">

                <img id="banner" src="../images/warehouse.jpg" alt="Entrepot">
                <br><h2>La modification a bien été effectuée.</h2>
                <br><a href="retours.php">Retour à la liste des incidents</a>
                <br><a href="../inc/page_bienvenue.php">Revenir à l'accueil</a>
            </div>

            <!-- Affichage du menu de droite -->
            <?php
                include ("../inc/right.inc.php");
            ?>

            <!-- rétablissement du flux normal -->
            <div style="clear:both;"></div>

        </div>
<?php
    }
}
else
{
    header('location:../index.php');
}
 include ("../inc/footer.inc.php");
