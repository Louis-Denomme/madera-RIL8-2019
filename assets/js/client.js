/* global base_url, Window, Tools */
Client = {
	openDialogAddOrUpdateNewClient: function (action, id) {
		if(id !== undefined)
			var url = base_url + 'index.php/Client/openDialogAddOrUpdateNewClient/' + action + '/' + id;
		else 
			var url = base_url + 'index.php/Client/openDialogAddOrUpdateNewClient/' + action;
			
		$.ajax({
			type: 'GET',
			url: url,
			success: function (html) {
				if (html.length > 0) {
					$('#MODAL-AJOUT-CLIENT').appendTo('body');
					$('#MODAL-AJOUT-CLIENT').html(html);
					$('#MODAL-AJOUT-CLIENT').modal();
				}
			},
			error: function () {
				alert('Erreur lors de l\'ouverture de la dialog d\'ajout de client');
			}
		});
	},

	addOrUpdateNewClient: function (id) {
		var data = {};
		$('#MODAL-AJOUT-CLIENT').find('input[type=text]').each(function () {
			data[$(this).attr('name')] = $(this).val();
		});
		data.id = id;
		if(data.nomClient.length === 0) {
			alert('Erreur, le nom du client est obligatoire');
			return false;
		}
		if(data.emailClient.length === 0) {
			alert('Erreur, l\'email du client est obligatoire');
			return false;
		}
		if(data.telClient.length === 0) {
			alert('Erreur, le téléphone du client est obligatoire');
			return false;
		}
		
		if(!Tools.isPhone(data.telClient)) {
			alert('Erreur, le numéro de téléphone n\'est pas correct');
			return false;
		}
		
		$.ajax({
			type: 'POST',
			url: base_url + 'index.php/Client/addOrUpdateNewClient',
			dataType: 'json',
			data: data,
			success: function (callback) {
				if (callback.success !== undefined) {
					$('#MODAL-AJOUT-CLIENT').modal('hide');
					document.location.reload();
				} else if (callback.error !== undefined) {
					alert(callback.error);
				}
			},
			error: function () {
				if(id === undefined)
					alert('Erreur lors de l\'ajout de client');
				else
					alert('Erreur lors de la modif du client');
					
			}
		});
	},
	
	deleteClient: function(id) {
		if(!confirm('Confirmer la suppression ?')){
			return false;
		}
		var data = {
			id:id
		};
		$.ajax({
			type: 'POST',
			url: base_url + 'index.php/Client/deleteClient',
			dataType: 'json',
			data: data,
			success: function (callback) {
				if (callback.success !== undefined) {
					$('#MODAL-AJOUT-CLIENT').modal('hide');
					document.location.reload();
				} else if (callback.error !== undefined) {
					alert(callback.error);
				}
			},
			error: function () {
				alert('Erreur lors de la suppression du client');
			}
		});
	}
};