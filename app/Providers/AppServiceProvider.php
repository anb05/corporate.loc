<?php

namespace Corp\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \Blade::directive('set', function($exp) {
            list($name, $val) = explode(',', $exp);

            return "<?php $name = $val; ?>";
        });

//        \DB::listen(function ($query) {
//            echo "<h1>" . $query->sql . "</h1>";
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
