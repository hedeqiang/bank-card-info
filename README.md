<h1 align="center"> bank-card-info </h1>

<p align="center"> 银行卡信息获取、验证</p>

![StyleCI build status](https://github.styleci.io/repos/202061186/shield) 

## Installing

```shell
$ composer require hedeqiang/bank-card-info -vvv
```

## Usage

```shell
<?php

require __DIR__ .'/vendor/autoload.php';

use Hedeqiang\BankCardInfo\BankCard;

$card = new BankCard();
$response = $card->getInfo('6212260200142520000');
var_dump($response);
```

返回示例
```shell
{
    "validated": true,
    "bank": "ICBC",
    "bankName": "中国工商银行",
    "bankImg": "https://apimg.alipay.com/combo.png?d=cashier&t=ICBC",
    "cardType": "DC",
    "cardTypeName": "储蓄卡"
}
```

## 在 Laravel 中使用

可以用两种方式来获取 `Hedeqiang\Weather\Weather` 实例：

### 方法参数注入
```shell
<?php

namespace App\Http\Controllers;

use Hedeqiang\BankCardInfo\BankCard;
use Illuminate\Http\Request;

class BankCardController extends Controller
{
    public function index(Request $request,BankCard $bankCard)
    {
        return $bankCard->getInfo('62122602001000000');
    }
}
```

### 服务名访问
```shell
<?php

namespace App\Http\Controllers;

use Hedeqiang\BankCardInfo\BankCard;
use Illuminate\Http\Request;

class BankCardController extends Controller
{
    public function index(Request $request,BankCard $bankCard)
    {
        return app('BankCard')->getInfo('62122602001000000');
    }
}
```

TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/hedeqiang/bank-card-info/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/hedeqiang/bank-card-info/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## 参考

* [zhuzhichao/bank-card-info](https://github.com/zhuzhichao/bank-card-info)


## License

MIT