<?php

class ExporterFacadeTest extends TestCase
{
    public function test_facades_are_available()
    {
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Factory\ExporterFactory::class,
            Exporter::getFacadeRoot()
        );
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Factory\ImporterFactory::class,
            Importer::getFacadeRoot()
        );
    }
}
