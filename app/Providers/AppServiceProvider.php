<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

        Request::macro('currentUser', function (): ?\App\Models\User {
            return $this->user();
        });

        Str::macro('withoutNumbers', function (string $str) {
            return preg_replace('/[0-9]+/', '', $str);
        });

        Str::macro('onlyNumbers', function (string $str) {
            return preg_replace('/[^0-9]/', '', $str);
        });

        Collection::macro('toSelect', function (string $label = 'name', string $value = 'id') {
            return $this->map(function ($item) use ($label, $value) {
                return [
                    'label' => Str::ucfirst($item->$label),
                    'value' => $item->$value,
                ];
            });
        });
    }
}
