<?php


$developers = [
    '127.0.0.1',
    '83.240.124.229',	// kancl Ulička
];

$tempDir = __DIR__ . '/../temp';

// afterDeploy

$remoteAddr = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : NULL;
if(in_array($remoteAddr, $developers) && isset($_GET["afterDeploy"])) {
    $deployment = __DIR__ . "/../vendor/adt/deployment/src/Deployment.php";

    if(file_exists($deployment)) {
        include $deployment;
        ADT\Deployment\Deployment::install($tempDir);
    }
}

require __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../app/shortcuts.php';

$configurator = new Nette\Configurator;

$configurator->setDebugMode($developers);

$configurator->enableDebugger(__DIR__ . '/../log');

$configurator->setTempDirectory($tempDir);

$configurator->createRobotLoader()
    ->addDirectory(__DIR__)
    ->addDirectory(__DIR__ . '/../vendor/others')
    ->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$container = $configurator->createContainer();

Kdyby\Replicator\Container::register();
Vodacek\Forms\Controls\DateInput::register();

return $container;
