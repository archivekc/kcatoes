$(function(){
	// Situation de l'élément dans la page
	$('tr .context').each(function(){
		if ($(this).is('th')){
			$(this).after($('<th>Situation</th>'));
		} else {
			var trigger = $('<button class="highlightTrigger"><span class="show">Situer dans la page</span><span class="hide">Ne pas montrer</span></button>');
			var cell = $('<td/>');
			
			var css = $('.cssSelector', this).text();
			
			var highlight = function(){
				var elem = $(css, iCtx());
				$(elem).highlight(this);
			};
			var unhighlight = function(){
				var elem = $(css, iCtx());
				$(elem).unhighlight(this);
			};
			
			$(trigger).bind('mouseover focus', highlight);
			$(trigger).bind('mouseout blur', unhighlight);
			
			$(cell).append(trigger);
			$(this).after(cell);
		}
	});
	
	// affichage des liens de documentation
	$('td.testDoc li').each(function(){
		var url = $(this).text();
		var link = '<a href="'+url+'" target="_blank">'+url+'</a>';
		
		$(this).html(link);
	})
	
	// affichage du contexte
	$('td.context').each(function(){
		var content = $(this).html();
		var opener = $('<button>Montrer le contexte</button>');
		$(this).html(opener);
		$(opener).click(function(){
			showPopup(content, this, {
				appendTo: '#output'
			});
		});
	});
	
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
			console.log($(this).data('relatedElem'));
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
	var option = {
			appendTo: 'body'
	};
	$.extend(option, userOption);
	
	var popupHolder = $('<div class="popup"/>');
	var popupContent = $('<div class="popupContent"/>');
	var closeTrigger = $('<button class="close">Fermer le popup</button>').appendTo(popupHolder);
	$(popupContent).append($(content)).appendTo(popupHolder);
	
	$(popupHolder).appendTo($(option.appendTo));
	
	var closePopup = function(){
		$(popupHolder).remove();
		$(opener).focus();
	};
	$(closeTrigger).click(closePopup);
	return popupHolder;
};