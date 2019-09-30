<div class="container-fluid p-2">
    <div class="row">
        <div class="cercle <?php if($etat == 1){echo "cercle-orange";}elseif ($etat == 2){echo "cercle-green";}elseif ($etat == 3){echo "cercle-red";}?>"></div>
        <div class="col">
            <h2><?= $title ?></h2>
        </div>
    </div>
    <div class="row border p-3 overflow-auto">
        <div class="col">
            <ul>
                <?php foreach ($devisList as $devis) { ?>
                    <li><a class="linkDevis" href="<?= base_url() ?>index.php/devis/recap/<?=$devis ?>">Devis <?= $devis ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>