<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<!--<h2>Valider la fiche de frais</h2>
<h3>Eléments forfaitisés</h3>
<label for="lstMois" accesskey="n">Forfait Etape: </label>
<select id="lstMois" name="lstMois" class="form-control"></select>
<label for="lstMois" accesskey="n">Forfait Etape: </label>
<select id="lstMois" name="lstMois" class="form-control">



</select>-->
<form action="index.php?uc=validerFrais&action=corrigerMajFraisForfait" method="post" role="form">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="lstMois" accesskey="n">Choisir le Visiteur: </label>
                <select id="lstMois" name="visiteur" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    
                </select>
            </div>
            <div class="col-md-4>
                 <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="mois" class="form-control">
                    <?php
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numMois = $unMois['numMois'];
                        $numAnnee = $unMois['numAnnee'];

                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
            <br>
        </div>

    </div>
    <div class="row">    
        <h2><font color="orange">Valider la fiche de frais</font>
        </h2>
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Restaurer</button>
            </fieldset>
        </div>
    </div>
</form>
<form  method="post" 
       action="index.php?uc=validerFrais&action=corrigerMajFraisHorsForfait"
       role="form">   
    <input type="hidden" name="visiteur" value="<?php echo $visiteurASelectionner ?>" >
    <input type="hidden" name="mois" value="<?php echo $moisASelectionner ?>" >
    <hr>
    <div class="row">
        <div style= 'border-color: orange' class="panel panel-info">
            <div style ='background-color: orange' class="panel-heading"> Descriptif des éléments hors forfait</div>
            <table class= "table table-bordered table-responsive" >
                <thead>
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>  
                        <th class="montant">Montant</th>  
                        <th class="action">&nbsp;</th> 
                    </tr>
                </thead>  
                <tbody>
                    <?php
                    foreach ($lesFraisHorsForfait as $lesFraisHorsForfait) {
                        $libelle = htmlspecialchars($lesFraisHorsForfait['libelle']);
                        $date = $lesFraisHorsForfait['date'];
                        $montant = $lesFraisHorsForfait['montant'];
                        $id = $lesFraisHorsForfait['id'];
                        ?>           
                        <tr>
                            <td><input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="text" name="date" value="<?php echo $date ?>"></td>
                            <td><input type="text" name="libelle" value="<?php echo $libelle ?>"></td>
                            <td><input type="text" name="montant" value="<?php echo $montant ?>"</td>
                            <td> 
                                <input class="btn btn-success" id= "corriger" name= "Corriger" value="Corriger" type="submit">
                                <input class="btn btn-success" id= "reporter" name= "Reporter" value= "Reporter" type="submit">
                                <input class="btn btn-danger" id= "suppimer" name= "Supprimer" value ="Suppimer" type="submit"></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>  
            </table>
        </div>
    </div>
</form>
<label for="lstMois" accesskey="n">Nombre de justificatifs: </label>
<form action="index.php?uc=validerFrais&action=btnvalider" method="post" role="form">
    
    <input type="hidden" name="lstv" value="<?php echo $visiteurASelectionner ?>" >
    <input type="hidden" name="lstMois" value="<?php echo $moisASelectionner ?>" >
<input type= "text" id="lstMois" name="justificatif" class="form-control">
<br>
<button class="btn btn-success" type="submit">Valider</button>



</form>

