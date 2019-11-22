<?php declare(strict_types=1);

namespace Wearesho\Yii2\DotEnv;

use Dotenv\Exception\InvalidPathException;
use Dotenv\Dotenv;
use yii\base;

defined('YII_ENV') or define('YII_ENV', 'prod');

class Bootstrap extends base\BaseObject implements base\BootstrapInterface
{
    /** @var string environment DotEnv file name */
    public $file = '.env.' . YII_ENV;

    /** @var string optional environment override DotEnv file name */
    public $overrideFile = '.env';

    public function bootstrap($app): array
    {
        $paths = $this->getPaths($app);
        if (!is_null($this->file)) {
            $dotEnv = Dotenv::create($paths, $this->file);
            $environment = $dotEnv->load();
        } else {
            $environment = [];
        }

        if (!is_null($this->overrideFile)) {
            $dotEnv = Dotenv::create($paths, $this->overrideFile);
            try {
                $environment = array_merge($environment, $dotEnv->overload());
            } catch (InvalidPathException $exception) {
                // supress missing optional override file not found exception
            }
        }

        return $environment;
    }

    protected function getPaths(base\Application $app): array
    {
        $basePath = $app->getBasePath();
        return [
            $basePath, // support yii2-app-basic
            dirname($basePath), // support yii2-app-advanced,
        ];
    }
}
