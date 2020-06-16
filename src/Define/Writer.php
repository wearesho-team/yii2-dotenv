<?php declare(strict_types=1);

namespace Wearesho\Yii2\DotEnv\Define;

use Dotenv\Repository\Adapter;

final class Writer implements Adapter\WriterInterface
{
    public function write(string $name, string $value): bool
    {
        if (defined($name)) {
            return false;
        }
        return (bool)define($name, $value);
    }

    public function delete(string $name): bool
    {
        if (!defined($name)) {
            return true;
        }
        return false;
    }
}
