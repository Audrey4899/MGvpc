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
{
?>
    <head>
        <link rel="stylesheet" href="<?php echo $base_url."style/style.css"; ?>">
    </head>
    <!-- AFFICHAGE DU CONTENU DE LA PAGE -->
    <div id="content">

        <!-- Affichage du contenu "utile" de la page -->
        <div class="left">
            <img id="banner" src="../images/warehouse.jpg" alt="Entrepot">
            <br>
            <h2>Incident #<?php echo $_GET['idProb']?></h2>
            <div id="ficheProb" onload="verifEtat();">
                <form method="get" action="pb_update.php">
                    <?php $managerProb = new problemesavManager(database::getDB());?>
                    <table>
                        <tr>
                            <td class="supp"></td>
                            <td width="100"><b>Incident n° :</b></td>
                            <td width="30"><input class="infos" readonly name="idProb" style="width: 80px;text-align: center;" value="<?php echo $_GET['idProb']?>"/>
                            <td width="100"><b>Géré par :</b></td>
                            <td><input class="infos" readonly name="prenomEmploye" style="width: 80px;text-align: center;" value="<?php echo $managerProb->get($_GET['idProb'])->getEmploye()->getPrenom()?>"/>
                            <input class="infos" readonly name="nomEmploye" style="width: 80px;text-align: center;" value="<?php echo strtoupper($managerProb->get($_GET['idProb'])->getEmploye()->getNom())?>"/>
                            <td class="supp"></td>
                        </tr>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <th></th><th>Date</th><th>Produit concerné</th><th>Client</th><th></th>
                        </tr>
                        <tr>
                            <td class="supp"></td>
                            <td><input class="infos" readonly name="dateProb" style="width: 80px;text-align: center;background-color: #dddddd" value="<?php echo $managerProb->get($_GET['idProb'])->getDate()?>"/></td>
                            <td><textarea style="resize: none; text-align: left" class="infos" rows="3" cols="20" readonly name='ref'><?php echo $managerProb->get($_GET['idProb'])->getProduit()->getLib()?></textarea></td>
                            <td><input class="infos" readonly name="prenomClient" style="width: 80px;text-align: center;background-color: #dddddd" value="<?php echo $managerProb->get($_GET['idProb'])->getClient()->getPrenom()?>"/>
                            <input class="infos" readonly name="nomClient" style="width: 100px;text-align: center;background-color: #dddddd" value=" <?php echo strtoupper($managerProb->get($_GET['idProb'])->getClient()->getNom())?>"/></td>
                            <td class="supp"></td>
                        </tr>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <th></th><th>Intitulé</th><th>Description</th><th></th>
                        </tr>
                        <tr>
                            <td class="supp"></td>
                            <td><input class="infos" readonly name="titreProb" required style="width: 200px;text-align: left;background-color: #dddddd" value="<?php echo $managerProb->get($_GET['idProb'])->getTitre()?>"/></td>
                            <td><textarea class="infos" style="resize: none; text-align: left" readonly rows="5" cols="30" name="descProb"><?php echo $managerProb->get($_GET['idProb'])->getDesc()?></textarea></td>
                            <td class="supp"></td>
                        </tr>
                    </table>
                    <br><br>
                    <table id="infosProbleme">
                        <tr>
                            <th></th><th>Etat</th><th>Procédure choisie</th><th></th>
                        </tr>
                        <tr>
                            <td class="supp"></td>
                            <td>
                                <select id="etat" name="etat">
                                    <?php echo '<option>'.$managerProb->get($_GET['idProb'])->getEtat().'</option>';
                                    echo '<option> A traiter </option>';
                                    echo '<option> Terminé </option>';?>
                                </select>
                            </td>
                            <td>
                                <?php
                                $manager = new procedureSAVManager(database::getDB());
                                $proc = $manager->getList();

                                ?>
                                <select onchange="verifMontant(this);" name="solutionProb">
                                    <?php echo '<option>'.$managerProb->get($_GET['idProb'])->getProcedure()->getNomProc().'</option>';
                                    $i = 0;
                                    while ($i != sizeof($proc))
                                    {
                                        echo '<option>'.$proc[$i]->getNomProc().'</option>';
                                        $i++;
                                    } ?>
                                </select>
                            </td>
                            <td class="supp"></td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td class="supp"></td>
                            <td class="libtotal">Montant HT</td>
                            <td class="lib"></td>  
                            <?php
                                $TTC = $managerProb->get($_GET['idProb'])->getMontant();
                                $HT = $TTC/1.20;
                                $HT_arr = round(($HT) * 100) / 100;
                                $TVA = $TTC - $HT;
                                $TVA_arr = round(($TVA) * 100) / 100;
                                $idProcedure = $managerProb->get($_GET['idProb'])->getProcedure()->getId();
                                if($idProcedure != 3)
                                { 
                                    echo '<td><input onchange="calculeMontant();" id="totalht" class="total" name="totalht" style="text-align: center;" value="GRATUIT"/></td>';
                                }
                                else
                                {
                                    echo '<td><input onchange="calculeMontant();" id="totalht" class="total" type="number" min="1" step="0.01" name="totalht" value="'.$HT_arr.'" €/></td>';
                                }
                            ?>
                        </tr>
                        <tr>
                            <td class="supp"></td>
                            <td class="libtotal">Taux TVA</td>
                            <td class="lib"></td>
                            <td><input id="tauxtva" class="total" type="text" name="tauxtva" readonly  value="20%"/></td>
                        </tr>
                        <tr>
                            <td class="supp"></td>  
                            <td class="libtotal">Total TVA</td>
                            <td class="lib"></td>
                            <td><input id="totaltva" class="total" type="text" name="totaltva" readonly value="<?php echo $TVA_arr ?> €"/></td>
                        </tr>
                        <tr>
                            <td class="supp"></td>    
                            <td class="libtotalttc">Montant TTC</td>
                            <td class="lib"></td>
                            <td class="libtotalttc"><input id="totalttc" type="text" name="totalttc" readonly value="<?php echo $managerProb->get($_GET['idProb'])->getMontant().' €'?>"/></td>
                        </tr>
                        <tr>
                            <td class="supp"></td>
                            <td><br><input class="btsub" type="button" value="Retour" onclick="history.go(-1)"></td>
                            <td class="lib"></td> 
                            <td><br><input class="btsub" type="submit" value="Enregistrer"/></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        
<?php
}

else
{
    header('location:../index.php');  
}

include ("../inc/right.inc.php");
    ?>
    
    <!-- rétablissement du flux normal -->
    <div style="clear:both;"></div>

</div>

<!-- AFFICHAGE DU BAS DE PAGE -->
<?php
    include ("../inc/footer.inc.php");
?>
