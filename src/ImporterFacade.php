<?php
namespace CyberduckWithSheets\LaravelExcel;

use Illuminate\Support\Facades\Facade;

class ImporterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mohammedzaki/importer';
    }
}
