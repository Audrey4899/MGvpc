<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

include ("header.inc.php");
include ("menu.inc.php");
spl_autoload_register(function($class) {
    include '../../classes/' . $class . '.class.php';
});
if (isset($_SESSION['idE']))
{
    $manaEmpl = new employeManager(database::getDB());
    ?>
    <!-- AFFICHAGE DU CENTRE DE PAGE -->
    <div id="content">

        <!-- Affichage du contenu "utile" de la page -->
        <div class="left">
            <?php 
                $prenomE = $manaEmpl->get($_SESSION['idE'])->getPrenom();
                $nomE = $manaEmpl->get($_SESSION['idE'])->getNom();
            ?>
            <img id="banner" src="images/warehouse.jpg" alt="Entrepot">
            <br><h2 style="text-align: center">Bienvenue sur MG Apps Portal <?php echo "<b>".$prenomE." ".$nomE."</b>"?> !</h2>
        </div>

        <!-- Affichage du menu de droite -->
        <?php
            include ("right.inc.php");
        ?>

        <!-- rétablissement du flux normal -->
        <div style="clear:both;"></div>
    </div>
<?php
}

else
{
    header('location:index.php');
}

include ("footer.inc.php");

