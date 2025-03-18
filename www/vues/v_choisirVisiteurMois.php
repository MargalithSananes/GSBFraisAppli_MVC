<h2>Valider la fiche de frais</h2>
<div class="row">
    <div class="col-md-4">
        <form action="index.php?uc=validerFrais&action=Valider" 
              method="post" role="form">
            <div class="form-group">
                <label for="lstMois" accesskey="n">Selectionner un Visiteur: </label>
                <select id="lstMois" name="visiteur" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom. ' ' . $prenom ?> </option>
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
                <label for="lstMois" accesskey="n">Selectionner un Mois : </label>
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
            <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
        </form>
    </div>
    </div>
