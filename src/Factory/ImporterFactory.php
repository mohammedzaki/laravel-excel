<?php
namespace CyberduckWithSheets\LaravelExcel\Factory;

use ReflectionClass;

class ImporterFactory
{
    public function make($type)
    {
        $class = new ReflectionClass('CyberduckWithSheets\\LaravelExcel\\Importer\\'.$type);
        return $class->newInstanceArgs(array());
    }
}
