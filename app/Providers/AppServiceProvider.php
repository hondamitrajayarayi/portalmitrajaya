<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        Blade::directive('uang', function ($amount) {
            if (!$amount) {
                return '';
            } else {
                return "<?php echo 'Rp. ' . number_format($amount, 2); ?>";
            }
        });

        Blade::directive('tanggal', function ($expression) {
            if (!$expression) {
                return '';
            } else {
                return "<?php echo ($expression)->format('d/m/Y H:i'); ?>";
            }
            
        });

        Blade::directive('only_tanggal', function ($expression) {
            if (!$expression) {
                return '';
            } else {
                return "<?php echo ($expression)->format('d F Y'); ?>";
            }
            
        });
    }
}
