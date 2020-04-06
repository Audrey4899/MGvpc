<?php
    header("Content-Type: text/plain");
    spl_autoload_register(function($class) {
      include '../../classes/' . $class . '.class.php';
  });
    
    switch($_POST['choix'])
    {
        case 1 :
            $tri = 'ORDER BY dateCommande DESC;';
            break;
        case 2 :
            $tri = 'ORDER BY dateCommande ASC;';
            break;
        case 3 :
            $tri = "WHERE etatCommande = 'En cours de traitement' ORDER BY dateCommande ASC;";
            break;
        case 4 :
            $tri = "WHERE etatCommande = 'Expédiée' ORDER BY dateCommande DESC;";
            break;
        case 5 :
            $tri = "WHERE etatCommande = 'Annulée' ORDER BY dateCommande DESC;";
            break;
    }
?>
    <tr>
        <th>Date</th>
        <th>Etat</th>
        <th>Client</th>
        <th>Total</th>
      </tr>
      <?php
      $manaComm = new commandeManager(database::getDB());
      $listeComm = $manaComm->getList($tri);
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