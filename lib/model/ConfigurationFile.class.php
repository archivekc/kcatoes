<?php

/**
 * Gère les différentes actions liées aux fichiers de configuration
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class ConfigurationFile
{
  /**
   * Créé un fichier de configuration à partir d'une liste de noms de tests
   *
   * @param array $testsNames La liste des noms des tests à inclure dans le
   *                          fichier de configuration
   *
   * @return String Le chemin d'accès au fichier de configuration créé
   *
   * @throws KcatoesConfigurationFileException Si le fichier ne peut pas être créé
   */
  public static function create($testsNames)
  {
    $config = array(
      'Tests'   => $testsNames,
      'Version' => sfConfig::get('app_version'),
      'Date'    => date('Y.m.d')
    );

    $yamlConfig = sfYaml::dump($config);

    $fileName   = 'download'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR
                  .'kcatoes.yml';
    $configFile = fopen($fileName, "wb");
    if (!$configFile)
    {
      throw new KcatoesConfigurationFileException(
        'Erreur lors de la création du fichier de configuration'
      );
    }
    fwrite($configFile, $yamlConfig);
    fclose($configFile);

    return $fileName;
  }

  /**
   * Charge la configuration contenue dans un fichier de configuration.
   * Pour être utilisable, le fichier doit:
   *  - ne pas être vide
   *  - respecter la syntaxe YAML
   *  - contenir les options Test et Version
   *  - avoir un paramètre de version compatible avec celle de KCatoès
   *
   * @param String $fileName Le chemin d'accès au fichier à charger
   *
   * @return array La configuration sous forme de tableau
   *
   * @throws KcatoesConfigurationFileException Si le fichier n'est pas utilisable
   */
  public static function load($fileName)
  {
    $requiredOptions = array('Tests', 'Version');
    $allowedVersions = array(sfConfig::get('app_version'));
    $structureValide = true;

    $parser = new sfYamlParser();
    $input = file_get_contents($fileName);

    try
    {
      $config = $parser->parse($input);
    }
    catch (InvalidArgumentException $e)
    {
      sfContext::getInstance()->getLogger()->err($e->getMessage());
      throw new KcatoesConfigurationFileException(
        'Le contenu du fichier n\'est pas une structure YAML valide'
      );
    }
    if (empty($config))
    {
      throw new KcatoesConfigurationFileException(
        'Le fichier de configuration est vide'
      );
    }

    foreach ($requiredOptions as $option)
    {
      $structureValide &= array_key_exists($option, $config);
    }

    if (!$structureValide)
    {
      throw new KcatoesConfigurationFileException(
        'La structure du fichier ne correspond pas à celle attendue'
      );
    }

    if (!in_array($config['Version'], $allowedVersions))
    {
      throw new KcatoesConfigurationFileException(
        'Le fichier de configuration n\'est pas compatible '.
        'avec cette version de KCatoès'
      );
    }

    $selectedTests = array();
    foreach ($config['Tests'] as $testName)
    {
      $test = Doctrine_Core::getTable('test')->findOneByNom($testName);

      $selectedTests[] = $test->getId();
    }

    $config['Tests'] = $selectedTests;

    return $config;
  }
}