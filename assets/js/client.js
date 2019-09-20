/* global base_url, Window */
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
				alert('Erreur lors de l\'ajout de client');
			}
		});
	}
};