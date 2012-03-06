/*
This file is part of KCatoès.

    KCatoès is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    KCatoès is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with KCatoès.  If not, see <http://www.gnu.org/licenses/>.
    
    Copyright (C) 2010, Key Consulting (France)
    Written by Cyril FABBY - contact.kcatoes@keyconsulting.fr
*/

// clean HTML
// nettoyage des éléments requis pour le test
var cleanHtml = function(){
  KC$('.KCADDED').remove();
  KC$('script[src='+setting.path+'check.php]').remove();
}

// lancement des tests
var check = function(options){
	if (options.tests == undefined){
		options.tests = listTest;
	}
	CheckAccessibility.initOptions(options);
	
	//CheckAccessibility.setTestList(listTest);
  CheckAccessibility.runTests();
	var log = KC$.toJSON(CheckAccessibility.getLog());

		
	var url = window.location.pathname + window.location.search;
	var action = setting.path+'tool/logCheck.php';
	
	var form = KC$(formTpl.replace('#ACTION#', action));
  KC$(document.body).append(form);
	
	KC$('[name=log]', form).val(log);
	KC$('[name=url]', form).val(url);
	
	// envoi et nettoyage du formaulaire
	KC$(form).submit()
	         .remove();
	
	// nettoyage de l'HTML
  cleanHtml()
  return;
}


var options = {};

if (defineOptions) {
	// intégration des css
	(function(){
	  var csss = [
	    setting.path+'themes/jquery-ui-1.8.5.custom.css'
	    ,setting.path+'themes/KCreset.css'
	    ,setting.path+'themes/style.css'
	  ];
	
	  for (var href in csss){
	    var link = document.createElement('link');
	    link.rel='stylesheet';
	    link.media='screen';
	    link.href=csss[href];
	    link.className = 'KCADDED';
	    document.getElementsByTagName('head')[0].appendChild(link);
	  }
	})();
	
	window.optionDialogValid = function(){
		var list = new Array();
		KC$('#KClistTest :checked', this).each(function(){
			list[KC$(this).val()] = true;
		});
    var tests = {};
    for (var cat in listTest){
      tests[cat] = [];
      for (var id in listTest[cat]){
        if (list[id] === true){
					tests[cat][id] = listTest[cat][id];
				}
      }
    }
		options.tests = tests;
		
		// todo, sélection des test à passer
		KC$(this).dialog('close');
		check(options);
	}
	
	// liste des tests
	var listStr = '<ul id="KClistTest">';
	for (var cat in listTest){
		listStr += '<li class="sub"><h3>' + cat + '</h3><ul>';
		for (var id in listTest[cat]) {
			listStr += '<li class="' + listTest[cat][id].level + '" title="' + listTest[cat][id].label + '">';
			if (listTest[cat][id].implemented) {
				var checked = ' checked="checked"';
				if (listTest[cat][id].level != 'A') {
					checked = '';
				}
				listStr += '<label><input type=checkbox' + checked + ' value="' + id + '"/>Test ' + id + '</label>';
			}	else {
				listStr += '<span>Test ' + id + '</span>'
			}
			listStr += '</li>';
		}
		listStr += '</ul></li>';
	}
	listStr += '</ul>';
	
	// ouverture de la boite d'options
	var options = setting.optionDialog;
	options.buttons = {
      'Lancer les tests': function(){
        optionDialogValid.call(window.KCdialog);
      }
	}
	options.close = function(){KC$(this).remove();cleanHtml();}
	
	window.KCdialog = KC$(optionDialogTpl.replace('#LIST#', listStr)).dialog(options);
	
}
else {
	options.context = document;
	check(options);
}

