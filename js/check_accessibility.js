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
/**
 * jQuery is required
 * @return
 */

var CheckAccessibility = (function($){
	// ///////////////////
	// extension de jQuery
	
	// textAndAlt
	// comme $().text() en ajoutant aussi le texte alternatif (attribut alt)
	$.fn.textAndAlt =  function(text) {
    if (typeof text !== "object" && text != null)
      return this.empty().append( (this[0] && this[0].ownerDocument || document).createTextNode( text ) );

    var ret = "";

    $.each( text || this, function(){
      $.each( this.childNodes, function(){
        if ( this.nodeType != 8 )
          if (this.nodeType != 1){
            ret += this.nodeValue;
          } else {
            if (this.alt){
              ret += this.alt;
            }
            ret += $.fn.textAndAlt( [ this ] );
          }
      });
    });
    return ret;
  }
	
	// outerHTML (getter)
  $.fn.outerHTML = function() {
    return $('<div>').append( this.eq(0).clone() ).html();
	};
	
  options = {};
	options.context = $('html').get(0);	
	

  // //////////////////////////////
  // Méthodes et propriétés privées
	
	// liste des tests
	var allTests;
	
	// code source de la page
	var srcCodePage = false;
	
	// logs à  conserver
	var log = [];

  // récupération du sélecteur de l'élément
  var getSelector = function(elt){
		var selector = '';
		var childSelector = '';
		var nodeName = elt.nodeName.toUpperCase();
		while (elt.nodeName.toUpperCase() != 'HTML'){
		  if ($(elt).attr('id') != ''){
		    selector = '#'+$(elt).attr('id')+childSelector+selector;
	      if (childSelector == ''){
	        childSelector = '>';
	      }
		    break; 
		  }
			
			// ajout des classes HTML
		  var classNames = '';
		  if ($(elt).attr('class') != ''){
		    classNames = '.'+$(elt).attr('class').replace(/\s+/g, '.', 'g');
		  }
			
			// ajout de la cardinalité de l'élément
			var cardinal = '';
			if (elt.nodeName.toUpperCase() != 'BODY'){
				cardinal = ':eq('+$(elt).prevAll(elt.nodeName).length+')';
			}
			
		  var eltSummary = elt.nodeName+classNames+cardinal;
		  selector = eltSummary+childSelector+selector;
			if (childSelector == ''){
				childSelector = '>';
			}
		  elt = elt.parentNode;
		}
		return selector;
  };

  // construction de la liste de tests
  var setTestList = function(tests){
    allTests = [];
    for (var cat in tests){
      for (var id in tests[cat]){
        allTests[id] = tests[cat][id];
      }
    }
  }

	// getter d'éléments à tester
	var getCadres = function(){
		return $('iframe, frame', options.context);
	};
	var getForms = function(){
		return $('form', options.context);
	};
	var getFieldsets = function(){
		return $('fieldset', options.context);
	};
	var getFieldsetsWithLegend = function(){
		return $('fieldset', options.context).has('legend');
	};
	var getListsSelect = function(){
		return $('select', options.context);
	};
	var getOptgroups = function(){
		return $('optgroup', options.context);
	};
	var getChampsFormulaire = function(){
		return $('input[type=text], input[type=password], input[type=file], input[type=radio], input[type=checkbox], textarea, select');
	};
	var getChampsFormulaireWithId = function(){
		return $('input[type=text][id!=""], input[type=password][id!=""], input[type=file][id!=""], input[type=radio][id!=""], input[type=checkbox][id!=""], textarea[id!=""], select[id!=""]');
	};
  var getLabels = function(){
    return $('label', options.context);
  };
	var getImages = function(){
		return $('img, area, input[type=image], applet', options.context);
	};
	var getImagesLiens = function(){
		return $('a img, button img', options.context);
	};
	var getZonesCliquableGraphique = function(){
		return $('area, input[type=image], applet', options.context);
	};
	var getTousWithAltNonVide = function(){
		return $('[alt]').filter('[alt!=""]', options.context);
	};
	var getFormulairesLiens = function(){
		return $('a, form', options.context);
	}
	var getLiensQueImageArea = function(){
		return $('a, area', options.context).filter(function(index){
      if (this.nodeName.toUpperCase() == 'A'){
        return ($('img', this).length == 1 && $('*', this).length == 1);
      } else {
        return true
      }
    });
	};
	var getMetaHttpEquivRefresh = function(){
		return $('meta[http-equiv=refresh]');
	}
	var getLiensEtBoutons = function(){
		return $('a, area, button, input[type=image], input[type=submit], input[type=button], input[type=reset]', options.context);
	};
	var getLiens = function(){
		return $('a', options.context);
	}
	var getElementPresentation = function(){
		return $('a, abbr, acronym, address, area, bdo, blockquote, button, caption, cite, code, dd, dfn, dir, dl, dt, em, fieldset, form, h1, h2, h3, h4, h5, h6, input, ins, kbd, label, legend, li', options.context);
	};
	var getAll = function(){
		return $('*', options.context);
	};
	var getTitresContenu = function(){
		return $('h1, h2, h3, h4, h5, h6', options.context);
	};
	var getListesDefinition = function(){
		return $('dl', options.context);
	};

	
	var tools = {
		// jQuery
		$: $
		
	  // attribut défini ?
		,attrIsDefined: function(elt, attr){
			return $(elt).is('['+attr+']');
		}
		
		// récupère le code source
		,getSourceCode: function(){
			if (srcCodePage === false){
				$.ajax({
					async: false
					,dataType: 'html'
					,type: 'GET'
					,url: document.location
					,success: function(data){
						srcCodePage = data;
					}
					,error: function(){
						srcCodePage = false;
					}
				});
			}
			return srcCodePage;
		}
	  // récupère le doctype
	  ,getDoctype: function(){
      var src = this.getSourceCode();
	    if (src === false){
	      return false;
	    } else {
	      var match = srcCodePage.match(/<!DOCTYPE.*/);
	      if (match != null){
	        return match[0];
	      } else {
	        return false;
	      }
	    }
	  }
		
		// le doctype est-il valide?
		,doctypeIsValid: function(doctype){
			doctype = doctype.replace(/\s+/,' ');
			
			var knownDoctypes = [
			 '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">'
			 ,'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'
			 ,'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">'
			 ,'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'
			 ,'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
			 ,'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">'
			 ,'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
			 ,'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">'
			];
			
			return ($.inArray(doctype, knownDoctypes) !== -1)? true:false;
		}
	}
	


  // ////////////////////////////////
  // Méthodes et propriétés publiques	
	return {
		initOptions : function(userOptions){
			if (userOptions.context !== undefined){
				options.context = userOptions.context;
			}
			setTestList(userOptions.tests);
		}
		,runTests: function(){
			log = [];
			for (var t in allTests) {
				var test = allTests[t];
				
				if (!test.implemented){
					continue;
				}
				
				var elements;
        switch(test.elements){
          case 'cadres':
            elements = getCadres();
            break; 
					case 'formulaires':
					  elements = getForms();
						break;
					case 'fieldsets':
					  elements = getFieldsets();
						break;
					case 'fieldsetsWithLegend':
					  elements = getFieldsetsWithLegend();
						break;
					case 'listesSelect':
					  elements = getListsSelect();
						break;
					case 'optgroups':
					  elements = getOptgroups();
						break;
					case 'champsFormulaire':
					  elements = getChampsFormulaire();
						break;
					case 'champsFormulaireWithId':
					  elements = getChampsFormulaireWithId();
						break;
          case 'labels':
            elements = getLabels();
            break;
					case 'images':
					  elements = getImages();
						break;
					case 'imagesLien':
					  elements = getImagesLiens();
						break;
					case 'zonesCliquableGraphique':
					  elements = getZonesCliquableGraphique();
						break;
					case 'tousWithAltNonVide':
					  elements = getTousWithAltNonVide();
						break;
					case 'formulairesLiens':
					  elements = getFormulairesLiens();
						break;
					case 'liensQueImageArea':
					  elements = getLiensQueImageArea();
					case 'metaHttpEquivRefresh':
					  elements = getMetaHttpEquivRefresh();
						break;
					case 'liensEtBoutons':
					  elements = getLiensEtBoutons();
						break;
					case 'liens':
					  elements = getLiens();
						break;
					case 'elementPresentation':
					  elements: getElementPresentation();
						break;
					case 'tous':
					  elements = getAll();
						break;
					case 'titresContenu':
					  elements = getTitresContenu();
						break;
					case 'listesDefinition':
					  elements = getListesDefinition();
						break;
          default:
            elements = options.context;
        }
				
				// test pour chaque élément pouvant aboutir à PASSED ou FAILED
				if (test.testElem){
					$(elements).each(function(){
						var res = test.testElem.call(this, tools);
						switch(res){
							case 'PASSED': break;
							case 'NOT APPLICABLE': //break;
							case 'FAILED':
							case 'HUMAN CHECK':
							  var selector, hint, status;
								
                selector = getSelector(this);
								
								if (typeof test.hintElem == 'function' && res != 'NOT APPLICABLE'){
								  hint = test.hintElem.call(this, tools, res);
								}
								
								status = res;
								log.push({
									id: t
									,level: test.level
									,label: test.label
									,status: status
									,selector: selector
									,hint: hint
								});
						    break;
						}
					});
				}
				
				// juste des indices à compiler par élément
				if (test.humanCheckElem){
					$(elements).each(function(){
						var selector, hint, status;
						
						selector = getSelector(this);
						hint = test.hintElem.call(this, tools, res);
						if (hint !== false){
							status = 'HUMAN CHECK';
							
		          log.push({
								id: t
								,level: test.level
								,label: test.label
		            ,status: status
		            ,selector: selector
		            ,hint: hint
		          });
						}
					});
				}
				
				// test pour la page entière
				if (test.testPage){
					var res = test.testPage.call(this, tools, options.context);
					switch (res){
              case 'PASSED': break;
              case 'NOT APPLICABLE': //break;
              case 'FAILED':
              case 'HUMAN CHECK':
                var selector, hint, status;
                
                selector = 'document';
                
                if (typeof test.hintPage == 'function' && res != 'NOT APPLICABLE'){
                  hint = test.hintPage.call(this, tools, options.context, res);
                }
                
                status = res;
                log.push({
                  id: t
									,level: test.level
                  ,label: test.label
                  ,status: status
                  ,selector: selector
                  ,hint: hint
                });
                break;
					}
				}
				
        // juste des indices à compiler pour la page
        if (test.humanCheckPage){
          $(elements).each(function(){
            var selector, hint, status;
            
            selector = getSelector(this);
            hint = test.hintPage.call(this, tools, res);
            if (hint !== false){
              status = 'HUMAN CHECK';
              
              log.push({
                id: t
                ,level: test.level
                ,label: test.label
                ,status: status
                ,selector: selector
                ,hint: hint
              });
            }
          });
        }
      }
		}
		,getLog : function(){
			return log;
		}
	};
})(jQuery);
