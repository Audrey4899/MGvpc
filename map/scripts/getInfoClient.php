<?php
    header("Content-Type: text/plain");

    spl_autoload_register(function($class) {
	    include '../../classes/' . $class . '.class.php';
	});

    $res="";
    if(isset($_POST['num']) && !empty($_POST['num']))   {
        $manager = new clientManager(database::getDB());
        $client = $manager->get($_POST['num']);
    }
    if ($client!=false) {
        $nom = $client->getNom();
        $res = "<a style ='color : #04B431' href = 'fiche_client.php?idCli=".$client->getId()."'>".$client->getPrenom()." ". strtoupper($nom)."</a>";
    }
    echo $res;
    
    