<div class="container bg-light h-100">
    <div class="row mt-5">
        <div class="col">
            <h2>Modules</h2>
        </div>
    </div>
    <?php foreach ($devisModules as $moduleDevis) { ?>
        <div class="row mt-3">
            <div class="col-11">
                <?php echo form_open('index.php/Devis/editModule'); ?>
                <input type="hidden" name="numModule" value="<?= $moduleDevis['num'] ?>" />
                <select name="idModule" class="form-control" onchange="this.form.submit()">
                    <?php foreach ($modulesGroups as $name => $modules) { ?>
                        <optgroup label="<?= $name ?>">
                            <?php foreach ($modules as $module) { ?>
                                <option <?= $module['id'] == $moduleDevis['id'] ? 'selected' : '' ?> value="<?= $module['id'] ?>"><?= $module['nom'] ?> - <?= $module['ref'] ?></option>
                            <?php } ?>
                        </optgroup>
                    <?php } ?>
                </select>
                <?php echo form_close(); ?>
            </div>
            <div class="col-1">
                <a href="<?php echo base_url(); ?>index.php/Devis/delModule?num=<?= $moduleDevis['num'] ?>">X</a>
            </div>
        </div>
    <?php } ?>

    <?php echo form_open('index.php/Devis/addModule/'.$devis->id); ?>
    <div class="row mt-3">
        <div class="col">
            <select name="idModule" class="form-control" onchange="this.form.submit()">
                <option disabled selected>-- Ajouter un module --</option>
                <?php foreach ($modulesGroups as $name => $modules) { ?>
                    <optgroup label="<?= $name ?>">
                        <?php foreach ($modules as $module) { ?>
                            <option value="<?= $module['id'] ?>"><?= $module['nom'] ?> - <?= $module['ref'] ?></option>
                        <?php } ?>
                    </optgroup>
                <?php } ?>
            </select>
        </div>
    </div>
    <?php echo form_close(); ?>

    <div class="row mt-5">
        <div class="col text-left">
            <span>Prix total : <?= $devis->prixTotal; ?>€</span>
        </div>
        <div class="col text-right">
            <a href="<?php echo base_url(); ?>index.php/Devis/insert" class="btn btn-success">Valider</a>
        </div>
    </div>
</div>