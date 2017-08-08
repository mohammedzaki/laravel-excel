<?php
namespace CyberduckWithSheets\LaravelExcel;

use CyberduckWithSheets\LaravelExcel\Factory\ExporterFactory;
use CyberduckWithSheets\LaravelExcel\Factory\ImporterFactory;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class ExcelLegacyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Exporter', '\CyberduckWithSheets\LaravelExcel\ExporterFacade');
        $loader->alias('Importer', '\CyberduckWithSheets\LaravelExcel\ImporterFacade');
    }

    public function register()
    {
        $this->app->bind('mohammed-zaki/exporter', function () {
            return new ExporterFactory();
        });
        $this->app->bind('mohammed-zaki/importer', function () {
            return new ImporterFactory();
        });
    }
}
