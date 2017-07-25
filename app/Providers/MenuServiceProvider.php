<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Lavary\Menu\Builder;
use App\Classes\Menu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if ($this->app->bound('larakuy.backend.menu')) {
            $menuDashboard = $this->app['larakuy.backend.menu']
                ->add(trans('Dashboard'), url('backend/dashboard'))
                ->data('icon', 'fa-dashboard')
                ->data('id', 'larakuy-dashboard');   

            $menuMulti = $this->app['larakuy.backend.menu']
                ->add(trans('Multilevel'))
                ->data('icon', 'fa-link')
                ->data('id', 'larakuy-multi');    
            $menuMulti->add(trans('About'), url('backend/about'))->data('icon', 'fa-circle');
            $menuMulti->add(trans('About2'), url('backend/about2'))->data('icon', 'fa-circle');
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('larakuy.backend.menu', function(Application $app){
            return (new Menu())->make('sidebar', function(Builder $menu){
                return $menu;
            });
        });
    }
}
