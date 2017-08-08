<?php
namespace CyberduckWithSheets\LaravelExcel;

use CyberduckWithSheets\LaravelExcel\Factory\ExporterFactory;
use CyberduckWithSheets\LaravelExcel\Factory\ImporterFactory;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class ExcelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Exporter', \CyberduckWithSheets\LaravelExcel\ExporterFacade::class);
        $loader->alias('Importer', \CyberduckWithSheets\LaravelExcel\ImporterFacade::class);
    }

    public function register()
    {
        $this->app->singleton('cyber-duck/exporter', function () {
            return new ExporterFactory();
        });
        $this->app->singleton('cyber-duck/importer', function () {
            return new ImporterFactory();
        });
    }
}
