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
   * Créé un fichier de configuration à partir d'une liste d'options. Les options
   * doivent être stockées dans la liste au format:
   * nom de l'option => valeur
   *
   * @param array $options Une liste d'options
   *
   * @return String Le chemin d'accès au fichier de configuration créé
   *
   * @throws KcatoesConfigurationFileException
   */
  public static function create($options)
  {
    if (empty($options) || !is_array($options))
    {
      throw new KcatoesConfigurationFileException(
        'Les options doivent être fournies sous forme de liste dont les entrées'.
        ' sont du type: nom de l\'option => valeur'
      );
    }

    if (!array_key_exists('Tests', $options) || empty($options['Tests']))
    {
      throw new KcatoesConfigurationFileException(
        'Le fichier de configuration doit contenir une catégorie \'Tests\' et'.
        ' celle-ci ne doit pas être vide.'
      );
    }

    $config = array();

    foreach ($options as $nom => $valeur)
    {
      $config[$nom] = $valeur;
    }

    $config['Version'] = sfConfig::get('app_version');
    $config['Date']    = date('Y.m.d');

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
   *  - contenir les options Tests et Version
   *  - avoir un paramètre de version compatible avec celle de KCatoès
   *
   * @param String $fileName Le chemin d'accès au fichier à charger
   * @param array  $options  Les options que doit contenir le fichier
   *                         (autres que Tests et Version)
   *
   * @return array La configuration sous forme de tableau
   *
   * @throws KcatoesConfigurationFileException Si le fichier n'est pas utilisable
   */
  public static function load($fileName, $options = array())
  {
    $requiredOptions = array_merge(array('Tests', 'Version'), $options);
    $allowedVersions = array(sfConfig::get('app_version'));
    $structureValide = true;

    $parser = new sfYamlParser();
    $input  = file_get_contents($fileName);

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
      if ($test instanceof Test)
      {
        $selectedTests[] = $test->getId();
      }
      else
      {
        $info = 'Chargement du fichier de configuration: '.$testName.' ignoré';
        sfContext::getInstance()->getLogger()->info($info);
      }
    }

    $config['Tests'] = $selectedTests;

    return $config;
  }
}