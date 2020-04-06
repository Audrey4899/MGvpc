<?php
    header("Content-Type: text/plain");
    spl_autoload_register(function($class) {
        include '../../classes/' . $class . '.class.php';
    });

    $res="";
    if(isset($_POST['id']) && !empty($_POST['id']))
    {
        $manager = new employeManager(database::getDB());
        $employe = $manager->get($_POST['id']);
    }
    
    if ($employe!=false) {
        $nom = $employe->getNom();
        $res = "Bonjour ". $employe->getPrenom()." ". strtoupper($nom)." !";
    }
    echo $res;