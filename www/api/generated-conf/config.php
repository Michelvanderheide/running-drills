<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('runningdrills', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=localhost;dbname=runningdrills',
  'user' => 'runningdrills',
  'password' => 'Cho1jeex',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('runningdrills');
$serviceContainer->setConnectionManager('runningdrills', $manager);
$serviceContainer->setDefaultDatasource('runningdrills');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => '/var/www/html/runningdrills/logs/propel.log',
  'level' => 300,
));
$serviceContainer->setLoggerConfiguration('runningdrills', array (
  'type' => 'stream',
  'path' => '/var/www/html/runningdrills/logs/propel.log',
));