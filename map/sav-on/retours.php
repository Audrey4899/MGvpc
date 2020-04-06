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
            <form method="get" action="fiche_incident.php">
                <fieldset style="border-radius: 10px">
                <div class="tri">
                    <h2>Trier les résultats</h2>
                    <br>
                    <label>Trier par</label>
                    <select onchange="trier(this);" name="tri">
                        <option value="1">Les plus récents</option>
                        <option value="2">Les plus anciens</option>
                        <option value="3">Etat : A traiter</option>
                        <option value="4">Etat : Terminé</option>
                    </select>
                    <br><br>
                    <input type="text" id="recherche" onkeyup="rechercheProb()" placeholder="Rechercher parmis les titres..." class="champ">
                </div>
                </fieldset>
            </form>
            <br>
            <h2>Liste des retours</h2>
            <div class="liste">
                <table id="liste">
                    <tr>
                      <th>Date</th>
                      <th>Titre</th>
                      <th>Client</th>
                      <th>Produit</th>
                      <th>Etat</th>
                    </tr>
                    <?php
                    $manaProb = new problemesavManager(database::getDB());
                    $listeProb = $manaProb->getList('ORDER BY dateProblemeSAV DESC;');
                    //var_dump($listeProb);
                    foreach ($listeProb as $unProb)
                    {
                        echo '<tr>';
                        echo '<td>'. $unProb->getDate().'</td>';
                        echo '<td>'. $unProb->getTitre().'</td>';
                        echo '<td><a href = "fiche_client.php?idCli='.$unProb->getClient()->getId().'">'.$unProb->getClient()->getPrenom().' '.$unProb->getClient()->getNom().'</a></td>';
                        echo '<td>'.$unProb->getProduit()->getId().'</td>';
                        echo '<td>'. $unProb->getEtat().'</td>';
                        echo '<td name="idProb"><a href="fiche_incident.php?idProb='. $unProb->getId().'">Fiche détaillée</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </div>
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

else
{
    header('location:../index.php');
}
    include ("../inc/footer.inc.php");
