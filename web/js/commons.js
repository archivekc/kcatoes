$(function(){
	var handleQuickAddForm = function(parent){
		if (!parent){
			parent = $('body');
		}
		
		$('.quickAddForm', parent).each(function(){
			collapser = $(this).prev();
			collapsable = $(this);
			makeCollapsable(collapser, collapsable);
		});
	};
	
	var initScreen = function(parent){
		if (!parent){
			parent = $('body');
		}
		
		handleQuickAddForm(parent);
		handleTabs(parent);
		handlePopupScreen(parent);
//		handleNav();
	};
	
	initScreen();
});

var makeCollapsable = function(collapser, collapsable, userOptions){
	var option = {
		style: 'popup'
	};

	var trigger = $('<button class="ico"/>');
	$(collapser).before(trigger);
	$(trigger).append(collapser);
	
	$(trigger).addClass('collapser collapse-closed');
	$(collapsable).addClass('collapsable collapse-closed');
	
	var handleKey = function(e){
		if (e.keyCode == 27 ){  // escape key
			$(trigger).click();
		}
	};
	var show = function(){
		switch(option.style){
			case 'popup':
				var popupWrap = $('<div class="popupWrap"/>');
				var popupOverlay = $('<div class="popupOverlay"/>');
				$(popupWrap).append(popupOverlay);
				$(popupWrap).append(collapsable);
				$(collapsable).addClass('popup');
				$('#wrap').prepend(popupWrap);
				var closeTrigger = $(trigger).clone(true).text('Fermer');
				$(collapsable).prepend(closeTrigger);

				collapsable.popupWrap = popupWrap;
				collapsable.popupOverlay = popupOverlay;
				collapsable.closeTrigger = closeTrigger;

				$(document).bind('keyup', handleKey);

				break;
			default:
				$(collapsable).show();
				break;
		}
	};

	var hide = function(){
		switch(option.style){
			case 'popup':
				$(collapsable.popupWrap).remove();
				$(collapsable.popupOverlay).remove();
				$(collapsable.closeTrigger).remove();
				$(document).unbind('keyup', handleKey);
				break;
			default:
				$(collapsable).hide();
				break;
		}
	}
	
	$(trigger).click(function(e){
		e.preventDefault();
		if ($(this).is('.collapse-opened')){
			hide();
			$(collapsable).add(trigger).removeClass('collapse-opened').addClass('collapse-closed');
		} else {
			$(collapsable).add(trigger).removeClass('collapse-closed').addClass('collapse-opened');
			show();
		}
	});
	delete trigger;
	delete collapsable;
	delete collapser;
};

///////////// //
//les onglets //
///////////// //
var handleTabs = function(parent){
	if (!parent){
		parent = $('body');
	}
	
	$('.tabHeads', parent).each(function(){
		$(this).addClass('js');
		$('a', this).each(function(index, elem){
			
			$(this).click(function(){
				var previousCurrentTab = $(this).closest('.tabHeads').find('.current');
				if (previousCurrentTab.length){
					var previousTab = $('#'+previousCurrentTab[0].href.split('#')[1]);
					$(previousCurrentTab).add(previousTab).removeClass('current');
				}
				
				$('#'+this.href.split('#')[1]).add(this).addClass('current');
			});

			// activation du premier onglet par défaut
			if (index==0){
				$(this).click();
			}
			
		});
	});
	$('.tab', parent).each(function(){
		$(this).addClass('js');
		$('.skipLink', this).text('Retour au sommaire');
	});
	
	// vérification de l'ancre
	$('.tabHeads a[href='+window.location.hash+']').click();
};

var handlePopupScreen = function(parent){
	if (!parent){
		parent = $('body');
	}
	$('.popupScreen', parent).click(function(e){
      e.preventDefault();
      $.ajax({
      	type: 'get'
      	,url: this.href
      	,type: 'html'
      	,success: popup
      	,error: function(errObj, errType, errTxt){
    	  	switch(errObj.status){
    	  		case 401:
    	  			var msg = "Permission non accordée. Si votre session a expirée, vous devez vous reconnecter !";
    	  			var link = '<a href="'+GLOBAL.loginUrl+'" class="ico connexion">Accéder au formulaire de connexion</a>';
    	  			var content = $('<div class="block popupscreenError"><h1>Erreur</h1><p>'+msg+'</p>'+link+'</div>');
    	  			break;
    	  	}
    	  	popup(content);
	    }
      });
	});
}

// ///////////// //
// la navigation //
// ///////////// //
var handleNav = function(){
	$('#mainMenu a').not('[href$=connexion],[href$=logout]').click(function(e){
      e.preventDefault();
      $.ajax({
      	type: 'get'
      	,url: this.href
      	,type: 'html'
      	,success: function(data){
      		$('#page').html(data);
      		console.log('loaded');
      	}
      });
	});
};

// ///// //
// Popup //
///// //
var popup = function(content){
	content = $(content);
	var popupWrap = $('<div class="popupWrap"/>');
	var popupOverlay = $('<div class="popupOverlay"/>');
	$(popupWrap).append(popupOverlay);
	$(popupWrap).append(content);
	$(content).addClass('popup');
	$('#wrap').prepend(popupWrap);
	var closeTrigger = $('<button class="collapse-opened collapser ico">Fermer</button>');

	$(content).prepend(closeTrigger);

	content.popupWrap = popupWrap;
	content.popupOverlay = popupOverlay;
	content.closeTrigger = closeTrigger;

	$(closeTrigger).click(function(){
		$(content.popupWrap).remove();
		$(content.popupOverlay).remove();
		$(content.closeTrigger).remove();
		
		$(content).trigger('popuphide');
		$(document).unbind('keyup', handleKey);
	});
	$(content).trigger('popupshow');
	
	var handleKey = function(e){
		if (e.keyCode == 27 ){  // escape key
			$(closeTrigger).click();
		}
	};
	$(document).bind('keyup', handleKey);
	
	return content;
}