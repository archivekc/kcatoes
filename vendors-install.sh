#!/bin/sh

# Installation des sources des outils complémentaires

CURRENT_DIR=`pwd`

# Symfony 1.4 (pour KCatoès)
git clone git://github.com/symfony/symfony1.git $CURRENT_DIR/lib/vendor/symfony-1.4
     
# Symfony2 (pour Goutte)
git clone git://github.com/symfony/symfony.git $CURRENT_DIR/lib/vendor/goutte/src/vendor/symfony

# Zend Framework (pour Goutte)
git clone git://github.com/zendframework/zf2.git $CURRENT_DIR/lib/vendor/goutte/src/vendor/zend
