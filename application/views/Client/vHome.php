<div class="container card">
    <br/>
    <h1 class="">Clients <br/>
        <small class="text-muted">Récapitulatif</small>
    </h1>
    <br/>
    <div class="container">
        <?php if (!empty($clients)) { ?>
            <div class="row">
                <button class="btn btn-primary" onclick="Client.openDialogAddOrUpdateNewClient('add')"> Ajouter un
                    nouveau client
                </button>
            </div>
            <br/>
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Date de création</th>
                        <th>Nombre de devis</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($clients as $c) { ?>
                        <tr>
                            <td><?= $c['nom'] ?></td>
                            <td><?= $c['email'] ?></td>
                            <td><?= $c['telephone'] ?></td>
                            <td><?= dateSql2fr($c['dateCreate']) ?></td>
                            <td><?= $c['nb_devis'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary"
                                        onclick="Client.openDialogAddOrUpdateNewClient('update', <?= $c['id'] ?>)">
                                    Modifier
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="Client.deleteClient(<?= $c['id'] ?>)">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="row flex">
                <div class="col" style="text-align: center">
                    <h2>Aucun client connu. Veuillez ajouter un nouveau client</h2>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col" style="text-align: center">
                    <button class="btn btn-lg btn-primary" onclick="Client.openDialogAddOrUpdateNewClient('add')">
                        Ajouter un nouveau client
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>