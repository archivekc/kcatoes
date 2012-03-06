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
var formTpl = '<form method="post" action="#ACTION#" class="KCADDED">'+
                '<input type="text" name="log" value=""/>'+
                '<input type="text" name="url" value=""/>'+
              '</form>';

var optionDialogTpl = '<div class="KCOPTIONS">'+
                        '<h2>Sélectionner les tests à passer</h2>'+
												'#LIST#'+
											'</div>';
													