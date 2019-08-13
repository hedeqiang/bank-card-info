<?php

namespace Hedeqiang\BankCardInfo;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(BankCard::class, function () {
            return new BankCard();
        });

        $this->app->alias(BankCard::class, 'BankCard');
    }

    public function provides()
    {
        return [BankCard::class, 'BankCard'];
    }
}
