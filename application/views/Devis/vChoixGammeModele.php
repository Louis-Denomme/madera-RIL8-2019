<div class="container-fluid">

    <?php echo form_open('index.php/Devis/new'); ?>
    <div class="row pt-5">
        <div class="col">
            <select name="idGamme" class="form-control" onchange="this.form.submit()">
                <option disabled selected>-- Choix de la gamme -- </option>
                <?php foreach ($gammes as $gamme) { ?>
                    <option <?= (array_key_exists('idGamme', $devis) && $devis['idGamme'] == $gamme['id']) ? 'selected' : '' ?> value="<?= $gamme['id'] ?>"><?= $gamme['nom'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <?php echo form_close(); ?>


    <?php echo form_open('index.php/Devis/new'); ?>

    <div class="row pt-3">
        <div class="col">
            <select name="idModele" class="form-control" onchange="this.form.submit()">
                <option disabled selected>-- Choix du Modele -- </option>
                <?php foreach ($modeles as $modele) { ?>
                    <option <?= (array_key_exists('idModele', $devis) && $devis['idModele'] == $modele['id']) ? 'selected' : '' ?> value="<?= $modele['id'] ?>"><?= $modele['nom'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <?php echo form_close(); ?>