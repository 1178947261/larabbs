<?php

namespace App\Providers;

use Overtrue\EasySms\EasySms;
use Illuminate\Support\ServiceProvider;

class EasySmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *EasySms 扩展类
     * easysms config 配置选项
     *  $this->app->alias(EasySms::class, 'easysms');  别名
     * @return void
     */
    public function register()
    {

        $this->app->singleton(EasySms::class, function ($app) {

            return new EasySms(config('easysms'));
        });

        $this->app->alias(EasySms::class, 'easysms');
    }
}