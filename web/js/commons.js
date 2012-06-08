$(function(){
	var handleQuickAddForm = function(parent){
		if (!parent){
			parent = $('body');
		}
		
		$('.quickAddForm', parent).each(function(){
			collapser = $(this).prev();
			collapsable = $(this);
			makeCollapsable(collapser, collapsable, {style: 'popup'});
		});
	};
	
	var handleDropdownUserMenu = function(parent){
		if (!parent){
			parent = $('body');
		}
		var collapser = $('#userZone>strong>span', parent);
		var collapsable = $('#userZone>.sub>ul', parent);
		if (collapser.length>0){
			makeCollapsable(collapser, collapsable, {
				style: 'dropdown'
			});
		}
	};
	
	var initScreen = function(parent){
		if (!parent){
			parent = $('body');
		}
		
		handleQuickAddForm(parent);
		handleTabs(parent);
		handlePopupScreen(parent);
		handleDropdownUserMenu(parent);
//		handleNav();
		handleTestExecution(parent);
	};
	
	initScreen();
});

var makeCollapsable = function(collapser, collapsable, userOptions){
	var option = {
		style: 'showhide'
	};
	
	$.extend(option, userOptions);

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
			case 'dropdown':
				/*$(collapsable).parent().css('margin-bottom', '-'+$(collapsable).outerHeight()+'px' );
				$(collapsable).show();*/
				$(collapsable).parent().css({
					'position': 'absolute'
					,'width': '100%'
				});
				$(collapsable).show();
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
	};
	
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
		console.log()
      $.ajax({
      	type: 'get'
      	,url: this.href
      	,success: function(data){
    	  popup(data);
      	}
      	,error: function(errObj, errType, errTxt){
    	  	switch(errObj.status){
    	  		case 401:
    	  			var msg = "Permission non accordée. Si votre session a expirée, vous devez vous reconnecter !";
    	  			var link = '<a href="'+GLOBAL.loginUrl+'" class="ico connexion">Accéder au formulaire de connexion</a>';
    	  			var content = $('<div class="block popupscreenError"><h1>Erreur</h1><p>'+msg+'</p>'+link+'</div>');
    	  			break;
    	  		default:
    	  			console.log(arguments);
    	  	}
    	  	popup(content);
	    }
      });
      e.preventDefault();
	});
};

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
var popup = function(content, closeCallback){
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
		if (closeCallback !== undefined)
		{
		  closeCallback();
		}
	});
	$(content).trigger('popupshow');
	
	var handleKey = function(e){
		if (e.keyCode == 27 ){  // escape key
			$(closeTrigger).click();
		}
	};
	$(document).bind('keyup', handleKey);
	
	return content;
};

// /////////////////// //
// Lancement des tests //
// /////////////////// //

// Capture du lancement des tests
var handleTestExecution = function(parent)
{
  if (!parent){
    parent = $('body');
  }
  $('#execute_test', parent).click(function(){ 
    //console.log('execute_test click !');
    
    // Désactive le bouton pour empêcher la soumission du formulaire
    $(this).attr('disabled', true);
    launchTests(parent); 
    return false;
  });
};

// Lancement asynchrone des tests
var launchTests = function(parent)
{
  console.log('Lancement des tests');
  console.log('Parent : ' + parent);
  
  /*
  stopped  = false;
  pourcent = 0;
   */
  var pourcent = 0;
  var nb_tests_txt = '';
  
  var running = true;
  
  popup_content = '<div class="block popupscreemRunning"> '+
      '<p><span id="nb_tests">'+nb_tests_txt+'</span> test(s) réalisé(s)</p>'
    + '<p>Exécution en cours... <span id="pourcent">'+pourcent+'</span>%</p>'
    + '<div id="progressbar"></div>'; 
    + '</div>'; 
  
  popup(popup_content, function(){
    // Réactive le bouton de soumission du formulaire
    $('#execute_test', parent).attr('disabled', false);
    running = false;
  });
  
  $("#progressbar").progressbar({ value: pourcent });
  
  var request = function(index){
    if (index === undefined) { index = 0; }
    
    jQuery.ajax({
  
      type: "POST", async: true,
      
      // FIXME : sans le frontend_dev.php (configurer l'environnement par défaut ?)
      url: "/frontend_dev.php/scenario/launch?ajax=1&index=" + index,
      
      data: jQuery("form").serialize(),
      dataType: "json",
      success: function(result){
        
        console.log(result);
        
        // Mise à jour des compteurs
        nb_tests_txt = result.executes + ' / ' + result.total;
        $('#nb_tests').html(nb_tests_txt);
        
        if (result.total > 0)
        {
          pourcent = Math.round(100*result.executes/result.total);
        }
        $('#pourcent').html(pourcent);
        
        $("#progressbar").progressbar({ value: pourcent });
        
        if (result.executes < result.total && running == true)
        {
          // Il reste des tests à exécuter, on continue
          request(result.executes);
        }
        else 
        {
          // Exécution des tests finie ou interrompue
          running == false;
          // Recharge la page pour mettre à jour les chiffres
          window.location.reload();
        }
      }
    })
    
  };

  request();
  
  return false;
  
};
