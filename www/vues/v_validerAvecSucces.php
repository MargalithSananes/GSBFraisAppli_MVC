<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<h3>Valide avec succes:</h3>
<?php echo $vstNom . ' ' . $vstPrenom; ?><p>a ete valider avec succes pour le mois de</p><?php echo $mois2; ?>
<div class="row">
    <div class="panel panel-info">
        <div style="background-color:  orange; color:white" class="panel-heading">Total</div>


        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="libelle">Montant frais forfait</th> 
                    <th class="date">Montant frais hors forfait</th>
                    <th class="montant">Montant total valide</th>  
                </tr>
            </thead>  
            <tbody>
            <td><?php echo $montantfraisforfait[0][0]; ?></td>
            <td><?php echo $montantfraishorsforfait[0][0]; ?></td>
            <td><?php echo $montantotal; ?></td>

            </tbody>  
        </table>
    </div>
</div>
