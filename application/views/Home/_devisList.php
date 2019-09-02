<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2><?= $title ?></h2>
        </div>
    </div>
    <div class="row border p-3">
        <div class="col">
            <ul>
                <?php foreach ($devisList as $devis) { ?>
                    <li><a href="<?= base_url() ?>index.php/devis/TODO_ID_DEVIS">Devis <?= $devis ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>