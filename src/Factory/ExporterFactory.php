<?php
namespace CyberduckWithSheets\LaravelExcel\Factory;

use ReflectionClass;

class ExporterFactory
{
    public function make($type)
    {
        $class = new ReflectionClass('CyberduckWithSheets\\LaravelExcel\\Exporter\\'.$type);
        return $class->newInstanceArgs(array());
    }
}
