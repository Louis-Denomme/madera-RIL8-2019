<div class="row justify-content-center flex-fill">
    <div class="col-6 bg-danger">
        <?= $viewEnAttente ?>
    </div>
    <div class="col-6 bg-success">
        <?= $viewAccepte ?>
    </div>
    <div class="col-6 bg-info">
        <div class="container-fluid p-2">
            <div class="row">
                <div class="col">
                    <h2>Créer un devis</h2>
                </div>
            </div>
            <?php if (!empty($clients)) { ?>
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
                            <option value="" disabled selected>-- Choix du client --</option>
                            <?php foreach ($clients as $client) { ?>
                                <option value="<?= $client['id'] ?>"><?= $client['nom'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-right">
                        <input type="submit" class="btn btn-light"/>
                    </div>
                </div>
                <?php

                echo form_close();
                ?>
            <?php } else { ?>
                <b>Aucun client.</b> <br/>
            <?php } ?>
            <b class="text-white underline-hover" onclick="Client.openDialogAddOrUpdateNewClient('add')">En ajouter
                un nouveau ?</b>
        </div>

    </div>
    <div class="col-6 bg-warning">
        <?= $viewRefuse ?>
    </div>
</div>