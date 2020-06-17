<?php declare(strict_types=1); // @codeCoverageIgnoreStart

use Dotenv\Dotenv;
use Dotenv\Repository\RepositoryBuilder;
use Dotenv\Repository\Adapter\PutenvAdapter;

$repo = RepositoryBuilder::createWithDefaultAdapters()
    ->addAdapter(PutenvAdapter::class)
    ->make();

$dotEnv = Dotenv::create($repo, [$_SERVER['PWD'] ?? getcwd()], ['.env', '.env.example',]);
$dotEnv->safeLoad();
$dotEnv->required('YII_ENV')->allowedValues(['dev', 'test', 'prod']);
$dotEnv->ifPresent('YII_DEBUG')->isBoolean();

$define = new Wearesho\Yii2\DotEnv\Define\Writer;
foreach (['YII_DEBUG', 'YII_ENV',] as $key) {
    $define->write($key, $repo->get($key));
}
