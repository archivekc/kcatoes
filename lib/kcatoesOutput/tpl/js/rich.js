$(function(){
	// sauvegarde automatique toutes les minutes
	window.setInterval(function(){
		var form = $('form')[0];
		$.post(form.action+'?autosave=;)', $(form).serialize());
	}, 60000);
	
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
	})
	
	// code couleur des valeurs de résulat
	var checkColorCode = function(){
		var value = $(this).val();
		$(this).closest('td').removeClass('ECHEC NA REUSSITE MANUEL').addClass(value);
	};
	$('select').change(checkColorCode).each(function(){checkColorCode.call(this)});
	
	
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
		
		// accès à l'élément depuis le highlighter
		$(highlighter).click(function(){
			//console.log($(this).data('relatedElem'));
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
	var closePopupOnEsc = function(e){ if (e.keyCode == 27) { closePopup(); } }
	$(document).bind('keyup', closePopupOnEsc);
	
	option.onopen.call(popupHolder);
	
	return popupHolder;
};



