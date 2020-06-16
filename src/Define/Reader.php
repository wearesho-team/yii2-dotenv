<?php declare(strict_types=1);

namespace Wearesho\Yii2\DotEnv\Define;

use Dotenv\Repository;
use PhpOption\None;
use PhpOption\Some;

final class Reader implements Repository\Adapter\ReaderInterface
{
    public function read(string $name)
    {
        if (!\defined($name)) {
            return None::create();
        }
        return Some::fromValue(\constant($name));
    }
}
