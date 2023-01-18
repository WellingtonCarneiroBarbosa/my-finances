<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::shouldBeStrict();

        Request::macro('isApi', function (): bool {
            return $this->is('api/*') && $this->expectsJson();
        });

        Str::macro('withoutNumbers', function (string $str) {
            return preg_replace('/[0-9]+/', '', $str);
        });

        Str::macro('onlyNumbers', function (string $str) {
            return preg_replace('/[^0-9]/', '', $str);
        });
    }
}
