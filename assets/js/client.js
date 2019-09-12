/* global base_url, Window */
Client = {
	openDialogAddNewClient: function () {
		$.ajax({
			type: 'GET',
			url: base_url + 'index.php/Client/openDialogAddNewClient',
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

	addNewClient: function () {
		var data = {};
		$('#MODAL-AJOUT-CLIENT').find('input[type=text]').each(function () {
			data[$(this).attr('name')] = $(this).val();
		});
		$.ajax({
			type: 'POST',
			url: base_url + 'index.php/Client/addNewClient',
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