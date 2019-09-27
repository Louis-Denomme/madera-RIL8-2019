/* global base_url */
/*----------------------------------------------------------------------------*/
/*									FIX IE									  */
/*----------------------------------------------------------------------------*/
var console = console || {
    'log': function () {
    }
};

//Object.keys is not avaiable in IE < 9
if (!Object.keys) {
    Object.keys = function (obj) {
        var keys = [];
        for (var i in obj) {
            if (obj.hasOwnProperty(i)) {
                keys.push(i);
            }
        }
        return keys;
    };
}


/*----------------------------------------------------------------------------*/
/*								TOOLS - DIVERS								  */
/*----------------------------------------------------------------------------*/
var Tools = {
    redirection: function (lien, loader) {
		if(loader!==undefined){
			Tools.Dialog.Loader.show();
		}
        document.location.href = lien;
    },

    reloadPage: function () {
        location.reload();
    },

    //On masques tous les Qtip
    cleanAllQtip: function (force) {
        if (force) {
            $('.qtip').remove();
        } else {
            $('.qtip').not('.qtip-locked').remove();
        }
    },

    //random
    random: function (de, a) {
        return Math.floor(Math.random() * (de - a - 1) + a + 1);
    },

    // AutoSelcetion des minutes en fonction de l'heure
    autoSelectMinute: function (elem) {
        if ($(elem).val() !== '' && $(elem).nextAll('select.form-control').first().val() === '') {
            $(elem).nextAll('select.form-control').first().val('00');
        }
    },

    // Mise à jour des compteurs des menus
    updateMenuCounter: function () {
        $.ajax({
            type: 'GET',
            url: base_url + 'index.php/b2b/ajaxCommande/getMenuCounter/',
            dataType: 'json',
            success: function (data) {
                $('#side-menu ul li a .bubble').remove();
                for (var i in data) {
                    $('#side-menu ul li[data-etape_id="' + data[i].ETAPE_ID + '"] a:first').append(data[i].HTML);
                }
            }
        });
    },
	
	// Ouverture d'un datePicker	
	openDatePicker : function(item, enableOnReadonly){
		var target = null;
		if(enableOnReadonly === undefined){
			enableOnReadonly = true;
		}
		if(item.localName === 'input'){
			target = item;
		} else {
			target = $(item).find('input[type="text"]');
		}		
		
		$(target).focus().datepicker({
			language: 'fr',
			autoclose: true,
			todayHighlight: true,
			enableOnReadonly : enableOnReadonly
		});
		$(target).datepicker('show');		
	},
	
    // Ouverture d'un datePicker
    openDatePickerFirst : function(item, second){
        var target = null;
        if(item.localName === 'input'){
            target = item;
        } else {
            target = $(item).find('input[type="text"]');
        }

        $(target).focus().datepicker({
            language: 'fr',
            autoclose: true,
            todayHighlight: true
        }).on('changeDate',function(e){

            $(second).datepicker('destroy').datepicker({
                startDate: new Date(e.date),
                language: 'fr',
                autoclose: true,
                todayHighlight: true
            });
        });
        $(target).datepicker('show');
    },

    // Ouverture d'un datePicker
    openDatePickerSecond : function(item, first){
        var target = null;
        if(item.localName === 'input'){
            target = item;
        } else {
            target = $(item).find('input[type="text"]');
        }

        $(target).focus().datepicker({
            language: 'fr',
            autoclose: true,
            todayHighlight: true
        }).on('changeDate',function(e){
            $(first).datepicker('destroy').datepicker({
                endDate: new Date(e.date),
                language: 'fr',
                autoclose: true,
                todayHighlight: true
            });
        });
        $(target).datepicker('show');
    },

    changeFile: function(input) {
        var numFiles = input.files ? input.files.length : 1,
            label = input.value.replace(/\\/g, '/').replace(/.*\//, '');

        var input_text = $(input).parents('.input-group').find('input[type="text"]'),
            input = (input_text.length !== 0) ? input_text[0] : null,
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        if (input !== null) {
            input.value = log;
        }
    },
    
    changeImage: function(input) {

        var numFiles = input.files ? input.files.length : 1,
            label = input.value.replace(/\\/g, '/').replace(/.*\//, '');

        var input_text = $(input).parents('.input-group').find('input[type="text"]'),
            inputTarget = (input_text.length !== 0) ? input_text[0] : null,
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if(numFiles === 1){
            if(!Tools.File.estImage(input.files[0])){
                inputTarget.value = '';
                return false;
            }
        }else{
            for (var i = input.files.length - 1; i >= 0; i--) {
                if(!Tools.File.estImage(input.files[i])){
                    inputTarget.value = '';
                    return false;
                }
            }
        }

        if (inputTarget !== null) {
            inputTarget.value = log;
        }
    },

    changeFileXls: function(input) {

        var numFiles = input.files ? input.files.length : 1,
            label = input.value.replace(/\\/g, '/').replace(/.*\//, '');

        var input_text = $(input).parents('.input-group').find('input[type="text"]'),
            inputTarget = (input_text.length !== 0) ? input_text[0] : null,
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if(numFiles === 1){
            if(!Tools.File.estXsl(input.files[0])){
                inputTarget.value = '';
                return false;
            }
        }else{
            for (var i = input.files.length - 1; i >= 0; i--) {
                if(!Tools.File.estXsl(input.files[i])){
                    inputTarget.value = '';
                    return false;
                }
            }
        }

        if (inputTarget !== null) {
            inputTarget.value = log;
        }
    },

	isBoolean : function(val){
		if(val == '1' || val == '0' || val === true || val === false){
			return true;
		}
		return false;
	},
	
	isInt : function(val){
		if(parseInt(val) == val){
			return true;
		}
		return false;
	},
	
	isFloat : function(val){
		if(parseFloat(val) == val){
			return true;
		}
		return false;
	},
	
	isDate : function(val){
		if(val.match(/^\d{4}-\d{2}-\d{2}$/)){
			return true;
		}
		return false;
	},
	
	isDateFr : function(val){
		if(val.match(/^\d{2}[-\/]\d{2}[-\/]\d{4}$/)){
			return true;
		}
		return false;
	},
	
	isDatetime : function(val){
		if(val.match(/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/)){
			return true;
		}
		return false;
	},
	
	isAnnee : function(val){
		if(val.match(/^\d{4}$/)){
			return true;
		}
		return false;
	},
	
	isPhone : function(val){
		if(val.match(/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/)){
			return true;
		}
		var regexp = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
		if(regexp.test(val)){
			return true;
		}
		return false;
	},

	isNullOrEmpty:function(val){
    	return val === undefined || val === null || val === '';
	}
};


/*----------------------------------------------------------------------------*/
/*								TOOLS - COOKIE								  */
/*----------------------------------------------------------------------------*/
Tools.Cookie = {
    setCookie: function (name, value) {
        $.cookie(name, value, {path: '/'});
    },
    getCookie: function (name) {
        return $.cookie(name);
    },
    unsetCookie: function (name) {
        Tools.Cookie.setCookie(name, null);
    }
};


/*----------------------------------------------------------------------------*/
/*								TOOLS - DATE								  */
/*----------------------------------------------------------------------------*/
Tools.Date = {
    // Retourne les jours feriés
    getJoursFeries: function (an) {
        var JourAn = new Date(an, '00', '01');
        var FeteTravail = new Date(an, '04', '01');
        var Victoire1945 = new Date(an, '04', '08');
        var FeteNationale = new Date(an, '06', '14');
        var Assomption = new Date(an, '07', '15');
        var Toussaint = new Date(an, '10', '01');
        var Armistice = new Date(an, '10', '11');
        var Noel = new Date(an, '11', '25');
        //var SaintEtienne = new Date(an, '11', '26');

        var G = an % 19;
        var C = Math.floor(an / 100);
        var H = (C - Math.floor(C / 4) - Math.floor((8 * C + 13) / 25) + 19 * G + 15) % 30;
        var I = H - Math.floor(H / 28) * (1 - Math.floor(H / 28) * Math.floor(29 / (H + 1)) * Math.floor((21 - G) / 11));
        var J = (an * 1 + Math.floor(an / 4) + I + 2 - C + Math.floor(C / 4)) % 7;
        var L = I - J;
        var MoisPaques = 3 + Math.floor((L + 40) / 44);
        var JourPaques = L + 28 - 31 * Math.floor(MoisPaques / 4);
        //var Paques = new Date(an, MoisPaques-1, JourPaques);
        //var VendrediSaint = new Date(an, MoisPaques-1, JourPaques-2);
        var LundiPaques = new Date(an, MoisPaques - 1, JourPaques + 1);
        var Ascension = new Date(an, MoisPaques - 1, JourPaques + 39);
        //var Pentecote = new Date(an, MoisPaques-1, JourPaques+49);
        //var LundiPentecote = new Date(an, MoisPaques-1, JourPaques+50);

        return [JourAn, LundiPaques, FeteTravail, Victoire1945, Ascension, /* LundiPentecote,*/ FeteNationale, Assomption, Toussaint, Armistice, Noel];
    },

    // Vérifie si un jour est ferié
    isJourFerie: function (DATE) {
        var Y = DATE.getFullYear();
        var joursFeries = Tools.Date.getJoursFeries(Y);
        DATE = DATE.date2Sql();
        for (var i in joursFeries) {
            joursFeries[i] = joursFeries[i].date2Sql();
            if (joursFeries[i] === DATE) {
                return true;
            }
        }
        return false;
    },

    // Créer une nouvelle date
    newDate: function (str) {
        str = str.split('-');
        var date = new Date();
        date.setUTCFullYear(str[0], str[1] - 1, str[2]);
        date.setUTCHours(0, 0, 0, 0);
        return date;
    },

    // Clone de la même fonction php : De 08:30:00 a 08
    timeSql2Heure: function (time) {
        if (time === undefined || time === '' || time.length < 2)
            return null;
        return time.substr(0, 2);
    },

    // Clone de la même fonction php : De 08:30:00 a 30 ou 08:32:00 a 30
    timeSql2Minute: function (time, force) {
        if (force === undefined) force = false;
        if (time === '' || time.length < 5) return null;
        var min = time.substr(3, 2);
        if (force === true) {
            if (min > 55)
                min = 55;
            else {
                var start = min.substr(0, 1);
                var end = min.substr(1, 1);
                if ($.inArray(end, [3, 4, 5, 6, 7]))
                    end = 5;
                else if ($.inArray(end, [0, 1, 2]))
                    end = 0;
                else {
                    end = 0;
                    start++;
                }
                min = start + '' + end;
            }
        }
        return min;
    },

    // Retourne l'heure avec ou sans zero initiaux
    getHeure: function (init) {
        var date = new Date();
        date = parseInt(date.getHours());
        if (init !== undefined && init === true) {
            if (date < 10) date = "0" + date;
            else date = "" + date;
        }
        return date;
    },

    // Retourne les minutes avec ou sans zero initiaux
    getMinute: function (init) {
        var date = new Date();
        date = parseInt(date.getMinutes());
        if (init !== undefined && init === true) {
            if (date < 10) date = "0" + date;
            else date = "" + date;
        }
        return date;
    },

    // Retourne l'heure ou la minute avec les zero initiaux
    zeroInitiaux: function (val) {
        val = parseInt(val);
        if (val < 10) val = "0" + val;
        else val = "" + val;
        return val;
    },
	
	// Retourne true si c'est bien un dateTime 0000:00:00 00:00:00
	isDateTime : function(date){
		if(date.match(/^[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1} [0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}:[0-5]{1}[0-9]{1}$/)){				
			return true;
		} 
		return false;
	},
	
	// Clone de la même fonction PHP : de 2012-03-09 -> 09/03/2012
	dateSql2fr : function(date){
		if (date === null || date === undefined || date === '' || date.length < 8)
            return '';
		return date.substr(8,2)+'/'+date.substr(5,2)+'/'+date.substr(0,4);
    },
	
	// presque clone de la même fonction PHP : Nombre de secondes en durée lisible
	ellapsedTimeToString : function (date1, long){
		if( date1 === null || date1 === undefined || date1 === ''){
			return '';
		}
		if(long === undefined){
			long = true;
		}
		date1 = new Date(date1);
		var timeDiff = (Math.abs(Date.now() - date1.getTime())) / 1000;
		
		//Supperieur a 3j
		if(timeDiff>=259200){
			var jour = parseInt(timeDiff/86400);
			if(long){
				if(jour > 1){
					return jour+" jours";
				} else {
					return jour+" jour";
				}
			} else {
				return jour+"j";
			}
		//JOUR
		}else if(timeDiff>=86400){
			var jour = parseInt(timeDiff/86400);
			var heure = parseInt((timeDiff-(jour*86400))/3600);			
			var min = parseInt((timeDiff-(heure*3600)-(jour*86400))/60);
			
			if(heure>0){
				if(long){
					if(jour > 1){
						if(heure > 1){
							return jour+" jours "+heure+" heures";
						} else {
							return jour+" jours 1 heure";
						}
					} else {
						if(heure > 1){
							return jour+" jour "+parseInt(heure)+" heures";
						} else {
							return jour+" jour 1 heure";
						}
					}
				} else {
					return jour+"j "+heure+"h";
				}
			}else{
				if(long){
					if(jour > 1){
						return jour+" jours";
					} else {
						return jour+" jour";
					}
				} else {
					return jour+"j";
				}
			}
		//HEURE
		}else if(timeDiff>=3600){
			var heure = parseInt(timeDiff/3600);
			var min = parseInt((timeDiff-(heure*3600))/60);
			
			if(min>0){
				if(long){
					if(heure > 1){
						return heure+" heures";
					} else {
						return heure+" heure";
					}
				} else {
					return heure+"h"+min;
				}
			}else{
				if(long){
					if(heure > 1){
						return heure+" heures";
					} else {
						return heure+" heure";
					}
				} else {
					return heure+"h";
				}
			}
		//MINUTES
		}else if(timeDiff>=60){
			var min = parseInt(timeDiff/60);
			if(long){
				if(min > 1){
					return min+" minutes";
				} else {
					return min+" minute";
				}
			} else {
				return min+"m";
			}

		//SECONDES
		}else if(timeDiff > 0){
			if(long){
				return "&lt; 1 minute";
			} else {
				return timeDiff+"s";
			}
		}else{
			if(long){
				return "&lt; 1 minute";
			} else {
				return "&lt; 1 min";
			}
		}
		
	}
};


/*----------------------------------------------------------------------------*/
/*							TOOLS - TABLEAUX								  */
/*----------------------------------------------------------------------------*/
Tools.Array = {
    // Compte le nombre d'éléments d'un tableau
    countTab: function (tab) {
        count = 0;
        for (var i in tab)
            count++;
        return count;
    },

    //Tri d'un tableau par sa clés
    sortArray: function (tab) {
        var key = [];
        for (var i in tab)
            key.push(i);
        key = key.sort(function (a, b) {
            return a - b;
        });
        var output = [];
        for (var i in key)
            output[key[i]] = tab[key[i]];
        return output;
    }
};


/*----------------------------------------------------------------------------*/
/*							TOOLS - GEOGRAPHIQUE							  */
/*----------------------------------------------------------------------------*/
Tools.Geo = {
    // Conversion de degré en radian
    convertRad: function (input) {
        return (Math.PI * input) / 180;
    },

    // Calcul de distance entre deux points
    distance: function (lat_a, lon_a, lat_b, lon_b) {
        var R = 6378000; //Rayon de la terre en mètre
        lat_a = Tools.Geo.convertRad(lat_a);
        lon_a = Tools.Geo.convertRad(lon_a);
        lat_b = Tools.Geo.convertRad(lat_b);
        lon_b = Tools.Geo.convertRad(lon_b);
        return R * (Math.PI / 2 - Math.asin(Math.sin(lat_b) * Math.sin(lat_a) + Math.cos(lon_b - lon_a) * Math.cos(lat_b) * Math.cos(lat_a)));
    },

    // Convertis une distance en texte lisible
    distanceToString: function (dist) {
        dist = parseFloat(dist);
        if (dist > 100000)
            return Math.round(dist / 1000) + 'km';
        else if (dist > 1000)
            return Math.round(dist / 1000, 1) + 'km';
        else
            return Math.round(dist) + 'm';
    }
};


/*----------------------------------------------------------------------------*/
/*								TOOLS - HTML								  */
/*----------------------------------------------------------------------------*/
Tools.View = {
	// Active le tablesorter sur un tableau et masque le bouton
	sortTable : function(table, me){
		if($(table).length > 0){
			$(table).customTableSorter();
			if(me !== undefined){
				$(me).hide();
			}
		}
	}
};


/*----------------------------------------------------------------------------*/
/*								TOOLS - DATEPICKER							  */
/*----------------------------------------------------------------------------*/
Tools.DatePicker = {
    clickToggle: function (item) {
        var input = $(item).parents('.input-group.date').find('input');
        if (parseInt($(input).data('open')) === 0) {
            $(input).datepicker('show');
        }
    },
	
	// IDem que la fonction PHP de transformation d'un datepicker en dateSQL
	dateToSql : function(date){
		if(date === undefined || date === null || date.length < 10){
			return '';
		}
		return date.substring(6,10)+'-'+date.substring(3,5)+'-'+date.substring(0,2);
	}
};


/*----------------------------------------------------------------------------*/
/*								TOOLS - FILE							  */
/*----------------------------------------------------------------------------*/
Tools.File = {
    /**
     * Vérifier si le fichier est une image
     * @param file
     * @returns {boolean}
     */
    estImage: function (file) {
        var arrayExtensions = ["jpg", "jpeg", "gif", "png"];

        var ext = file.name.split(".");
        ext = ext[ext.length - 1].toLowerCase();

        if (arrayExtensions.lastIndexOf(ext) === -1) {
            alert("Seuls les types de fichiers suivant sont autorisés : " + arrayExtensions.join(', '));
            return false;
        }
        return true;
    },

    /**
     * Vérifier si le fichier est une xls, xlsx ou zip
     * @param file
     * @returns {boolean}
     */
    estXsl: function (file) {
        var arrayExtensions = ["xls", "xlsx", "zip"];

        var ext = file.name.split(".");
        ext = ext[ext.length - 1].toLowerCase();

        if (arrayExtensions.lastIndexOf(ext) === -1) {
            alert("Seuls les types de fichiers suivant sont autorisés : " + arrayExtensions.join(', '));
            return false;
        }
        return true;
    }
};


/*----------------------------------------------------------------------------*/
/*								TOOLS - FILE								  */
/*----------------------------------------------------------------------------*/
Tools.OngletsTravaux = {
    /**
     * Récupère le prochain onglet à activer
     * S'il s'agit de Valider, on ne redirige pas (car on doit passer par la réalisation mobile avant)
     */
    goNextTab: function () {
        var next_li = $('#div-travaux .tabs2 ul li.active').next('li');
        var lien = next_li.children('a').attr('href');
        var type = next_li.data('suivi');
        if (lien !== undefined && type !== 'valider') {
            Tools.redirection(lien);
        }
    }
};

/*----------------------------------------------------------------------------*/
/*								TOOLS - FUNCTION							  */
/*----------------------------------------------------------------------------*/
function trim(val){
	return $.trim(val);
}