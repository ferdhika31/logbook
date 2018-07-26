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
                ->add(trans('Master'))
                ->data('icon', 'fa-database')
                ->data('id', 'larakuy-master');    
            $menuMulti->add(trans('Periode'), url('backend/periode'))->data('icon', 'fa-circle');
            $menuMulti->add(trans('Project'), url('backend/project'))->data('icon', 'fa-circle');

            $menuLogbook = $this->app['larakuy.backend.menu']
                ->add(trans('Logbook'), url('backend/logbook'))
                ->data('icon', 'fa-book')
                ->data('id', 'larakuy-logbook');  
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
