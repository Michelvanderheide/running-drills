<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('garantieapp', 'pgsql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'pgsql:host=localhost;dbname=garantieapp_prod',
  'user' => 'garantieapp',
  'password' => 'Cho1jeex',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('garantieapp');
$serviceContainer->setConnectionManager('garantieapp', $manager);
$serviceContainer->setDefaultDatasource('garantieapp');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => '/var/www/html/garantie-app/logs/propel.log',
  'level' => 300,
));
$serviceContainer->setLoggerConfiguration('garantieapp', array (
  'type' => 'stream',
  'path' => '/var/www/html/garantie-app/logs/propel.log',
));