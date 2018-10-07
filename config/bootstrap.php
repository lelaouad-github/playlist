<?php

use App\Controller\PlaylistController;
use App\Controller\PlaylistVideoController;
use App\Controller\VideoController;
use App\Mapper\PlaylistMapper;
use App\Mapper\VideoMapper;
use Doctrine\DBAL\Driver\Connection;

require_once 'db.php';

$container = new League\Container\Container;
$container->add(Connection::class, function () use ($connectionParams) {
    $config = new \Doctrine\DBAL\Configuration();
    return \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
});

$container->add(PlaylistMapper::class)->addArgument(Connection::class);
$container->add(VideoMapper::class)->addArgument(Connection::class);

$container->add(PlaylistController::class)->addArgument(PlaylistMapper::class);
$container->add(VideoController::class)->addArgument(VideoMapper::class);
$container->add(PlaylistVideoController::class)->addArgument(VideoMapper::class);
