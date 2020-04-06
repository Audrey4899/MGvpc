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

    $idEmpl = $_GET['idEmploye'];
    $idCli = $_GET['numCli'];
    $refProd = $_GET['ref'];
    $libProb = $_GET['libProb'];
    $descProb = $_GET['descProb'];
    $proc = $procManager->getList("WHERE libelleProcedure ='".$_GET["solutionProb"]."'");
    $idProc = $proc[0]->getId(); //On récupère l'id à partir du libellé de la procédure.
    $mtt_complet = $_GET['totalttc'];
    $montant = mb_substr($mtt_complet, 0, -2, 'UTF-8'); //On enlève le signe €.

    if(isset($_GET['numCli']) && !empty($_GET['numCli'])
        && isset($_GET['idEmploye']) && !empty($_GET['idEmploye'])
        && isset($_GET['ref']) && !empty($_GET['ref'])
        && isset($_GET['libProb']) && !empty($_GET['libProb'])
        && isset($_GET['descProb']) && !empty($_GET['descProb'])
        && isset($_GET['solutionProb']) && !empty($_GET['solutionProb'])
        && isset($_GET['totalttc']) && !empty($_GET['totalttc']))   
    {
        $lastPB1 = $probManager->getList('GROUP BY idProblemeSAV DESC');
        $lastId1 = $lastPB1[0]->getId();

        $client = $cliManager->get($idCli);
        $employe = $emplManager->get($idEmpl);
        $prod = $prodManager->get($refProd);
        $proc = $procManager->get($idProc);

        $prob = new problemesav($libProb, $descProb, $montant, $employe, $client, $proc, $prod);
        $probManager->save($prob);

        $lastPB2 = $probManager->getList('GROUP BY idProblemeSAV DESC');
        $lastId2 = $lastPB2[0]->getId();

        if($lastId1 === $lastId2)
        { ?>
            <!-- AFFICHAGE DU CENTRE DE PAGE -->
            <div id="content">

                <!-- Affichage du contenu "utile" de la page -->
                <div class="left">

                    <img id="banner" src="../images/warehouse.jpg" alt="Entrepot">
                    <br>

                    <h2> Une erreur est survenue lors de l'enregistrement du problème.</h2>
                    <h4>Recommencez en vérifiant que :</h4>
                    <ul>
                        <li>Le client ait bien commandé le produit dont il se plaint</li>
                        <li>Le choix de la procédure correspond avec les modalités de garantie</li><br>
                        <i style="color: green">Rappel :
                            <ul>
                                <li>Hors garantie si la date de la garantie est expirée.</li>
                                <li>Sous garantie si la date d'expiration de la garantie n'est pas encore dépassée.</li>
                            </ul>
                        </i>
                    </ul>
                    <br><a href="saisie_prob.php">Réessayer</a>
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

        else //L'ajout a fonctionné
        {?>
            <!-- AFFICHAGE DU CENTRE DE PAGE -->
            <div id="content">

                <!-- Affichage du contenu "utile" de la page -->
                <div class="left">

                    <img id="banner" src="../images/warehouse.jpg" alt="Entrepot">
                    <br>

                    <h2> Le problème a bien été enregistré. </h2>
                    <br><a href="saisie_prob.php">Saisir un autre problème</a>
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
}

else
{
    header('location:../index.php');
}

include ("../inc/footer.inc.php");