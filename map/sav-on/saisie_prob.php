<!-- AFFICHAGE DU HAUT DE LA PAGE -->
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    include ("../inc/header.inc.php");
    include ("../inc/menu.inc.php");
    require_once '../../classes/procedureSAVManager.class.php';
    
if (isset($_SESSION['idE']))
{
?>
    
    <!-- AFFICHAGE DU CONTENU DE LA PAGE -->
    <div id="content">

        <!-- Affichage du contenu "utile" de la page -->
        <div class="left">

            <img id="banner" src="../images/warehouse.jpg" alt="Entrepot">
            <br>
            <h2>Saisie problème SAV</h2>  
            <div id="formSaisieProb">
                <form method="get" action="pb_enregistrer.php">
                    <table id="employe">
                        <tr>
                            <td class="supp"></td>
                            <td width="100"><b>Votre identifiant</b></td>
                            <td><input onchange="verifEmploye(this);" type="number" min="1" name="idEmploye" required style="width: 15%;text-align: center;"/></td>
                            <td id="msgEmploye"></td> <!-- Affiche OK ou employé inconnu -->
                        </tr>
                    </table>
                    <br><br>
                    <table id="numCli">
                      <tr>
                        <td class="supp"></td>
                        <td width="100"><b>Numéro client</b></td>
                        <td><input onchange="trouveNomClient(this);" type="number" min="1" class="numCli" name="numCli" required style="width: 15%;text-align: center;"/></td>
                        <td id="msgClient"></td> <!-- Affiche le nom complet du client -->
                      </tr>
                    </table>
                    <table id="infosCli">
                        <tr>
                            <th></th><th>Email</th><th>Téléphone</th><th>Adresse</th><th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td id="mailCli" style="width: 40%"/></td>
                            <td id="telCli" style="width: 20%"/></td>
                            <td id="adrCli" style="width: 40%"/></td>
                            <td></td>
                        </tr>
                    </table>
                    <br><br>
                    <table id="produit">
                        <tr>
                        <td class="supp"></td>
                        <td width="120"><b>Référence produit </b></td>
                        <td><input class="ref" name='ref' type="text" onchange="valideLigne(this);" required/></td> <!-- en HTML : pattern="[A-Za-z]{3}-[0-9]{4}\b" title="ABC-1234" -->
                        <td id="msgErreur"></td>
                      </tr>
                    </table>
                    <table id="infosProbleme">
                        <tr>
                            <th></th><th>Intitulé</th><th>Description</th><th>Procédure</th><th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="text" name="libProb" required/></td>
                            <td><textarea type="text" name="descProb" required rows="5" cols="30" style="resize: none"/></textarea></td>
                            <td>
                                <?php
                                $manager = new procedureSAVManager(database::getDB());
                                $proc = $manager->getList();

                                ?>
                                <select onchange="verifMontant(this);" name="solutionProb">
                                    <option>-- Choisir une procédure --</option>
                                    <?php
                                    $i = 0;
                                    while ($i != sizeof($proc))
                                    {
                                        echo '<option>'.$proc[$i]->getNomProc().'</option>';
                                        $i++;
                                    } ?>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td><td></td>
                        </tr>
                        <tr>
                        <td class="supp"></td>
                        <td class="libtotal">Montant HT</td>
                        <td class="lib"></td>  
                        <td><input min="1" onchange="calculeMontant();" id="totalht" class="total" type="number" name="totalht" readonly/></td>
                        <td class="supp"></td>
                    </tr>
                    <tr>
                        <td class="supp"></td>    
                        <td class="libtotal">Taux TVA</td>
                        <td class="lib"></td>
                        <td><input id="tauxtva" class="total" type="text" name="tauxtva" readonly  value="20%"/></td>
                        <td class="supp"></td>
                    </tr>
                    <tr>
                        <td class="supp"></td>
                        <td class="libtotal">Total TVA</td>
                        <td class="lib"></td>  
                        <td><input id="totaltva" class="total" type="text" name="totaltva" readonly value="0 €"/></td>
                        <td class="supp"></td>
                    </tr>
                    <tr>
                        <td class="supp"></td>      
                        <td class="libtotalttc">Montant TTC</td>
                        <td class="lib"></td>  
                        <td class="libtotalttc"><input id="totalttc" type="text" name="totalttc" readonly value="0 €"/></td>
                        <td class="supp"></td>
                    </tr>
                    <tr>
                        <td class="supp"></td>
                        <td class="lib"></td>
                        <td colspan="2"><br><input class="btsub" type="submit" value="Enregistrer"/></td>
                        <td class="supp"></td>
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
