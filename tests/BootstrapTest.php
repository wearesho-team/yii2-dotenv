<?php declare(strict_types=1);

namespace Wearesho\Yii2\DotEnv\Tests;

use Dotenv\Exception\InvalidPathException;
use PHPUnit\Framework\TestCase;
use Wearesho\Yii2\DotEnv;
use yii\base;

class BootstrapTest extends TestCase
{
    public function provider(): array
    {
        return [
            [null, null, [],],
            ['.env.prod', null, ['DOTENV' => 'prod',],],
            ['.env.missing', null, InvalidPathException::class,],
            ['.env.prod', '.env.missing', ['DOTENV' => 'prod',],],
            ['.env.prod', '.env', ['DOTENV' => 'override',],],
            [null, '.env', ['DOTENV' => 'override',],],
            [null, '.env.missing', [],],
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testBootstrap(?string $file, ?string $overrideFile, $expected): void
    {
        $app = $this->mockApplication();
        $bootstrap = new DotEnv\Bootstrap(compact('file', 'overrideFile'));

        if (is_string($expected) && class_exists($expected)) {
            $this->expectException($expected);
        }
        $environment = $bootstrap->bootstrap($app);
        $this->assertEquals($expected, $environment);
    }

    protected function mockApplication(): base\Application
    {
        $mock = $this->createMock(base\Application::class);
        $mock->method('getBasePath')->willReturn(__DIR__ . DIRECTORY_SEPARATOR . 'data');
        return $mock;
    }
}
