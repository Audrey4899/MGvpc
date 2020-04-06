<!-- AFFICHAGE DU HAUT DE LA PAGE -->
<?php
    include ('inc/header.inc.php');
    if(isset($_SESSION))
    {
        unset($_SESSION['idE']);
    }
?>

<!-- AFFICHAGE DU CONTENU DE LA PAGE -->
<div id="content">

    <!-- Affichage du contenu "utile" de la page -->
        <br><br>
        <h2 style="text-align: center">Veuillez vous identifier :</h2>
        <h4 style="text-align: center"><i>(Essayez avec test@gmail.com / test)</i></h4>
        <br>
        <div id="cnx">
            <form action="connexion.php" method="POST">
                <div class="login">
                    <label><b>Login : </b></label>
                    <input required type="email" name="loginEmpl" style="margin-left: 59px; border-radius: 5px"/>
                </div>
                <br>
                <div class="mdp">
                    <label><b>Mot de passe : </b></label>
                    <input required style="margin-left: 10px; border-radius: 5px" type="password" name="mdpEmpl"/>
                    <br><br><br>
                    <input class="btsub" type="submit" value="Valider"/>
                    <br><br><br>
                </div>
            </form>
        </div>
    
    <!-- rétablissement du flux normal -->
    <div style="clear:both;"></div>

</div>

<!-- AFFICHAGE DU BAS DE PAGE -->
<?php
    include ("inc/footer.inc.php");
?>