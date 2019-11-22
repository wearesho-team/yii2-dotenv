# Yii2 DotEnv
[![Build Status](https://travis-ci.org/wearesho-team/yii2-dotenv.svg?branch=master)](https://travis-ci.org/wearesho-team/yii2-dotenv)
[![codecov](https://codecov.io/gh/wearesho-team/yii2-dotenv/branch/master/graph/badge.svg)](https://codecov.io/gh/wearesho-team/yii2-dotenv)

Yii2 Support for loading environment variables from DotEnv files 
using [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv).

## Installation
```bash
composer require wearesho-team/yii2-dotenv:^1.0
```

## Usage
This package includes [Bootstrap](./src/Bootsrap.php).  
You need to prepend it to application bootstrap list:
```php
<?php

use Wearesho\Yii2\DotEnv;

return [
    'id' => 'app',
    'bootstrap' => [
        DotEnv\Bootstrap::class,
        // ... other bootstraps 
    ],
    'components' => [
        // ... components definitions
    ],
];
```

## License
[MIT](./LICENSE)
