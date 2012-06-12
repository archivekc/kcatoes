$(function(){
	// sauvegarde automatique toutes les minutes
	window.setInterval(function(){
		var form = $('form')[0];
		$.post(form.action+'?autosave=;)', $(form).serialize());
	}, 60000);
	
	// MAJ du score
	$('.testStatus select').change(function(){
		var nbEchec = 0;
		var nbReussite = 0;
		$('.testStatus select').each(function(){
			switch($(this).val()){
				case 'REUSSITE':
					nbReussite++;
					break;
				case 'ECHEC':
					nbEchec++;
					break;
			}
		});
		var score = 'N/A';
		if (nbEchec + nbReussite > 0){
			score = parseInt(nbReussite / (nbEchec + nbReussite)*100);
		}
		$('#score').val(score);
		$('.scoreValue').text(score);
	});
	
	
	// groupage des lignes
	handleGroups();
	
	// Mise en forme des éléments de contexte
	$('tbody tr .context').each(function(){
		var that = this; 
		var css = $('.cssSelector', this).detach();
		var source = $('.source', this).detach();
		var comment = $('.comment', this).detach();
		var annotation = $('.annotation', this).detach();
		
		
		
		var triggerPopup = $('<a title="Voir les détails" class="ico show" href="javascript:void(0)"><img src="./img/ico/loupe64.png" alt="Voir" /></a>');
		var triggerRepere = $('<a title="Situer dans la page" class="ico locate" href="javascript:void(0)"><img src="./img/ico/reperer64.png" alt="Repérer" /></a>');
		
		if (css.length){
			var selector = $('.value', css).text();
						
			var highlight = function(){
				var elem = $(selector, iCtx());
				$(elem).highlight(this);
			};
			var unhighlight = function(){
				var elem = $(selector, iCtx());
				$(elem).unhighlight(this);
			};
			
			$(triggerRepere).bind('mouseover focus', highlight);
			$(triggerRepere).bind('mouseout blur', unhighlight);
		}
		
		var info = $('<div/>');
		$(info).append(comment);
		$(info).append(css);
		$(info).append(source);
		
		$(triggerPopup).click(function(){
			showPopup(info, this, {
				appendTo: '#output'
				,onopen: function(){
					//$(this.getBody()).prepend($(triggerRepere).detach());
					$(this.getBody()).prepend($(annotation).detach());
				}
				,onclose: function(){
					//$(that).append($(triggerRepere).detach());
					$(that).append($(annotation).detach());
				}
			});
		});
		$(this).append(triggerPopup);
		if(css.length)
		{
			$(this).append(triggerRepere);
		}
		$(this).append(annotation);
	});
	
	// affichage des liens de documentation
	$('.testDoc li').each(function(){
		var url = $(this).text();
		var link = '<a href="'+url+'" target="_blank">'+url+'</a>';
		
		$(this).html(link);
	});
	
	// code couleur des valeurs de résulat
	var checkColorCode = function(){
		var value = $(this).val();
		$(this).closest('td').removeClass('ECHEC NA REUSSITE MANUEL').addClass(value);
	};
	$('select').change(checkColorCode).each(function(){checkColorCode.call(this);});
	
	
	// barre de resize
	$('#resizeHandler').mousedown(function(e){
		var output = $('#output');
		var tested = $('#tested');
		var resize = this;
		
		var initX = $(output).outerWidth();
		
		var initOutputWidth = initX;
		var initTestedWidth = $(tested).outerWidth();
		var max = initOutputWidth + initTestedWidth;
		
		var initMouseX = e.pageX;
		var mask = $('<div/>').css({
			position: 'absolute'
			,left: 0
			,right: 0
			,top: 0
			,bottom: 0
		}).appendTo(tested);
		
		var move = function(e){
			var deltaX = e.pageX - initMouseX;
			var center = initX+deltaX;
			if (center >= 0 && center <= max){
				$(output).css('width', initOutputWidth + deltaX+'px');
				$(tested).css('left', initOutputWidth + deltaX+'px');
				$(resize).css('left', center+'px');
			} else {
				$(window).trigger('mouseup');
			}
		};
		
		$(window).bind('mousemove', move);
		$(window).mouseup(function(){
			$(window).unbind('mousemove', move);
			$(mask).remove();
		});
	});
	
	$.fn.highlight = function(source){
		if($(this).data('kcatoesHighlighter')){
			// rien si highlighter existe déjà
			return this;
		}
		
		var visibleThis = this;
		if (visibleThis.length){
			visibleThis = visibleThis[0];
		}
		var useParent = false;
		while($(visibleThis).is(':visible') == false && visibleThis.nodeName.toUpperCase('BODY')){
			visibleThis = visibleThis.parentNode;
			useParent = true;
		}
		var pos = $(visibleThis).offset();
		
		if (useParent){
			var highlightColor = '#FF9';
			var highlightBorderColor = '#FF0';
			var highlightConfirmedColor = '#9FF';
			var highlightConfirmedBorderColor = '#0FF';
		} else {
			var highlightColor = '#F99';
			var highlightBorderColor = '#F00';
			var highlightConfirmedColor = '#9F9';
			var highlightConfirmedBorderColor = '#0F0';
		}
		
		// définition du hihlighter
		var highlighter = $('<div/>').css({
			position: 'absolute'
			,left: pos.left+'px'
			,top: pos.top+'px'
			,height: $(visibleThis).outerHeight()+'px'
			,width: $(visibleThis).outerWidth()+'px'
			,zIndex: 10E+9
		}).appendTo($('body', iCtx()));
		
		var bg = $('<div/>').css({
			background: highlightColor
			,outline: '1px solid '+highlightBorderColor 
			,opacity: .3
			,height: '100%'
			,width: '100%'
		}).appendTo(highlighter);
		
		$(highlighter).data('confirmed', false);
		
		// liens entre elements et highlighter
		$(this).data('kcatoesHighlighter', highlighter);
		$(highlighter).data('relatedElem', this);
		
		iWin().scrollTo(pos.left -10 , pos.top -10);
		
		// confirmation du highlighter
		$(source).click(function(){
			if ($(highlighter).data('confirmed')){
				$(highlighter).data('confirmed', false);
				$(this).removeClass('confirmed');
				$(bg).css({
					background: highlightColor
					,outline: '1px solid '+highlightBorderColor
				});
			} else {
				$(highlighter).data('confirmed', true);
				$(this).addClass('confirmed');
				$(bg).css({
					background: highlightConfirmedColor
					,outline: '1px solid '+highlightConfirmedBorderColor
				});
			}
		});
		
		var getInfo = function(){
			var tpl = '<div>###NODENAME###</div>';
			return $(tpl.replace(/###NODENAME###/, this.nodeName));
		};
		
		var info = getInfo.call(this[0]);
		$(highlighter).append(info);
		$(info).css({
			position: 'absolute'
			,top: 0
			,right: 0
			,fontSize: '20px'
			,color: '#00F'
			,background: '#EEE'
		});
		return this;
		
	};
	$.fn.unhighlight = function(){
		var highlighter = $(this).data('kcatoesHighlighter');
		if ($(highlighter).data('confirmed') == false){
			$(highlighter).remove();
			$(this).data('kcatoesHighlighter', null);
		}
		
		return this;
	};
});

// ///// //
// utils //
/////// //

// points d'ancrages dans la page testée
var iCtx = function(){
	return $('[name=testedPage]')[0].contentDocument;
};
var iWin = function(){
	return $('[name=testedPage]')[0].contentWindow;
};

// formatage du code
var formatHTML = function(htmlStr){
	htmlStr = htmlStr.replace(/&lt;/g, '<').replace(/&gt;/g, '>');
	htmlStr = style_html(htmlStr);
	return htmlStr.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/ /g, '&nbsp;');
};

// popup
var showPopup = function(content, opener, userOption)
{
	var nope = function(){};
	var option = {
			appendTo: 'body'
			,onopen: nope
			,onclose: nope
	};
	$.extend(option, userOption);
	
	var popupHolder = $('<div class="popup"/>')[0];
	var popupContent = $('<div class="popupContent"/>');
	var closeTrigger = $('<button class="close">Fermer le popup</button>').appendTo(popupHolder);
	$(popupContent).append($(content)).appendTo(popupHolder);
	
	$(popupHolder).appendTo($(option.appendTo));
	
	popupHolder.getBody = function(){
		return popupContent[0];
	};
	
	var closePopup = function(){
		$(popupHolder).remove();
		$(opener).focus();		
		$(document).unbind('keyup', closePopupOnEsc);
		option.onclose.call(popupHolder);
	};
	$(closeTrigger).click(closePopup);

	// Fermeture de la popup sur touche Escape
	var closePopupOnEsc = function(e){
		if (e.keyCode == 27) {
			closePopup();
		}
	};
	$(document).bind('keyup', closePopupOnEsc);
	
	option.onopen.call(popupHolder);
	
	return popupHolder;
};

// groupage des lignes
var handleGroups = function(){
	// Gestion des regroupements
	var allGroups = {};
	var allTests = [];
	$('tbody tr th').each(function(){
		var line = $(this).closest('tr')[0];
		line.sublines = [];
		if ($(this).attr('rowspan')){
			var nbSublines = $(this).attr('rowspan') - 1;
			if (nbSublines > 0){
				var current = line;
				for (var i = 0; i < nbSublines; i++){
					current = $(current).next();
					line.sublines.push(current);
				}
			}
		}

		var groups = $('.groups', line);
		line.groupInfo = {};
		$('li', groups).each(function(){
			var key = $('.key', this).text();
			var values = $('.value', this).text();
			if (!allGroups[key]){
				allGroups[key] = true;
			}
			line.groupInfo[key] = values;
		});
		
		allTests.push(line);
	});
	
	var generateGroupSelect = function(depth){
		if (!depth){
			depth = 0;
		}
		var select = $('<select class="depth_'+depth+'"/>');
		$('<option value=""></option>').appendTo(select);
		for (var group in allGroups){
			$('<option value="'+group+'">'+group+'</option>').appendTo(select);
		}
		return select;
	};
	// ajout du regroupement
	var select = generateGroupSelect();
	var grouper = $('<span>Grouper par&nbsp;: </span>').append(select);
	$('#kcatoesRapport').before(grouper);
	
	$(select).change(function(){
		var groupBy = $(this).val();
		var groups = {};
		var others = [];
		for (var line in allTests){
			var groupInfo = allTests[line].groupInfo;
			if (groupInfo[groupBy] != undefined){
				if (groups[groupBy+'&nbsp;: '+groupInfo[groupBy]] == undefined){
					groups[groupBy+'&nbsp;: '+groupInfo[groupBy]] = [];
				}
				groups[groupBy+'&nbsp;: '+groupInfo[groupBy]].push(allTests[line]);
			} else {
				others.push(allTests[line]);
			}
		}

		// affichage
		
		// suppression des entêtes de regroupement
		$('#kcatoesRapport .groupBy').remove();
		var add = function(line){
			$('#kcatoesRapport tbody').prepend(line);
			
			// au deuxième appel, la définition de la function
			// a changer
			add = function(line, lastInserted){
				$(lastInserted).after(line);
				return line;
			};
			return line;
		};
		var lastInserted = null;
		for (var i in groups){
			var headGroup = $('<tr class="groupBy"><th colspan="6">'+i+'</th></tr>');
			lastInserted = add(headGroup, lastInserted);
			for (var t in groups[i]){
				var test = groups[i][t];
				lastInserted = add(test, lastInserted);
				for (var s in test.sublines){
					lastInserted = add(test.sublines[s], lastInserted);
				}
			}
		}
		add($('<tr class="groupBy"><th colspan="6">Pas de valeurs</th></tr>'), lastInserted);
	});
};

