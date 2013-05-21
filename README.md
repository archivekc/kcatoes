KCatoès
=======

KCatoès est un outil automatique d'assistance aux tests d'accessiblité sur les pages Web.


L'originalité de KCatoès est de permettre l'automatisation de tests de manière partielle ou complète.

En effet, si certaines vérifications sont objectives et permettent une automatisation complète, d'autres sont parfois de nature subjective. Une intervention humaine est alors indispensable pour valider ou non le test.

Afin d'aider le testeur dans la validation des tests dits subjectifs, KCatoès est capable de présenter des informations de contexte qui aideront l'évaluateur à déterminer le résultat. 

Voir aussi: http://opensource.keyconsulting.fr/kcatoes/

Fonctionnalités
===============


- Enregistrer différents états d'une page web ;
- Passer des tests sur les pages ;
- Fournir une interface d'évaluation pour compléter les tests non complétement automatisables ;
- Regrouper les pages web par scénario ;
- Fournir des rapports synthétiques fournissant un pourcentage de conformité.

Actuellement, KCatoès implémente les tests du RGAA.

Une interface basique permet de sélectionner et d'enregistrer des configurations de tests (sous ensemble des tests implémentés) puis de lancer une évaluation sur une page.

Génération de rapports au format HTML permettant de mettre en rapport les résultats des tests et la page testée.

L'interface permet à l'évaluateur de modifier le résultat si nécessaire, d'ajouter une annotation afin de simplifier la collaboration.

Différents formats de sorties sont proposés afin de simplifier l'intégration de KCatoès dans différents environnements.

- JSON utilisable à travers un web service
- CSV utilisable dans un tableur (Microsoft Excel, Libre Office Calc, etc.)
- HTML simple pour un rapport minimal

Installation
============


1. Déposer le code source sur un serveur

  à partir de l'archive KCatoes_vx.y.z.tar.gz
  OU
  git clone https://github.com/key-consulting/kcatoes.git
  
2. Se déplacer à la racine du projet et lancer le script d'installation des bibliothèques et du framework :
   
   vendors-install.sh
   
   Ce script récupère les éléments suivants via git clone :
        Symfony 1.4.x framework principal
        Symfony 2.x pour Goutte
        Goutte crawler web

3. Configurer les identifiants de la base de données de l'environnement dans /config/databases.yml

4. Initialiser un Virtualhost Apache :
       <VirtualHost *:80>
          ServerName <nom du serveur>
          RewriteEngine On
          DocumentRoot "<chemin du projet>/web"
          DirectoryIndex frontend_dev.php, index.php
          ErrorLog "logs/kcatoes.error.log"
          <Directory "<chemin du projet>/web">
             AllowOverride All
             Allow from all
          </Directory>

          Alias /sf "<chemin du projet>/lib/vendor/symfony-1.4/data/web/sf"
          <Directory "<chemin du projet>/lib/vendor/symfony-1.4/data/web/sf">
             AllowOverride All
             Allow from all
          </Directory>
       </VirtualHost>
    		

5. Redémarrer le serveur Apache

6. Dans la racine du projet, lancer les commandes suivantes :
  - php ./symfony doctrine:build --application=frontend --env=<environnement> --all
    (L'environnement peut prendre les valeurs suivantes : dev, test, prod)
  - php ./symfony cc

