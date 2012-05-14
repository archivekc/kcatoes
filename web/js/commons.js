$(function(){
	var handleQuickAddForm = function(parent){
		if (!parent){
			parent = $('body');
		}
		
		$('.quickAddForm', parent).each(function(){
			collapser = $('h2', this);
			collapsable = $('>div', this);
			makeCollapsable(collapser, collapsable);
		});
	};
	
	var initScreen = function(parent){
		if (!parent){
			parent = $('body');
		}
		
		handleQuickAddForm(parent);
		handleTabs(parent);
	};
	
	initScreen();
});

var makeCollapsable = function(collapser, collapsable){
	var trigger = $('<button class="trigger"/>');
	$(collapser).before(trigger);
	$(trigger).append(collapser);
	
	$(trigger).addClass('collapser collapse-closed');
	$(collapsable).addClass('collapsable collapse-closed');
	
	$(trigger).click(function(){
		if ($(this).is('.collapse-opened')){
			$(collapsable).animate({
				height: 0
			}, 'fast'
			,function(){
				$(collapsable).add(trigger).removeClass('collapse-opened').addClass('collapse-closed');
			});
		} else {
			$(collapsable).animate({
				height: 'auto'
			}, 'fast'
			,function(){
				$(collapsable).add(trigger).removeClass('collapse-closed').addClass('collapse-opened');
			});
		}
		return false;
	});
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

