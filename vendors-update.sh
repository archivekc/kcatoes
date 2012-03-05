#!/bin/sh

# Mise à jour des sources des outils complémentaires

CURRENT_DIR=`pwd`

# Symfony 1.4 (pour KCatoès)
cd $CURRENT_DIR/lib/vendor/symfony-1.4 && git pull

# Symfony2 (pour Goutte)
cd $CURRENT_DIR/lib/vendor/goutte/src/vendor/symfony && git pull

# Zend Framework (pour Goutte)
cd $CURRENT_DIR/lib/vendor/goutte/src/vendor/zend && git pull
