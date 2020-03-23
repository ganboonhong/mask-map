<?php

require __DIR__ . '/../vendor/autoload.php';

$_ENV = getenv();
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV']);
defined('YII_DEBUG') or define('YII_DEBUG', $_ENV['YII_ENV'] === 'dev');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
