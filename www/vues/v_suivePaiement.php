<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>


<form method="post" 
      action="index.php?uc=suivrePaiment&action=valider" 
      role="form"> 

    <div class="col-md-4">

        <div class="form-group">
            <label for="lstVisitmois" accesskey="n">Selectionner un Visiteur et un mois: </label>
            <select id="lstVisitmois" name="lstVisitmois" class="form-control">
                <?php
                foreach ($lstVisit as $unVisiteur) {
                    $id = $unVisiteur['idvisiteur'];
                    $mois = $unVisiteur['mois'];
                    $nom = $unVisiteur['nom'];
                    $prenom = $unVisiteur['prenom'];
                    $numAnnee = substr($unVst['mois'], 0, 4);
                    $numMois = substr($unVst['mois'], 4, 2);
                    if ($id == $visiteurASelectionner) {
                        ?>
                        <option selected value="<?php echo $id, $mois ?>">
                            <?php echo $nom . ' ' . $prenom . ' - ' . $numAnnee . '/' . $numMois ?> </option>
                            <?php
                    } else {
                        ?>
                        <option value="<?php echo $id, $mois ?>">
                            <?php echo $nom . '  ' . $prenom . ' - ' . $numAnnee . '/' . $numMois ?> </option>
                            <?php
                    }
                }
                ?>
            </select>
        </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <button class="btn btn-success" type="submit">Valider</button>
</form>