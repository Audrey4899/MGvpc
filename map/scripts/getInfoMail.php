<?php
    header("Content-Type: text/plain");
    spl_autoload_register(function($class) {
        include '../../classes/' . $class . '.class.php';
    });

    $res="";
    if(isset($_POST['idCli']) && !empty($_POST['idCli']))   {
        $manager = new clientManager(database::getDB());
        $client = $manager->get($_POST['idCli']);
    }
    if ($client!=false) {
        $res = $client->getMail();
    }
    echo $res;