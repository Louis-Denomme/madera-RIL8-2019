Parameter = {
    ChangeMode: function (value) {

        if (value == 'Modifier'){

            $('#idMargeCommerciale').prop('disabled', false);
            $('#idMargeEntreprise').prop('disabled', false);
            $('#idButtonCancel').prop('style', 'visibility : visible');
            $('#idButtonSubmit').prop('value', 'Valider');
        }

        if(value == 'Annuler') {
            $('#idMargeCommerciale').prop('disabled', true);
            $('#idMargeEntreprise').prop('disabled', true);
            $('#idButtonCancel').prop('style', 'visibility : hidden');
            $('#idButtonSubmit').prop('value', 'Modifier');
        }


        if(value == 'Valider'){

            var margeCommerciale = $('#idMargeCommerciale').val();
            var margeEntreprise = $('#idMargeEntreprise').val();
            if (margeCommerciale < 0 || margeCommerciale > 100){alert('Marge commerciale invalide'); return;}
            if (margeEntreprise < 0 || margeEntreprise > 100){alert('Marge entreprise  invalide'); return;}
            $.ajax({
                type: 'POST',
                url: base_url + 'index.php/cParameter/UpdateParameter',
                data : {margeCommerciale:margeCommerciale, margeEntreprise:margeEntreprise},
                dataType: 'json',
                success: function(callback) {
                    if(callback.success !== undefined) {
                        location.reload();
                    } else if (callback.error !== undefined) {
                        alert(callback.error);
                    }
                }, error: function () {
                    alert('Erreur lors de l\'appel serveur');
                }
            });
        }
    }


};