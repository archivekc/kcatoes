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
/*
 * level: niveau du test
 * label: intitulé du test
 * elements: catégorie d'éléments devant être testé
 * humanCheckElem: true -> le test ne peut être automatisé mais il est possible de rassembler des informations.
 *                 Le test porte individuellement sur chaque élément du jeu de test
 * testElem: fonction de test quand le test porte individuellement sur chaque élément du jeu de test
 *           le retour doit être 'PASSED', 'FAILED' ou 'HUMAN CHECK'. Si 'HUMAN CHECK' alors la fonction
 *           hintElem doit être implémentée
 * hintElem: rassemble des informations sur un élément, le retour doit être une chaine de caractère ou
 *           un tableau code chaine de caractère (plusieurs indices).
 *           si le retour === false, alors aucune information n'est conservée (si le test est N/A par exemple)
 * humanCheckPage: true -> les test ne peut être automatisé mais il est possible de rassembler des informations.
 *                 Le test porte sur l'ensemble des éléments du jeu de test
 * testPage: fonction de test quand le test porte sur l'ensemble des éléments du jeu de test.
 *           le retour doit être 'PASSED', 'FAILED' ou 'HUMAN CHECK'. Si 'HUMAN CHECK' alors la fonction
 *           hintPage doit être implémentée
 * hintPage: rassemble des informations sur tous les éléments du jeu de test, le retour doit être une chaine de caractère ou
 *           un tableau code chaine de caractère (plusieurs indices).
 * implemented: true ->le critère est implémenté
 * 
 * 
 * toutes les fonctions *Elem sont exécutées avec un élément du jeu de test comme contexte (this).
 * le premier argument est un objet tools contenant certaines méthodes utiles
 * {
 *  $ -> un objet jQuery
 *  ,attrIsDefined(element, attribut) return Boolean
 * }
 * 
 * toutes les fonction en *Page sont exécutés sans contexte particulier (celui de la fonction de déroulement de tous les tests)
 * le premier argument est un objet tools (cf ci-dessus)
 * le second argument est le contexte de test, celui défini dans les options ou alors "document" par défaut
 * 
 */
