<?php
    header("Content-Type: text/plain");

    spl_autoload_register(function($class) {
        include '../../classes/' . $class . '.class.php';
    });

    $res="";
    if(isset($_POST['reference']) && !empty($_POST['reference']))   {
        $manager = new produitManager(database::getDB());
        $prod = $manager->get($_POST['reference']);
    }
    if ($prod!=false) {
        $res = $prod->getLib();
    }
    echo $res;