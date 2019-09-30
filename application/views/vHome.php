<div class="row justify-content-center flex-fill">
    <div class="col-6 bg-danger">
        <?= $viewEnAttente ?>
    </div>
    <div class="col-6 bg-success">
        <?= $viewAccepte ?>
    </div>
    <div class="col-6 bg-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h2>Créer un devis</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Choix du client</label>
                </div>
            </div>
            <?php
            echo form_open('index.php/Devis/new');

            echo validation_errors();
            ?>
            <div class="row">
                <div class="col">
                    <select name="idClient" class="form-control">
                        <option disabled selected>-- Choix du client --</option>
                        <?php foreach ($clients as $client) { ?>
                            <option value="<?= $client['id'] ?>"><?= $client['nom'] . ' ' . $client['prenom'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-right">
                    <input type="submit" class="btn btn-light" />
                </div>
            </div>
            <?php

            echo form_close();
            ?>
        </div>

    </div>
    <div class="col-6 bg-warning">
        <?= $viewRefuse ?>
    </div>
</div>