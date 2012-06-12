<?php include_component('editorial', 'menuDisplay')?>

<h1>Aide de KCatoès</h1>

<h2>Utilisation</h2>
<p>La présente interface propose d'associer des pages web avec des configurations de test.</p>
<dl>
  <dt>Page web&nbsp;:</dt>
  <dd>Une page est représentée par son url</dd>
  <dt>Configuration de test&nbsp;:</dt>
  <dd>Une configuration de test représente un ensemble de tests qu'il convient de passer sur une page web. Elle est identifiée par un libellé.</dd>
</dl>
<p>Il est possible d'ajouter des pages web et des configurations de test depuis la page d'accueil.</p>
<p>Pour chaque page web et pour chaque configuration de test, un écran est disponible (accessible par un lien dans la page d'accueil).</p>

<h2>Configuration de test</h2>
<p>L'écran d'une configuration de test permet de définir les tests (parmi tous les tests disponibles).</p>

<h2>Page web</h2>
<p>L'écran d'une page web permet d'associer une ou plusieurs configurations de tests à la page web.</p>
<p>Une fois l'association faite, les tests sont lancés.</p>
<p>Une page de confirmation est affichée. Elle permet de voir la liste des tests qui ont été passés. Il est également possible de visualiser l'interface d'évaluation qui a été générée</p>
<p>Si les tests avaient déjà été lancés, alors pour chaque association deux liens sont présentés&nbsp;:</p>
<ul>
  <li>Un lien vers la dernière version du rapport d'évaluation.</li>
  <li>Un lien vers la dernière sauvegarde automatique (si elle existe) du rapport d'évaluation.</li>
</ul>
<h2>Page scenarii</h2>
<p>L'écran des scenarii permet de définir des groupes de pages web sur lesquelles seront passés les tests.</p>
<p>Ce regroupement permet alors d'obtenir les indicateurs, rapports, etc. agrégés pour cet ensemble.</p>

