<?php

/**
 *
 * Transformer un chemin de fichier pour un téléchargement web
 * @param (string) $path
 */
function transformForWeb($path)
{
  return '/'.str_replace('\\','/',$path);
}
