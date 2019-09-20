<br/>
<h1 class="">Clients <br/><small class="text-muted">Récapitulatif</small></h1>
<br/>
<div class="container">
	<div class="row">
		<button class="btn btn-primary" onclick="Client.openDialogAddOrUpdateNewClient('add')"> Ajouter un nouveau client</button>
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
				<? foreach($clients as $c) { ?>
					<tr>
						<td><?= $c['nom'] ?></td>
						<td><?= $c['email'] ?></td>
						<td><?= $c['telephone'] ?></td>
						<td><?= dateSql2fr($c['dateCreate']) ?></td>
						<td><?= $c['nb_devis'] ?></td>
						<td>
							<button class="btn btn-sm btn-primary" onclick="Client.openDialogAddOrUpdateNewClient('update', <?=$c['id']?>)">Modifier</button>
							<button class="btn btn-sm btn-danger">Supprimer</button>
						</td>
					</tr>
				<? } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal ajout client -->
<div class="modal fade" id="MODAL-AJOUT-CLIENT" role="dialog" aria-labelledby="MODAL-AJOUT-CLIENT">
</div>