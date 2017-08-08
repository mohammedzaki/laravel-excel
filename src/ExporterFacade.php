<?php
namespace CyberduckWithSheets\LaravelExcel;

use Illuminate\Support\Facades\Facade;

class ExporterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mohammedzaki/exporter';
    }
}
