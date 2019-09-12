<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Ajouter un nouveau client</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label class="col-form-label"><b>Nom : </b></label>
				<input type="text" name="nomClient" class="form-control"/>
			</div>
			<div class="form-group">
				<label class="col-form-label"><b>Email :</b></label>
				<input type="text" name="emailClient" class="form-control"/>
			</div>
			<div class="form-group">
				<label class="col-form-label"><b>Téléphone :</b></label>
				<input type="text" name="telClient" class="form-control"/>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Fermer</button>
			<button type="button" class="btn btn-success" onclick="Client.addNewClient()">Valider</button>
		</div>
	</div>
</div>