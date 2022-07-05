<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('activeroute', function ($expression) {
                return '<?php if('.$expression.' == Route::currentRouteName()) echo "active"; else echo "text-white"?>';
        });

        Blade::directive('json', function ($expression) {
                return '<?php echo json_encode('.$expression.') ?>';
        });
    }
}
