<div class="container h-100 bg-light p-5">
    <div class="row">
        <div class="col mt-6">
            <p>Client : <?= $client->nom ?></p>
            <p>Adresse : <?=$devis->adresse?></p>
        </div>

        <div class="col mt-6">
            <div class="d-flex justify-content-end text-capitalize font-italic">Commercial : admin ADMIN</div>
        </div>
    </div>
    <div class="row mt-10 pt-10 border-bottom border-dark">
        <h2><?php if($devis->etat == 4) { echo "Facture";}else{echo "Devis"; if($devis->etat == 3) { echo "validé"; }}?> n° <?= $devis->id ?>
            <span class="font-weight-light font-italic
            <?php if($devis->etat < 4){
                echo "text-warning";
            }elseif ($devis->etat <5){
                echo "text-success";
            } else{
                echo "text-danger";
            }?>
            " style="font-size: 20px;">-
            <?= $etatLibelle ?>
            </span></h2>
    </div>
    <div class="col mt-10 h30 border-bottom border-dark">
        <?php foreach ($modules as $module) { ?>
            <div class="row ml-20 border-bottom border-secondary">
                <span class="text-capitalize "><?= $module->moduleLib ?></span>
                <span>-</span>
                <span class="font-weight-light font-italic"><?= $module->reference ?></span>
            </div>
        <?php } ?>
    </div>
    <div class="row mt-10">
        <div class="col">
            <div class="row">
                <div class="col d-flex justify-content-start font-weight-normal">TOTAL HT:</div>
                <div class="col d-flex justify-content-end"><?= trim(strrev(chunk_split(strrev($devis->prixTotal), 3, ' '))); ?> €</div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-start font-weight-bold">TOTAL TTC(TVA - 20%):</div>
                <div class="col d-flex justify-content-end font-weight-bold"><?= trim(strrev(chunk_split(strrev($devis->prixTotal + $devis->prixTotal*0.2), 3, ' '))); ?> €</div>
            </div>
        </div>
    </div>
    <div class="container bg-dark mt-3 d-flex justify-content-around align-items-center fixed-bottom border border-dark" style="height: 60px;">
        <?php if($devis->etat == 1) { ?>
            <a href="<?php echo base_url(); ?>index.php/Devis/config/<?=$devis->id?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Modifier</a>
        <?php } ?>
        <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Imprimer</a>
        <a type="button" class="btn btn-<?php if($devis->etat == 4){echo "primary";}else{echo "secondary";}?> btn-lg active" <?php if($devis->etat != 4){echo "disabled";}?>>Imprimer le dossier technique</a>
        <div>
            <?php if($devis->etat == 1 || $devis->etat == 3) { ?>
                <a href="<?php echo base_url(); ?>index.php/Devis/changeState/<?=$devis->id?>" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Valider</a>
                <a href="<?php echo base_url(); ?>index.php/Devis/refuseDevis/<?=$devis->id?>" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Refuser</a>
            <?php } else if($devis->etat == 4) { ?>
                <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Calendrier de paiement</a>
            <?php } else {?>
                <button href="#" class="btn btn-light btn-lg" role="button" aria-pressed="false" disabled>Attente...</button>
            <?php } ?>
        </div>

    </div>
</div>