var listTest = {
	'Cadres': {
  	'1.1': {
  		level: 'A'
  		,label: 'Absence de cadres non titrés'
			,elements: 'cadres'
			,testElem: function(tools){
				return (tools.attrIsDefined(this, 'title')?  'PASSED':'FAILED');
			}
  		,implemented: true
  	},
  	'1.2': {
  		level: 'A'
  		,label: 'Pertinence des titres donnés aux cadres'
			,elements: 'cadres'
			,humanCheckElem: true
			,hintElem: function(){
				return ('Attribut title: ' + this.title);
			}
  		,implemented: true
  	}
  },
	'Couleurs': {
		'2.1': {
      level:  'A'
      ,label: 'Présence d\'un autre moyen que la couleur pour identifier un contenu auquel il est fait référence textuellement'
      ,implemented: false
    },
    '2.2': {
      level:  'A'
      ,label: 'Présence d\'un autre moyen que la couleur pour identifier un contenu auquel il est fait référence dans un élément non textuel'
      ,implemented: false
    },
		'2.3': {
      level:  'A'
      ,label: 'Présence d\'un moyen de transmission de l\'information autre qu\'une mise en couleur réalisée par des styles CSS'
      ,implemented: false
    },
    '2.4':{
      level:  'A'
      ,label: 'Présence d\'un moyen de transmission de l\'information autre qu\'une utilisation de la couleur dans les éléments non textuels'
      ,implemented: false
    },
    '2.5': {
      level:  'AA'
      ,label: 'Valeur du rapport de contraste du texte contenu dans des éléments non textuels (minimum)'
      ,implemented: false
    },
    '2.6': {
      level:  'AA'
      ,label: 'Valeur du rapport de contraste du texte contenu dans des éléments non textuels utilisés comme fond d\'éléments HTML (minimum)'
      ,implemented: false
    },
    '2.7': {
      level:  'AA'
      ,label: 'Valeur du rapport de contraste du texte contenu dans un segment de texte (minimum)'
      ,implemented: false
    },
    '2.8': {
      level:  'AA'
      ,label: 'Valeur du rapport de contraste du texte '
      ,implemented: false
    },
    '2.9': {
      level:  'AA'
      ,label: 'Valeur du rapport de contraste du texte agrandi contenu dans des éléments non textuels utilisés comme fond d\'éléments HTML (minimum)'
      ,implemented: false
    },
    '2.10': {
      level:  'AA'
      ,label: 'Valeur du rapport de contraste du texte agrandi contenu dans un segment de texte (minimum)'
      ,implemented: false
    },
    '2.11': {
      level:  'AAA'
      ,label: 'Valeur du rapport de contraste du texte contenu dans des éléments non textuels (améliorée)'
      ,implemented: false
    },
    '2.12': {
      level:  'AAA'
      ,label: 'Valeur du rapport de contraste du texte contenu dans des éléments non textuels utilisés comme fond d\'éléments HTML (améliorée)'
      ,implemented: false
    },
    '2.13': {
      level:  'AAA'
      ,label: 'Valeur du rapport de contraste du texte contenu dans un segment de texte (améliorée)'
      ,implemented: false
    },
    '2.14': {
      level:  'AAA'
      ,label: 'Valeur du rapport de contraste du texte agrandi contenu dans des éléments non textuels (améliorée)'
      ,implemented: false
    },
    '2.15': {
      level:  'AAA'
      ,label: 'Valeur du rapport de contraste du texte agrandi contenu dans des éléments non textuels utilisés comme fond d\'éléments HTML (améliorée)'
      ,implemented: false
    },
    '2.16': {
      level: 'AAA'
      ,label: 'Valeur du rapport de contraste du texte agrandi contenu dans un segment de texte (améliorée)'
      ,implemented: false
    }
	},
	'Formulaires': {
		'3.1': {
      level:  'A'
      ,label: 'Possibilité d\'identifier les erreurs de saisie'
			,elements: 'formulaires'
			,humanCheckElem: true
			,hintElem: function(){
				return '';
			}
      ,implemented: true
    },
		  '3.2': {
      level:  'A'
      ,label: 'Présence d\'information préalable sur le caractère obligatoire de certains champs de saisie et du type/format de saisie attendue si nécessaire'
      ,elements: 'formulaires'
      ,humanCheckElem: true
      ,hintElem: function(){
        return '';
      }
      ,implemented: true
    },
    '3.3': {
      level:  'A'
      ,label: 'Positionnement correct des étiquettes par rapport aux champs dans les formulaires'
      ,elements: 'formulaires'
      ,humanCheckElem: true
      ,hintElem: function(){
        return '';
      }
      ,implemented: true
    },
    '3.4': {
      level:  'A'
      ,label: 'Regroupement d\'éléments de formulaire via l\'élément fieldset'
      ,elements: 'formulaires'
      ,testElem: function(tools){
				var result = 'HUMAN CHECK';
				if (tools.$('fieldset', this).length > 0){
					result = 'NOT APPLICABLE';
				}
				return result;
			}
      ,hintElem: function(){
        return 'voir l\'élément Form';
      }
      ,implemented: true
		},
    '3.5': {
      level:  'A'
      ,label: 'Absence d\'élément fieldset sans élément legend'
			,elements: 'fieldsets'
			,testElem: function(tools){
				return (tools.$('legend', this).length == 1)?  'PASSED':'FAILED';
			}
      ,implemented: true
    },
    '3.6': {
      level:  'A'
      ,label: 'Pertinence du contenu de l\'élément legend dans l\'élément fieldset'
			,elements: 'fieldsetsWithLegend'
			,humanCheckElem: true
			,hintElem: function(tools){
				return tools.$(tools.$('legend'), this).text();
			}
      ,implemented: true
    },
		'3.7': {
      level:  'A'
      ,label: 'Regroupement d\'éléments option dans un élément select via l\'élément optgroup'
			,elements: 'listesSelect'
      ,testElem: function(tools){
        var result = 'HUMAN CHECK';
        if (tools.$('optgroup', this).length > 0){
          result = 'NOT APPLICABLE';
        }
        return result;
      }
			,hintElem: function(tools){
				return tools.$('option', this).map(function(){return tools.$(this).text();}).get().join(', ');
			}
      ,implemented: true
    },
    '3.8': {
      level:  'A'
      ,label: 'Présence d\'un attribut label sur l\'élément optgroup'
			,elements: 'optgroups'
			,testElem: function(tools){
				return (tools.attrIsDefined(this, 'label')?  'PASSED':'FAILED'); 
			}
      ,implemented: true
    },
    '3.9': {
      level:  'A'
      ,label: 'Pertinence du contenu de l\'attribut label de l\'élément optgroup'
			,elements: 'optgroups'
			,humanCheckElem: true
			,hintElem: function(tools){
				return ('Attribut label: ' + this.label);
			}
      ,implemented: true
    },
    '3.10': {
      level:  'A'
      ,label: 'Absence d\'élément de formulaire sans identifiant'
			,elements: 'champsFormulaire'
			,testElem: function(tools){
				var result;
				if (tools.attrIsDefined(this, 'title')){
					result = 'HUMAN CHECK';
				} else {
					result = (this.id != ''? 'PASSED':'FAILED');
				}
				return result;
			}
			,hintElem: function(){
				return ('Attribut title: ' + this.title);
			}
      ,implemented: true
    },
    '3.11': {
      level:  'A'
      ,label: 'Absence d\'élément de formulaire sans étiquette associée'
			,elements: 'champsFormulaireWithId'
			,testElem: function(tools){
				var result;
        if (tools.attrIsDefined(this, 'title')){
          result = 'HUMAN CHECK';
        } else {
          result = (tools.$('label[for='+this.id+']').length == 1 ? 'PASSED':'FAILED');
        }
				return result;
			}
			,hintElem: function(){
				return ('Attribut title: ' + this.title);
			}
      ,implemented: true
    },
    '3.12': {
      level:  'A'
      ,label: 'Pertinence des étiquettes d\'élément de formulaire'
			,elements: 'labels'
      ,humanCheckElem: true
			,hintElem: function(tools){
				// récupération de l'élément relié
				var elem;
				if (tools.$(this).attr('for')){
					elem = tools.$('#'+tools.$(this).attr('for'));
				} else {
					elem = tools.$('input[type=text], input[type=password], input[type=file], input[type=radio], input[type=checkbox], select, textarea', this)
				}
				var title = this.title;
				var elemOuter = tools.$(elem).outerHTML();
				var text = tools.$(this).text();
				return ['Attribut title de l\'élément label: '+title
				        ,'HTML de l\'élément concerné: '+elemOuter
								,'Contenu de label: '+ text]
			}
      ,implemented: true
    },
    '3.13': {
      level:  'AA'
      ,label: 'Présence d\'informations ou de suggestions facilitant la correction des erreurs de saisie'
      ,implemented: false
    },
    '3.14': {
      level:  'AA'
      ,label: 'Présence de mécanismes permettant de vérifier, modifier ou confirmer les données à caractère juridique, financier, personnel'
      ,implemented: false
    },
    '3.15': {
      level:  'AAA'
      ,label: 'Présence de mécanismes permettant de vérifier, modifier ou confirmer tous types de données saisie par l\'utilisateur'
      ,implemented: false
    },
    '3.16': {
      level:  'AAA'
      ,label: 'Présence d\'une page d\'aide ou d\'un mécanisme d\'aide contextuelle pour la saisie des formulaires'
      ,implemented: false
    }	
	},
	'Images': {
		'4.1': {
      level:  'A'
      ,label: 'Présence de l\'attribut alt'
			,elements: 'images'
			,testElem: function(tools){
				return (tools.attrIsDefined(this, 'alt')?  'PASSED':'FAILED');
			}
      ,implemented: true
    },
    '4.2': {
      level:  'A'
      ,label: 'Pertinence de l\'alternative textuelle aux images liens'
			,elements: 'imagesLien'
			,humanCheckElem: true
			,hintElem: function(tools){
				return ['NON APPLICABLE si captcha ou si devient inutile avec une alternative'
				        ,'Attribut alt:'+ this.alt
								,'Élément parent: '+ tools.$(this).parent('a, button').textAndAlt()]
			}
      ,implemented: true
    },
    '4.3': {
      level:  'A'
      ,label: 'Pertinence de l\'alternative textuelle aux zones cliquables ou aux boutons graphiques'
			,elements: 'zonesCliquableGraphique'
      ,humanCheckElem: true
      ,hintElem: function(tools){
        return ['NON APPLICABLE si captcha ou si devient inutile avec une alternative'
                ,'Attribut alt:'+ this.alt]
      }
      ,implemented: true
    },
    '4.4': {
      level:  'A'
      ,label: 'Pertinence de l\'alternative textuelle aux éléments non textuels'
      ,implemented: false
    },
    '4.5': {
      level:  'A'
      ,label: 'Pertinence de l\'alternative textuelle vide aux éléments décoratifs'
      ,implemented: false
    },
    '4.6': {
      level:  'A'
      ,label: 'Longueur du contenu des alternatives textuelles'
			,elements: 'tousWithAltNonVide'
			,humanCheckElem: true
			,hintElem: function(){
				return 'Attribut alt (le plus concis possible?): '+this.alt;
			}
      ,implemented: true
    },
    '4.7': {
      level:  'A'
      ,label: 'Existence d\'une description longue pour les images le nécessitant'
      ,implemented: false
    },
    '4.8': {
      level:  'A'
      ,label: 'Pertinence de la description longue pour les images le nécessitant'
      ,implemented: false
    },
    '4.9': {
      level:  'A'
      ,label: 'Présence de l\'attribut longdesc pour établir une relation entre une image et sa description longue'
      ,implemented: false
    },
    '4.10': {
      level:  'A'
      ,label: 'Présence d\'une information de contexte et d\'une solution d\'accès pour les captcha lorsque l\'alternative ne peut pas être communiquée'
      ,implemented: false
    },
    '4.11': {
      level:  'AA'
      ,label: 'Cohérence dans l\'identification des alternatives textuelles et des étiquettes de formulaires'
      ,implemented: false
    }
	},
	'Multimédias': {
    '5.1': {
      level:  'A'
      ,label: 'Accès à une information synthétique pour les contenus sonores, visuel animé ou les médias synchronisés'
      ,implemented: false
    },
    '5.2': {
      level:  'A'
      ,label: 'Présence de la transcription textuelle des contenus visuels animés, sonores ou des médias synchronisés'
      ,implemented: false
    },
    '5.3': {
      level:  'A'
      ,label: 'Pertinence de la transcription textuelle des contenus visuels animés, sonores ou des médias synchronisés'
      ,implemented: false
    },
    '5.4': {
      level:  'A'
      ,label: 'Présence d\'un description audio synchronisée ou d\'une transcription textuelle pour les contenus visuels animés et les médias synchronisés'
      ,implemented: false
    },
    '5.5': {
      level:  'A'
      ,label: 'Pertinence de la description audio synchronisée des contenus visuels animés ou des médias synchronisés'
      ,implemented: false
    },
    '5.6': {
      level:  'A'
      ,label: 'Possibilité de contrôler l\'activation de la description audio synchronisée'
      ,implemented: false
    },
    '5.7': {
      level:  'AAA'
      ,label: 'Présence d\'une description audio synchronisée étendue pour les contenus visuels animés ou les médias synchronisés'
      ,implemented: false
    },
    '5.8': {
      level:  'AA'
      ,label: 'Présence d\'une description audio synchronisée pour les contenus visuels animés ou les médias synchronisés'
      ,implemented: false
    },
    '5.9': {
      level:  'A'
      ,label: 'Présence du sous-titrage synchronisé des médias synchronisés qui ne sont pas diffusés en direct'
      ,implemented: false
    },
    '5.10': {
      level:  'A'
      ,label: 'Pertinence du sous-titrage synchronisé des médias synchronisés'
      ,implemented: false
    },
    '5.11': {
      level:  'A'
      ,label: 'Présence d\'une alternative aux éléments applet et object'
      ,implemented: false
    },
    '5.12': {
      level:  'A'
      ,label: 'Présence d\'une alternative aux éléments embed'
      ,implemented: false
    },
    '5.13': {
      level:  'A'
      ,label: 'Absence d\'éléments provoquant des changements brusques de luminosité ou des effets de flash rouge à fréquence élevée'
      ,implemented: false
    },
    '5.14': {
      level:  'A'
      ,label: 'Absence de code javascript provoquant des changements brusques de luminosité ou des effets de flash rouge à fréquence élevée'
      ,implemented: false
    },
    '5.15': {
      level:  'A'
      ,label: 'Absence de mise en forme provoquant des changements brusques de luminosité ou des effets de flash rouge  à fréquence élevée'
      ,implemented: false
    },
    '5.16': {
      level:  'A'
      ,label: 'Compatibilité des éléments programmables avec les aides techniques'
      ,implemented: false
    },
    '5.17': {
      level:  'AAA'
      ,label: 'Absence totale de changements brusques de luminosité ou des effets flash rouge à fréquence élevée'
      ,implemented: false
    },
    '5.18': {
      level:  'AA'
      ,label: 'Présence du sous-titrage synchronisé des médias synchronisés ou sonores diffusés en direct'
      ,implemented: false
    },
    '5.19': {
      level:  'A'
      ,label: 'Absence de l\'élément blink'
			,testPage: function(tools, context){
				return (tools.$('blink', context).length == 0)? 'PASSED':'FAILED';
			}
      ,implemented: true
    },
    '5.20': {
      level:  'A'
      ,label: 'Absence d\'éléments provoquant des clignotements déclenchés automatiquement ne pouvant pas être arrêtés'
      ,implemented: false
    },
    '5.21': {
      level:  'A'
      ,label: 'Absence de code javascript provoquant des clignotements déclenchés automatiquement ne pouvant pas être arrêtés'
      ,implemented: false
    },
    '5.22': {
      level:  'A'
      ,label: 'Absence de mise en forme provoquant des clignotements déclenchés automatiquement ne pouvant pas être arrêtés'
      ,implemented: false
    },
    '5.23': {
      level:  'A'
      ,label: 'Absence d\'élément marquee'
			,testPage: function(tools, context){
				return (tools.$('marquee', context).length == 0)? 'PASSED':'FAILED';
			}
      ,implemented: true
    },
    '5.24': {
      level:  'A'
      ,label: 'Absence d\'éléments affichant des mouvements déclenchés automatiquement ne pouvant pas être arrêtés'
      ,implemented: false
    },
    '5.25': {
      level:  'A'
      ,label: 'Absence de code javascript provoquant des mouvements déclenchés automatiquement ne pouvant pas être arrêtés'
      ,implemented: false
    },
    '5.26': {
      level:  'A'
      ,label: 'Absence de mise en forme provoquant des mouvements déclenchés automatiquement ne pouvant pas être arrêtés'
      ,implemented: false
    },
    '5.27': {
      level:  'A'
      ,label: 'Indépendance du périphérique d\'accès aux éléments object, embed et applet'
      ,implemented: false
    },
    '5.28': {
      level:  'A'
      ,label: 'Présence d\'une alternative aux éléments object, applet et embed dépendant d\'un périphérique'
      ,implemented: false
    },
    '5.29': {
      level:  'A'
      ,label: 'Absence d\'éléments déclenchant la lecture de son ne pouvant pas être arrêtée'
      ,implemented: false
    },
    '5.30': {
      level:  'A'
      ,label: 'Absence d\'élément bgsound'
      ,testPage: function(tools, context){
        return (tools.$('bgsound', context).length == 0)? 'PASSED':'FAILED';
      }
      ,implemented: true
    },
    '5.31': {
      level:  'AAA'
      ,label: 'Présence de version en langue des signes française facilitant la compréhension des médias synchronisés'
      ,implemented: false
    },
    '5.32': {
      level:  'AAA'
      ,label: 'Pertinence de la version en langue des signes française'
      ,implemented: false
    },
    '5.33': {
      level:  'AAA'
      ,label: 'Niveau sonore de la piste de dialogue'
      ,implemented: false
    },
    '5.34': {
      level:  'AAA'
      ,label: 'Présence d\'un mécanisme pour personnaliser la couleur d\'avant plan et d\'arrière plan des blocs de texte'
      ,implemented: false
    }
	},
	'Navigation': {
	  '6.1': {
      level:  'A'
      ,label: 'Accès aux liens textuels doublant les zones cliquables côté serveur'
      ,implemented: true
    },
    '6.2': {
      level:  'A'
      ,label: 'Présence d\'un avertissement préalable à l\'ouverture de nouvelle fenêtre lors de l\'utilisation de l\'attribut target sur les liens textuels et les formulaires'
			,elements: 'formulairesLiens'
			,humanCheckElem: true
			,hintElem: function(tools){
				var ret;
				if (!tools.attrIsDefined(this, 'target')){
					return false;
				}
				
				if (this.target == '_top' || this.target == '_parent'){
					return false;
				}
				
				var children = tools.$('*', this);
				if (children.length == 1 && children[0].nodeName.toUpperCase() == 'IMG'){
					return false;
				}
				
				var hints = ['L\'avertissement est-il présent dans l\'élément ?',
				             'L\'avertissement est-il présent dans l\'élément parent si celui est "p" ou "li" ?',
				             'L\'avertissement est-il présent dans le titre (hx) précédent ?',
										 'L\'avertissement est-il présent dans les éléments de listes (li) imbriqués dans lequel se trouve l\'élément ?'
				];
				
				var text = tools.$(this).textAndAlt();
				var title = tools.$(this).attr('title');
				if (title.length>text.length){
					hints.push('L\'attribut title contient-il l\'avertissement : '+ title)
				}
				
				if (tools.$(this).closest('table').length){
					hints.push('L\'avertissement est-il présent dans une cellule d\'entête du tableau conteneur ?')
				}
				
				return hints;
			}
      ,implemented: true
    },
    '6.3': {
      level:  'A'
      ,label: 'Présence d\'un avertissement préalable à l\'ouverture de nouvelle fenêtre lors de l\'utilisation de l\'attribut target sur les images liens et les zones cliquables'
			,elements: 'liensQueImageArea'
			,humanCheckElem: true
			,hintElem: function(){
				if (!tools.attrIsDefined(this, 'target')){
          return false;
        }
        
				if (this.target == '_top' || this.target == '_parent' || this.target == '_self'){
          return false;
        }
				
				if (!tools.attrIsDefined(this, 'alt') && !tools.attrIsDefined(tools.$(this).find('img')[0], 'alt')){
					return false;
				}
				
				var alt;
				if (this.nodenName.toUpperCase() == 'A'){
					alt = tools.$(this).find('img').attr('alt');
				} else {
					// élément area
					alt = tools.$(this).attr('alt');
				}
				
				var hints = ['L\'avertissement est-il présent dans l\'attibut alt : ' + alt,
                     'L\'avertissement est-il présent dans le texte récupérable : ' + tools.$(this).text(),
                     'L\'avertissement est-il présent dans l\'élément parent si celui est "p" ou "li" ?',
                     'L\'avertissement est-il présent dans le titre (hx) précédent ?',
										 'L\'avertissement est-il présent dans les éléments de listes (li) imbriqués dans lequel se trouve l\'élément ?'
				];
        if (tools.$(this).closest('table').length){
          hints.push('L\'avertissement est-il présent dans une cellule d\'entête du tableau conteneur ?')
        }
        
				return hints
			}
      ,implemented: true
    },
    '6.4': {
      level:  'A'
      ,label: 'Présence d\'un avertissement préalable à l\'ouverture de nouvelle fenêtre lors de l\'utilisation de code javascript'
      ,implemented: false
    },
    '6.5': {
      level:  'A'
      ,label: 'Absence d\'ouverture de nouvelles fenêtres sans action de l\'utilisateur'
      ,implemented: false
    },
    '6.6': {
      level:  'A'
      ,label: 'Absence de piège lors de la navigation clavier'
      ,implemented: false
    },
    '6.7': {
      level:  'A'
      ,label: 'Absence d\'élément meta provoquant un rafraîchissement automatique de la page'
			,elements: 'metaHttpEquivRefresh'
			,humanCheckElem: true
			,hintElem: function(tools){
				if (!tools.attrIsDefined(this, 'content')){
					return false;
				}
				
				var content = parseInt(tools.$(this).attr('content'));
				if (content < 0 || content > 72000){
					return false;
				}
				
				var hints = ['Attribut content : '+this.content,
				             'Si la limite peut être supprimée sans changer l\'information ou les fonctionnalités du contenu alors "FAILED"',
										 'Si il y a une valeur url dans l\'attribut "content" différente de l\'url de la page alors "PASSED"',
										 'URL de la page courante : ' + document.location
				];
				
				return hints;
			}
      ,implemented: false
    },
    '6.8': {
      level:  'A'
      ,label: 'Absence de code javascript provoquant un rafraîchissement automatique de la page ne pouvant pas être arrêté'
      ,implemented: false
    },
    '6.9': {
      level:  'A'
      ,label: 'Absence d\'éléments provoquant un rafraîchissement automatique de la page ne pouvant pas être arrêté'
      ,implemented: false
    },
    '6.10': {
      level:  'A'
      ,label: 'Absence d\'élément meta provoquant une redirection automatique de la page'
			,elements: 'metaHttpEquivRefresh'
			,humanCheckElem: true
			,hintElem: function(tools){
				if (!tools.attrIsDefined(this, 'content')){
					return false;
				};
				
        var content = parseInt(tools.$(this).attr('content'));
        if (content < 0 || content > 72000){
          return false;
        }
				
        var hints = ['Attribut content : '+this.content,
	                   'Si la limite peut être supprimée sans changer l\'information ou les fonctionnalités du contenu alors "FAILED"',
	                   'Si il y a une valeur url dans l\'attribut "content" égale à l\'url de la page alors "PASSED"',
	                   'URL de la page courante : ' + document.location
        ];
				
			}
      ,implemented: true
    },
    '6.11': {
      level:  'A'
      ,label: 'Absence de code javascript provoquant une redirection automatique de la page ne pouvant pas être arrêtée'
      ,implemented: false
    },
    '6.12': {
      level:  'A'
      ,label: 'Absence d\'éléments provoquant une redirection automatique de la page ne pouvant pas être arrêtée'
      ,implemented: false
    },
    '6.13': {
      level:  'A'
      ,label: 'Possibilité d\'identifier la destination ou l\'action des liens et des boutons'
			,elements: 'liensEtBoutons'
			,humanCheckElem: true
			,hintElem: function(tools){
				var hints = [
				  'Intitulé : ' + tools.$(this).text()
					,'Attribut title :' + this.title
					,'Si l\'intitulé seul, hors contexte, permet de d\'identifier la destination, alors "NOT APPLICABLE"'
					,'Si la destination est identifiable avec l\'intitulé plus l\'élément parent si celui est "p" ou "li", alors "PASSED"'
					,'Si la destination est identifiable avec l\'intitulé plus le titre (hx) précédent, alors "PASSED"'
					,'Si la destination est identifiable avec l\'intitulé plus les éléments de listes (li) imbriqués dans lequel se trouve l\'élément, alors "PASSED"'
					,'Si la destination est identifiable avec l\'intitulé plus une cellule d\'entête du tableau conteneur, alors "PASSED"'
					,'Si aucun des cas précédents, alors "FAILED"'
				];
				
				return hints;
			}
      ,implemented: true
    },
    '6.14': {
      level:  'AAA'
      ,label: 'Possibilité d\'identifier la destination ou l\'action des liens et des boutons (intitulé seul)'
			,elements: 'liensEtBoutons'
			,humanCheckElem: true
			,hintElem: function(tools){
				return 'Intitulé seul :' + tools.$(this).text();
			}
      ,implemented: true
    },
    '6.15': {
      level:  'A'
      ,label: 'Cohérence de la destination ou de l\'action des liens ayant un intitulé identique'
      ,implemented: false
    },
    '6.16': {
      level:  'A'
      ,label: 'Absence de liens sans intitulé'
			,elements: 'liens'
			,testElem: function(tools){
				var href;
				if (tools.attrIsDefined(this, 'href')){
					href = this.href;
				}
				var id;
        if (tools.attrIsDefined(this, 'id')){
          id = this.id;
        }
        var name;
        if (tools.attrIsDefined(this, 'name')){
          name = this.name;
        }
				
				if (href){
					if (href.substring(0,1) == '#'){
						href = href.substring(1, href.length)
						if ((href == id || href == name) && href.length){
							return 'NOT APPLICABLE';
						}
					}
					var intitule = tools.$.trim(tools.$(this).textAndAlt());
					return (intitule.length)? 'PASSED':'FAILED';
				} else {
					return 'NOT APPLICABLE'
				}
			}
      ,implemented: true
    },
    '6.17': {
      level:  'A'
      ,label: 'Présence d\'une page contenant le plan du site'
      ,implemented: false
    },
    '6.18': {
      level:  'AA'
      ,label: 'Cohérence du plan du site'
      ,implemented: false
    },
    '6.19': {
      level:  'AA'
      ,label: 'Présence d\'un accès à la page contenant le plan du site depuis la page d\'accueil'
      ,implemented: false
    },
    '6.20': {
      level:  'AAA'
      ,label: 'Présence d\'un fil d\'ariane'
      ,implemented: false
    },
    '6.21': {
      level:  'AA'
      ,label: 'Présence de menus ou de barres de navigation'
      ,implemented: false
    },
    '6.22': {
      level:  'AA'
      ,label: 'Cohérence de la position des menus et barres de navigation dans le code source de la structure HTML'
      ,implemented: false
    },
    '6.23': {
      level:  'AA'
      ,label: 'Cohérence de la présentation des menus et barres de navigation'
      ,implemented: false
    },
    '6.24': {
      level:  'A'
      ,label: 'Navigation au clavier dans un ordre logique par rapport au contenu'
      ,implemented: false
    },
    '6.25': {
      level:  'AAA'
      ,label: 'Présence d\'un avertissement préalable à l\'ouverture de nouvelle fenêtre lors de l\'utilisation d\'éléments object ou embed'
      ,implemented: false
    },
    '6.26': {
      level:  'A'
      ,label: 'Présence des informations de format pour les documents en téléchargement.'
      ,implemented: false
    },
    '6.27': {
      level:  'A'
      ,label: 'Présence des informations de poids pour les documents en téléchargement'
      ,implemented: false
    },
    '6.28': {
      level:  'A'
      ,label: 'Présence des informations de langue pour les documents en téléchargement'
      ,implemented: false
    },
    '6.29': {
      level:  'A'
      ,label: 'Présence de regroupement pour les liens importants'
      ,implemented: false
    },
    '6.30': {
      level:  'A'
      ,label: 'Présence d\'un balisage permettant d\'identifier les groupes de liens importants'
      ,implemented: false
    },
    '6.31': {
      level:  'A'
      ,label: 'Présence de liens d\'évitement ou d\'accès rapide aux groupes de liens importants'
      ,implemented: false
    },
    '6.32': {
      level:  'A'
      ,label: 'Cohérence des liens d\'évitement ou d\'accès rapide aux groupes de liens importants'
      ,implemented: false
    },
    '6.33': {
      level:  'AA'
      ,label: 'Ordre des liens d\'évitement ou d\'accès rapide dans le code source des pages'
      ,implemented: false
    },
    '6.34': {
      level:  'AA'
      ,label: 'Présence d\'un moteur de recherche'
      ,implemented: false
    },
    '6.35': {
      level:  'AA'
      ,label: 'Possibilité de naviguer facilement dans un groupe de pages'
      ,implemented: false
    },
    '6.36': {
      level:  'AAA'
      ,label: 'Présence d\'une indication de la position courante dans la navigation'
      ,implemented: false
    }
	},
	'Présentation': {
		'7.1': {
      level:  'A'
      ,label: 'Absence de génération de contenus porteur d\'information via les styles CSS'
      ,implemented: false
    },
    '7.2': {
      level:  'A'
      ,label: 'Absence d\'altération de la compréhension lors de la lecture d\'un bloc d\'informations lorsque les styles sont désactivés'
      ,implemented: false
    },
    '7.3': {
      level:  'A'
      ,label: 'Lisibilité des informations affichées comme fond d\'éléments via les styles CSS lorsque les styles et/ou les images sont désactivés'
      ,implemented: false
    },
    '7.4': {
      level:  'A'
      ,label: 'Absence d\'espaces utilisés pour séparer les lettres d\'un mot'
      ,implemented: false
    },
    '7.5': {
      level:  'AA'
      ,label: 'Absence de définition d\'une couleur de texte sans définition d\'une couleur de fond et inversement'
      ,implemented: false
    },
    '7.6': {
      level:  'AA'
      ,label: 'Possibilité de remplacer les éléments non textuels par une mise en forme effectuée grâce aux styles CSS'
      ,implemented: false
    },
    '7.7': {
      level:  'AAA'
      ,label: 'Possibilité de remplacer les éléments non textuels par une mise en forme effectuée grâce aux styles CSS (sans exceptions)'
      ,implemented: false
    },
    '7.8': {
      level:  'A'
      ,label: 'Absence d\'attributs ou d\'éléments HTML de présentation'
			,testPage: function(tools){
				return (tools.$('basefont, blink, center, font, marquee, s, strike, tt, u, '+
				                '[align], [alink], [background], [basefont], [bgcolor], [border], '+
												'[color], [link], [text], [vlink]').length == 0) ? 'PASSED':'FAILED'
			}
      ,implemented: true
    },
    '7.9': {
      level:  'A'
      ,label: 'Absence d\'éléments HTML utilisés à des fins de présentation.'
			,elements: 'elementPresentation'
			,humanCheckElem: true
			,hintElem: function(){
				return 'Si l\'élément est utilisé à des fins de présentations alors "FAILED", sinon "PASSED"';
			}
      ,implemented: true
    },
    '7.10': {
      level:  'A'
      ,label: 'Maintien de la distinction visuelle des liens'
      ,implemented: false
    },
    '7.11': {
      level:  'A'
      ,label: 'Absence de suppression de l\'effet visuel au focus des éléments'
      ,implemented: false
    },
    '7.12': {
      level:  'AAA'
      ,label: 'Absence de justification du texte'
			,elements: 'tous'
			,testElem: function(tools){
				if (this.align && this.align.toLowerCase() == 'justify'){
					return 'FAILED';
				}
				if (tools.$(this).css('text-align') == 'justify'){
					return 'FAILED';
				}
				return 'PASSED';
			}
      ,implemented: true
    },
    '7.13': {
      level:  'AA'
      ,label: 'Lisibilité du document en cas d\'agrandissement de la taille du texte'
      ,implemented: false
    },
    '7.14': {
      level:  'AA'
      ,label: 'Absence d\'unités absolues ou de pixel dans les feuilles de styles pour la taille de caractère des éléments de formulaire.'
      ,implemented: false
    },
    '7.15': {
      level:  'AAA'
      ,label: 'Absence d\'apparition de barre de défilement horizontale en affichage plein écran'
      ,implemented: false
    },
    '7.16': {
      level:  'AAA'
      ,label: 'Largeur des blocs de textes'
      ,implemented: false
    },
    '7.17': {
      level:  'AAA'
      ,label: 'Valeur de l\'espace entre les lignes et entre les paragraphes'
      ,implemented: false
    },
    '7.18': {
      level:  'A'
      ,label: 'Restitution correcte dans les lecteurs d\'écran des éléments masqués'
      ,implemented: false
    }
	},
	'Scripts': {
    '8.1': {
      level:  'A'
      ,label: 'Mise à jour des alternatives aux éléments non textuels dans la page'
      ,implemented: false
    },
    '8.2': {
      level:  'A'
      ,label: 'Universalité du gestionnaire d\'évènement onclick'
      ,implemented: false
    },
    '8.3': {
      level:  'A'
      ,label: 'Universalité des gestionnaires d\'évènements'
      ,implemented: false
    },
    '8.4': {
      level:  'AAA'
      ,label: 'Possibilité de désactiver toute alerte non sollicitée ou toute mise à jour automatique d\'un contenu de la page'
      ,implemented: false
    },
    '8.5': {
      level:  'A'
      ,label: 'Absence de changements de contexte suite à une action de l\'utilisateur sans validation explicite ou information préalable'
      ,implemented: false
    },
    '8.6': {
      level:  'A'
      ,label: 'Ordre d\'accès au clavier aux contenus mis à jour dynamiquement en javascript'
      ,implemented: false
    },
    '8.7': {
      level:  'A'
      ,label: 'Utilisation correcte du rôle des éléments'
      ,implemented: false
    },
    '8.8': {
      level:  'A'
      ,label: 'Présence d\'une alternative au code javascript utilisant un gestionnaire d\'événements sans équivalent universel ou une propriété propre à un périphérique'
      ,implemented: false
    },
    '8.9': {
      level:  'A'
      ,label: 'Absence de suppression du focus clavier à l\'aide de code javascript.'
      ,implemented: false
    },
    '8.10': {
      level:  'AAA'
      ,label: 'Absence de limite de temps pour compléter une tâche'
      ,implemented: false
    },
    '8.11': {
      level:  'AAA'
      ,label: 'Absence de perte d\'informations lors de l\'expiration des sessions authentifiées'
      ,implemented: false
    },
    '8.12': {
      level:  'A'
      ,label: 'Présence d\'une alternative au code javascript'
      ,implemented: false
    },
    '8.13': {
      level:  'A'
      ,label: 'Accessibilité des contenus dynamiques en javascript'
      ,implemented: false
    }
	},
	'Standards': {
    '9.1': {
      level:  'A'
      ,label: 'Présence de la déclaration d\'utilisation d\'une DTD'
			,testPage: function(tools){
				var src = tools.getSourceCode();
				if (src === false){
					return 'HUMAN CHECK';
				}
				return (/!DOCTYPE/.test(src))? "PASSED":"FAILED";
			}
			,hintPage: function(tools, context, res){
				if (res == 'FAILED'){
					return '';
				} else {
  				return 'Le code source n\'a pu être récupéré. Vérifier manuellement la présence d\'un DOCTYPE';
				}
			}
      ,implemented: true
    },
    '9.2': {
      level:  'A'
      ,label: 'Conformité de la position de la déclaration d\'utilisation d\'une DTD'
			,testPage: function(tools){
				var src = tools.getSourceCode().toUpperCase();
        if (src === false){
          return 'HUMAN CHECK';
        } else {
					var iDoctype = src.indexOf('!DOCTYPE');
					var iHtml = src.indexOf('<HTML');
					
					if (iDoctype == -1){
						return 'NOT APPLICABLE'
					}
					if (iHtml == -1){
						return "FAILED";
					} else {
						return (src.indexOf('!DOCTYPE')<src.indexOf('<HTML'))? 'PASSED':'FAILED';
					}
				}
			}
			,hintPage: function(tools, context, res){
        if (res == 'FAILED'){
          return '';
        } else {
          return 'Le code source n\'a pu être récupéré. Vérifier manuellement la conformité du DOCTYPE';
        }
			}
      ,implemented: true
    },
    '9.3': {
      level:  'A'
      ,label: 'Conformité syntaxique de la déclaration d\'utilisation d\'une DTD'
			,testPage: function(tools){
				var doctype = tools.getDoctype();
				if (doctype){
					return (tools.doctypeIsValid(doctype))? 'PASSED':'FAILED';
				} else {
					return 'NOT APPLICABLE';
				}
			}
      ,implemented: true
    },
    '9.4': {
      level:  'A'
      ,label: 'Validité du code HTML / XHTML au regard de la DTD déclarée'
      ,implemented: false
    },
    '9.5': {
      level:  'A'
      ,label: 'Absence de composants obsolètes par rapport à la version des spécifications W3C utilisée'
			,testPage: function(tools){
				// TODO: vérifier la liste et voir si il ne faudrait pas une fonction prenant en compte le doctype
				var deprecated = tools.$('applet, basefont, blackface, blockquote, center, dir, embed, font, '+
				                         'i, isindex, layer, menu, noembed, s, shadow, strike, u'+
																 '[alink], [align], [background], [border], [color], [compact], [face], '+
																 '[height], [language], [link], [name], [noshade], [nowrap], [size], '+
																 '[start], [text], li[type], li[value], [version], [vlink], [width]'
																 );
        return (deprecated.length == 0)? 'PASSED':'FAILED';
			}
      ,implemented: false
    },
    '9.6': {
      level:  'A'
      ,label: 'Présence d\'un titre dans la page'
			,testPage: function(tools){
				return (tools.$('title').length == 1)? 'PASSED':'FAILED';
			}
      ,implemented: true
    },
    '9.7': {
      level:  'A'
      ,label: 'Pertinence du titre de la page'
			,humanCheckPage: true
			,hintPage: function(tools){
				var title = tools.$('title');
				if (title.length == 0){
					return false;
				} else {
					return 'Contenu de l\'élément title : '+ tools.$(title).text();
				}
				
			}
      ,implemented: true
    },
    '9.8': {
      level:  'A'
      ,label: 'Présence d\'une langue de traitement'
      ,implemented: false
    }
	},
	'Structures': {
    '10.1': {
      level:  'A'
      ,label: 'Présence d\'au moins un titre de hiérarchie de premier niveau ( h1)'
			,testPage: function(tools){
				return (tools.$('h1').length >= 1)? 'PASSED':'FAILED';
			}
      ,implemented: true
    },
    '10.2': {
      level:  'A'
      ,label: 'Pertinence du contenu des titres de hiérarchie'
			,elements: 'titresContenu'
			,humanCheckElem: true
			,hintElem: function(tools){
				return tools.$(this).text();
			}
      ,implemented: true
    },
    '10.3': {
      level:  'A'
      ,label: 'Absence d\'interruption dans la hiérarchie de titres'
			,testPage: function(tools){
				var titres = tools.$('h1, h2, h3, h4, h5, h6');
				var result = 'PASSED';
				if (titres.length == 0){
					result = 'NOT APPLICABLE';
				} else {
					for (var i = titres.length-1; i>0; i--){
						titleRange = parseInt(titres[i].nodeName.replace(/h/i, ''));
						previousRange = parseInt(titres[i-1].nodeName.replace(/h/i, ''));
						
						if (titleRange - previousRange == 0
						    || titleRange - previousRange == 1
								|| titleRange - previousRange <= 4){
	             result = 'FAILED';
							 break;
						}
					}
				}
				return result;
			}
			,hintPage: function(tools){
				var titres = [];
				tools.$('h1, h2, h3, h4, h5, h6').each(function(){
					titres.push(this.nodeName);
				});
				return 'Vérifier l\'enchaînement des titres de la page : '+ titres.join(', ');
			}
      ,implemented: true
    },
    '10.4': {
      level:  'A'
      ,label: 'Présence d\'une hiérarchie de titres complète'
      ,implemented: false
    },
    '10.5': {
      level:  'A'
      ,label: 'Absence de simulation visuelle de liste non ordonnée'
      ,implemented: false
    },
    '10.6': {
      level:  'A'
      ,label: 'Utilisation systématique de listes ordonnées pour les énumérations'
      ,implemented: false
    },
    '10.7': {
      level:  'A'
      ,label: 'Balisage correct des listes de définitions'
			,elements: 'listesDefinition'
			,testElem: function(tools){
				var result = 'PASSED';
				tools.$('dd', this).each(function(){
					if (tools.$(this).prevAll('dt').length == 0) {
						result = 'FAILED';
						return false;
					}
				});
				return result;
			}
      ,implemented: true
    },
    '10.8': {
      level:  'A'
      ,label: 'Balisage correct des citations'
      ,implemented: false
    },
    '10.9': {
      level:  'AAA'
      ,label: 'Balisage correct des abréviations présentes dans la page'
      ,implemented: false
    },
    '10.10': {
      level:  'AAA'
      ,label: 'Balisage correct des acronymes présents dans la page'
      ,implemented: false
    },
    '10.11': {
      level:  'AAA'
      ,label: 'Pertinence de la version non abrégée de l\'abréviation'
      ,implemented: false
    },
    '10.12': {
      level:  'AAA'
      ,label: 'Pertinence de la version complète de l\'acronyme'
      ,implemented: false
    },
    '10.13': {
      level:  'A'
      ,label: 'Accessibilité des documents bureautiques en téléchargement'
      ,implemented: false
    }
	},
	'Tableaux': {
		// TODO: comment détecter les tableaux de données ? prévoir une solution
		// pour que les utilisateurs les indiquent manuellement.
		// généraliser cela à d'autres éléments tels que abréviation, acronymes... 
    '11.1': {
      level:  'A'
      ,label: 'Présence des balises th pour indiquer les en-têtes de lignes et de colonnes dans les tableaux de données'
      ,implemented: false
    },
    '11.2': {
      level:  'A'
      ,label: 'Présence d\'une relation entre les en-têtes (th) et les cellules (td) qui s\'y rattachent dans un tableau de données simple grâce aux attributs id et headers ou scope'
      ,implemented: false
    },
    '11.3': {
      level:  'A'
      ,label: 'Présence d\'une relation entre les en-têtes (th) et les cellules (td) qui s\'y rattachent dans un tableau de données complexe grâce aux attributs id et headers'
      ,implemented: false
    },
    '11.4': {
      level:  'A'
      ,label: 'Absence des éléments propres aux tableaux de données dans les tableaux de mise en page'
      ,implemented: false
    },
    '11.5': {
      level:  'A'
      ,label: 'Absence de tableaux de données ou de colonnes formatés à l\'aide de texte'
      ,implemented: false
    },
    '11.6': {
      level:  'A'
      ,label: 'Linéarisation correcte des tableaux de mise en page'
      ,implemented: false
    },
    '11.7': {
      level:  'A'
      ,label: 'Présence d\'un titre pour les tableaux de données'
      ,implemented: false
    },
    '11.8': {
      level:  'A'
      ,label: 'Présence d\'un résumé pour les tableaux de données'
      ,implemented: false
    },
    '11.9': {
      level:  'A'
      ,label: 'Pertinence du titre du tableau de données'
      ,implemented: false
    },
    '11.10': {
      level:  'A'
      ,label: 'Pertinence du résumé du tableau de données'
      ,implemented: false
    }
	},
	'Textes': {
    '12.1': {
      level:  'AA'
      ,label: 'Présence de l\'indication des changements de langue dans le texte'
      ,implemented: false
    },
    '12.2': {
      level:  'AA'
      ,label: 'Présence de l\'indication des changements de langue dans les valeurs d\'attributs HTML'
      ,implemented: false
    },
    '12.3': {
      level:  'A'
      ,label: 'Equivalence de l\'information mise à disposition dans la version alternative'
      ,implemented: false
    },
    '12.4': {
      level:  'AAA'
      ,label: 'Présence de liens ou de définitions permettant d\'avoir accès aux informations nécessaires à la compréhension des contenus'
      ,implemented: false
    },
    '12.5': {
      level:  'A'
      ,label: 'Absence de syntaxes cryptiques par rapport au contenu de votre site'
      ,implemented: false
    },
    '12.6': {
      level:  'AAA'
      ,label: 'Présence d\'informations sur les mots par la mise à disposition de leur prononciation phonétique'
      ,implemented: false
    },
    '12.7': {
      level:  'A'
      ,label: 'Présence d\'un moyen de transmission de l\'information autre qu\'une utilisation de la forme ou la position dans les éléments non textuels'
      ,implemented: false
    },
    '12.8': {
      level:  'A'
      ,label: 'Présence d\'un autre moyen que la forme ou la position pour identifier un contenu auquel il est fait référence dans un élément non textuel'
      ,implemented: false
    },
    '12.9': {
      level:  'A'
      ,label: 'Présence d\'un autre moyen que la forme ou la position pour identifier un contenu auquel il est fait référence textuellement'
      ,implemented: false
    },
    '12.10': {
      level:  'AAA'
      ,label: 'Utilisation d\'un style de rédaction simple et compréhensible de tous'
      ,implemented: false
    }
	}
};
