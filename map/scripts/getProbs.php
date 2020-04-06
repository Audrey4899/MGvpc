<?php
    header("Content-Type: text/plain");
    spl_autoload_register(function($class) {
        include '../../classes/' . $class . '.class.php';
    });
    
    switch($_POST['choix'])
    {
        case 1 :
            $tri = 'ORDER BY dateProblemeSAV DESC;';
            break;
        case 2 :
            $tri = 'ORDER BY dateProblemeSAV ASC;';
            break;
        case 3 :
            $tri = "WHERE etatProblemeSAV = 'A traiter' ORDER BY dateProblemeSAV ASC;";
            break;
        case 4 :
            $tri = "WHERE etatProblemeSAV = 'Terminé' ORDER BY dateProblemeSAV DESC;";
            break;
    }
?>
    <tr>
      <th>Date</th>
      <th>Titre</th>
      <th>Client</th>
      <th>Produit</th>
      <th>Etat</th>
    </tr>
    <?php
    $manaProb = new problemesavManager(database::getDB());
    $listeProb = $manaProb->getList($tri);
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