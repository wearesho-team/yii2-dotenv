<?php declare(strict_types=1);

namespace Wearesho\Yii2\DotEnv\Tests;

use PHPUnit\Framework\TestCase;
use Wearesho\Yii2\DotEnv;
use yii\base;

class BootstrapTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            [[], ['DOTENV' => 'dev',],],
            [['names' => ['.env.test',],], ['DOTENV' => 'test',],],
            [['names' => ['.env.custom'],], ['DOTENV' => 'override',],],
            [['names' => ['.env.2']], []]
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testBootstrap(array $config, array $expected): void
    {
        $app = $this->mockApplication();
        $bootstrap = new DotEnv\Bootstrap($config);

        $environment = $bootstrap->bootstrap($app);
        $this->assertEquals($expected, $environment);
    }

    protected function mockApplication(): base\Application
    {
        $mock = $this->createMock(base\Application::class, ['getBasePath']);
        $mock->method('getBasePath')->willReturn(__DIR__ . DIRECTORY_SEPARATOR . 'data');
        return $mock;
    }
}
