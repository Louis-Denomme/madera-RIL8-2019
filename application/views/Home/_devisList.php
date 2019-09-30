<?php if (!empty($devisList)) { ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>
                Numéro
            </th>
            <th>
                Date de création
            </th>
            <th>
                Client
            </th>

            <th>
               Modèle
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($devisList as $devis) { ?>
            <tr onclick="location.href='<?= base_url() ?>index.php/devis/recap/<?= $devis['id'] ?>'"
                style="cursor: pointer">
                <td>
                    <?= $devis['id'] ?>
                </td>
                <td>
                    <?= dateSql2fr($devis['dateCreation']) ?>
                </td>
                <td>
                    <?= $devis['nom'] ?>
                </td>
                <td>
                    <?= $devis['libelle'] ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <br/>
    <p>
        <b>Aucun devis de ce type pour le moment...</b>
    </p>
<?php } ?>
