<?php declare(strict_types=1);

namespace Wearesho\Yii2\DotEnv\Tests\Define;

use PHPUnit\Framework\TestCase;
use Wearesho\Yii2\DotEnv\Define;

class ReaderTest extends TestCase
{
    public function readDataProvider(): array
    {
        return [
            ['PHP_VERSION', PHP_VERSION],
            ['__MY_LAST_LOVE'],
        ];
    }

    /**
     * @dataProvider readDataProvider
     */
    public function testRead(string $name, string $value = null): void
    {
        $reader = new Define\Reader();
        $option = $reader->read($name);
        if (is_null($value)) {
            $this->assertFalse($option->isDefined());
            return;
        }
        $this->assertEquals($option->get(), $value);
    }
}
