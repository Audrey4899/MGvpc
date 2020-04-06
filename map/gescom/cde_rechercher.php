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
{ ?>
    
    <!-- AFFICHAGE DU CONTENU DE LA PAGE -->
    <div id="content">

        <!-- Affichage du contenu "utile" de la page -->
        <div class="left">

            <img id="banner" src="../images/warehouse.jpg" alt="Entrepot">
            <br>
            <form method="get" action="">
                <fieldset style="border-radius: 10px">
                <div class="tri">
                    <h2>Trier les résultats</h2>
                    <h4>Rechercher par client :</h4>
                    <div id="formRechCli">
                        <input type="hidden" name="typeRech" value="cli">
                        <p><input onkeyup="rechercheComm()" id="recherche" style="border-radius: 5px;width: 40%" type="text" name="nomCli" placeholder="Entrez le nom ou le prenom du client" required>
                    </div>
                    <h4>Trier par :</h4>
                    <select onchange="trierComm(this);" name="triComm">
                        <option value="1">Les plus récentes</option>
                        <option value="2">Les plus anciennes</option>
                        <option value="3">Etat : En cours de traitement</option>
                        <option value="4">Etat : Expédiée</option>
                        <option value="5">Etat : Annulée</option>
                    </select>
                </div>
                </fieldset>
            </form>
            <br>
            <h2>Liste des Commandes</h2>
            <div class="listeComm">
                <table id="listeComm">
                    <tr>
                      <th>Date</th>
                      <th>Etat</th>
                      <th>Client</th>
                      <th>Total</th>
                    </tr>
                    <?php
                    $manaComm = new commandeManager(database::getDB());
                    $listeComm = $manaComm->getList('ORDER BY dateCommande DESC;');
                    //var_dump($listeProb);
                    foreach ($listeComm as $uneComm)
                    {
                        echo '<tr>';
                        echo '<td>'.$uneComm->getDate().'</td>';
                        echo '<td>'.$uneComm->getEtat().'</td>';
                        echo '<td>'.$uneComm->getClient()->getPrenom().' '.$uneComm->getClient()->getNom().'</td>';
                        echo '<td><b>'.$uneComm->getTotal().' €</b></td>';
                        echo '<td name="numCde"><a href="cde_rechercher_resultat.php?numCde='. $uneComm->getNum().'">Voir la commande</a></td>';
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