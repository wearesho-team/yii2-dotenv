<?php declare(strict_types=1);

namespace Wearesho\Yii2\DotEnv;

use Dotenv\Dotenv;
use yii\base;

class Bootstrap extends base\BaseObject implements base\BootstrapInterface
{
    public array $paths = [];

    public array $names = [];

    public function bootstrap($app): array
    {
        $paths = $this->paths ? $this->paths : [
            $app->getBasePath(),
            dirname($app->getBasePath()),
        ];
        $names = $this->names ? $this->names : [
            '.env',
            '.env.' . YII_ENV,
        ];
        $dotEnv = Dotenv::createUnsafeMutable($paths, $names);
        \Yii::$container->setSingleton(Dotenv::class, $dotEnv);
        return $dotEnv->safeLoad();
    }
}
