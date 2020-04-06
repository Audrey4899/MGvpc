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
    <head>
        <link rel="stylesheet" href="<?php echo $base_url."style/style.css"; ?>">
    </head>
    <!-- AFFICHAGE DU CONTENU DE LA PAGE -->
    <div id="content">

        <!-- Affichage du contenu "utile" de la page -->
        <div class="left">

            <img id="banner" src="../images/warehouse.jpg" alt="Entrepot">
            <br>
            <?php
            echo '<h2>Fiche client #'.$_GET['idCli'].'</h2>';
            $managerCli = new clientManager(database::getDB());?>
            <table id="infosCli">
                <tr>
                    <th></th><th>Prénom - nom</th><th>Email</th><th>Téléphone</th><th>Adresse</th><th></th>
                </tr>
                <tr>
                    <td></td>
                    <td id="nomCli" style="width: 20%"/><?php echo $managerCli->get($_GET['idCli'])->getPrenom().' '.strtoupper($managerCli->get($_GET['idCli'])->getNom())?></td>
                    <td id="mailCli" style="width: 30%"/><?php echo $managerCli->get($_GET['idCli'])->getMail()?></td>
                    <td id="telCli" style="width: 20%"/><?php echo $managerCli->get($_GET['idCli'])->getTel()?></td>
                    <td id="adrCli" style="width: 40%"/><?php echo $managerCli->get($_GET['idCli'])->getRue().'<br> '.$managerCli->get($_GET['idCli'])->getCP().' '.strtoupper($managerCli->get($_GET['idCli'])->getVille())?></td>
                    <td></td>
                </tr>
            </table>

            <br><br>
            <h3>Commandes passées</h3>
            <div class="liste">
                <?php
                    $manaCom = new commandeManager(database::getDB());
                    $client = $managerCli->get($_GET['idCli']);
                    $listeCom = $manaCom->getCdesClient($client);
                    if(!empty($listeCom))
                    { ?>
                        <table id="liste">
                            <tr>
                              <th>Id</th>
                              <th>Date</th>
                              <th>Etat</th>
                            </tr>
                            <?php
                            foreach ($listeCom as $uneCom)
                            {
                                echo '<tr>';
                                echo '<td>'. $uneCom->getNum().'</td>';
                                echo '<td>'. $uneCom->getDate().'</td>';
                                echo '<td>'. $uneCom->getEtat().'</td>';
                                echo '<td name="numCde"><a href="..\gescom\cde_rechercher_resultat.php?numCde='. $uneCom->getNum().'">Voir la commande</a></td>';
                                echo '</tr>';
                            }
                        ?></table><?php 
                    }
                    else
                    {
                        echo "<h4>Ce client n'a passé aucune commande<h4>";
                    }
                ?> 
            </div>
            <br><br>
            <h3>Problèmes SAV déclarés</h3>
            <div class="liste">
                <?php
                    $manaProb = new problemesavManager(database::getDB());
                    $listeProb = $manaProb->getList('WHERE idClient ='.$_GET['idCli']);
                    
                    if(!empty($listeProb))
                    { ?>
                       <table id="liste">
                            <tr>
                              <th>Id</th>
                              <th>Intitulé</th>
                              <th>Date</th>
                              <th>Etat</th>
                              <th>Montant</th>
                            </tr>
                            <?php
                            foreach ($listeProb as $unProb)
                            {
                                echo '<tr>';
                                echo '<td>'. $unProb->getId().'</td>';
                                echo '<td>'. $unProb->getTitre().'</td>';
                                echo '<td>'. $unProb->getDate().'</td>';
                                echo '<td>'. $unProb->getEtat().'</td>';
                                echo '<td>'. $unProb->getMontant().' €</td>';
                                echo '<td name="idProb"><a href="fiche_incident.php?idProb='. $unProb->getId().'">Fiche détaillée</a></td>';
                                echo '</tr>';
                            }
                            ?> </table><?php
                    }
                    else
                    {
                        echo "<h4>Ce client n'a déclaré aucun problème<h4>";
                    } ?>
                <br><br>
                <input class="btsub" type="button" value="Retour" onclick="history.go(-1)">
            </div>
        </div>

<?php
}

else
{
    header('location:../index.php');
}

include ("../inc/right.inc.php");?>
    
    <!-- rétablissement du flux normal -->
    <div style="clear:both;"></div>

</div>

<!-- AFFICHAGE DU BAS DE PAGE -->
<?php
    include ("../inc/footer.inc.php");
?>
