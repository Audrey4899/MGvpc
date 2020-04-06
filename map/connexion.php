<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

require_once('../classes/employeManager.class.php');

$loginE = $_POST['loginEmpl'];
$mdpE = $_POST['mdpEmpl'];

if(isset($_POST['mdpEmpl']) && !empty($_POST['mdpEmpl']) && isset($_POST['loginEmpl']) && !empty($_POST['loginEmpl']))
{
    $manaEmpl = new employeManager(database::getDB());
    $cnx = $manaEmpl->getList("WHERE mailEmploye='".$_POST['loginEmpl']."' AND mdpEmploye ='".$_POST['mdpEmpl']."'");
    if(!empty($cnx)) //On vérifie que cnx contienne un résultat
    {
        include ('inc/page_bienvenue.php');
        $_SESSION['idE']=$cnx[0]->getId();
    }
    else
    {
        include ("inc/header.inc.php");
        echo '<h2>Login ou mot de passe incorrect, veuillez réessayer.<br><br>';
        echo '<h4>Vous allez être redirigé automatiquement.</h4>';
        header( "refresh:5;url=index.php");
        include ("inc/footer.inc.php");
    }
}