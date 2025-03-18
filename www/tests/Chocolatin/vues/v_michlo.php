<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<section class="row">
    
        <article class="card col-md-3 p-2">
            <div class="card col border-choc">
                <div class="card-body py-0">
                    <h4 class="fw-bold">Michlo 1</h4>
                </div>
                <div class="card-body">
                <ul class="list-unstyled">
                   <?php foreach ($michlo1 as $produit) { ?>
                        <li class="list-group-item">
                            <h5 class="mb-1"><?= htmlspecialchars($produit['nom']) ?></h5>
                            <p class="mb-1"><?= htmlspecialchars($produit['description']) ?></p>
                            <small>Packaging : <?= htmlspecialchars($produit['packaging']) ?></small><br>
                        </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
        </article>
  



    
        <article class="card col-md-3 p-2">
            <div class="card col border-choc">
                <div class="card-body py-0">
                    <h4 class="fw-bold">Michlo 2</h4>
                </div>
                <div class="card-body">
                <ul class="list-unstyled">
                   <?php foreach ($michlo2 as $produit) { ?>
                        <li class="list-group-item">
                            <h5 class="mb-1"><?= htmlspecialchars($produit['nom']) ?></h5>
                            <p class="mb-1"><?= htmlspecialchars($produit['description']) ?></p>
                            <small>Packaging : <?= htmlspecialchars($produit['packaging']) ?></small><br>
                        </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
        </article>
  
    
        <article class="card col-md-3 p-2">
            <div class="card col border-choc">
                <div class="card-body py-0">
                    <h4 class="fw-bold">Michlo 3</h4>
                </div>
                <div class="card-body">
                <ul class="list-unstyled">
                   <?php foreach ($michlo3 as $produit) { ?>
                        <li class="list-group-item">
                            <h5 class="mb-1"><?= htmlspecialchars($produit['nom']) ?></h5>
                            <p class="mb-1"><?= htmlspecialchars($produit['description']) ?></p>
                            <small>Packaging : <?= htmlspecialchars($produit['packaging']) ?></small><br>
                        </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
        </article>
        <article class="card col-md-3 p-2">
            <div class="card col border-choc">
                <div class="card-body py-0">
                    <h4 class="fw-bold">Michlo 4</h4>
                </div>
                <div class="card-body">
                <ul class="list-unstyled">
                   <?php foreach ($michlo4 as $produit) { ?>
                        <li class="list-group-item">
                            <h5 class="mb-1"><?= htmlspecialchars($produit['nom']) ?></h5>
                            <p class="mb-1"><?= htmlspecialchars($produit['description']) ?></p>
                            <small>Packaging : <?= htmlspecialchars($produit['packaging']) ?></small><br>
                        </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
        </article>
  
</section>


