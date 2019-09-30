<div class="container flex-fill" style="overflow-x: hidden">
    <div class="card col-12" style="margin: 5px">
        <div class="card-body">
            <h5 class="card-header">Accueil - Devis</h5>
            <div class="card-body" style="max-height:22rem; overflow-y: auto;" >
                <ul class="nav nav-tabs col-12" id="tabs-home" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#devis-attente"
                           role="tab"
                           aria-controls="home"
                           aria-selected="true">Devis en attente de validation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#devis-refuse"
                           role="tab"
                           aria-controls="profile"
                           aria-selected="false">Devis refusés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#devis-accepte"
                           role="tab"
                           aria-controls="contact"
                           aria-selected="false">Devis acceptés</a>
                    </li>
                </ul>
                <div class="tab-content col-12">
                    <div class="tab-pane show active" id="devis-attente" role="tabpanel"
                         aria-labelledby="devis-attente-tab">
                        <?= $viewEnAttente ?>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="devis-refuse" aria-labelledby="devis-refuse-tab">
                        <?= $viewRefuse ?>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="devis-accepte" aria-labelledby="devis-accepte-tab">
                        <?= $viewAccepte ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="container row">
                <div class="col-6"><b>Enregister un nouveau devis ?</b></div>
                <div class="col-6 d-flex justify-content-end"><button class="btn btn-primary btn-sm" onclick="Client.openDialogAddOrUpdateNewClient('add', event)">
                    Ajouter un nouveau
                    client ?
                </button>
                </div>
            </div>
            <br/>
            <?php if (!empty($clients)) { ?>
                <?php
                echo form_open('index.php/Devis/new');
                echo validation_errors();
                ?>
                <div class="row">
                    <div class="col-6">
                        <label>Choix du client : </label>
                        <select name="idClient" class="form-control form-control-sm">
                            <option value="" disabled selected>-- Choix du client --</option>
                            <?php foreach ($clients as $client) { ?>
                                <option value="<?= $client['id'] ?>"><?= $client['nom'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-left">
                        <input type="submit" class="btn btn-success"/>
                    </div>
                </div>
                <?php
                echo form_close();
                ?>
                <br/>

            <?php } else { ?>
                <b>Aucun client.</b> <br/>
            <?php } ?>
        </div>
    </div>
</div>