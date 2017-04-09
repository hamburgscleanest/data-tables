<?php

namespace hamburgscleanest\DataTables;

use hamburgscleanest\DataTables\Facades\DataTable as DataTableFacade;
use hamburgscleanest\DataTables\Models\DataTable;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

/**
 * Class DataTablesServiceProvider
 * @package hamburgscleanest\DataTables
 */
class DataTablesServiceProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('datatable', function ($app)
        {
            return new DataTable($app->request);
        });

        $this->app->booting(function ()
        {
            $loader = AliasLoader::getInstance();
            $loader->alias('DataTable', DataTableFacade::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['datatable'];
    }
}