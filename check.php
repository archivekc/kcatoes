<?php
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

// concatène les scripts à envoyer au client
include('./js/settings.js');

include('./libs/jquery-1.4.2.min.js');
include('./libs/jquery.json-2.2.min.js');
include('./libs/jquery-ui-1.8.5.custom.min.js');

include('./js/templates.js');
include('./js/listTest.js');
?>

// no conflict!!
var KC$ = jQuery.noConflict();

<?php
include('./js/check_accessibility.js');
include('./js/check.js');
?>