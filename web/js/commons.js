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