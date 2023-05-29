<?php
declare(strict_types=1);
require_once __DIR__."/vendor/autoload.php";
use app\src\Moves;

$game = new Moves();

$game->start();