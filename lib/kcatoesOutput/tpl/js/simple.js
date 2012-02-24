$(function(){
	// affichage des codes sources
	$('.source').each(function(){
		var trigger = $('<button>Voir le code source</button>');
		var content = $('pre', this).detach();
		$(trigger).click(function(){
			showPopup('<pre>'+style_html(formatHTML($(content).html()))+'</pre>');
		}).appendTo(this);
	});
});

// formatage du code
var formatHTML = function(htmlStr){
	htmlStr = htmlStr.replace(/&lt;/g, '<').replace(/&gt;/g, '>');
	htmlStr = style_html(htmlStr);
	return htmlStr.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/ /g, '&nbsp;');
};


// popup
var showPopup = function(content, moreOptions){
	var popupContainer = $('<div class="popupContainer"/>');
	var popupContent = $('<div class="popupContent"/>').html(content);
	$(popupContainer).append(popupContent);
	
	var option = {
			closeHTML: '<a href="javascript:void(0);"><img alt="Fermer" src="./img/ico/cross.png" width="16" height="16"/></a>'
			,overlayId: ''
			,containerId: ''
			,opacity: 100
			,focus: true
			,onClose: function(dialog){
				if (dialog.data){
					dialog.data.fadeOut('fast', function () {
						if (dialog.container){
							dialog.container.fadeOut('fast', function () {
								if (dialog.overlay){
									dialog.overlay.fadeOut('fast');
								}
							});
						}
					});
				}
				$.modal.close();
				$(opener).focus();
			}
		};
	$.extend(option, moreOptions);
	
	var modal = $(popupContainer).modal(option);

	var popup = modal.d;
	popup.opener = opener;

	popup.setContent = function(data){
		var content = $('<div>'+data+'</div>');
				
				
		$(popup.data).html(content);
		$('h1+*',popup.data).addClass('popupBody');
		
		
		$('.cancel', popup.data).click(function(){
			$.modal.close();
		});

		popup.container.css('height', 'auto');
		popup.origHeight = 0;
		$.modal.setPosition();

		var first = $('a[href], :input, [tabindex=1]', popup.data)[0];
		if (first){
			first.focus();
		}

	};

	return popup;
};