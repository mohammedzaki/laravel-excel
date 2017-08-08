<?php

class ExcelServiceProviderTest extends TestCase
{
    public function test_service_provider()
    {
        //Test services
        $this->assertTrue($this->app->bound('mohammedzaki/exporter'));
        $this->assertTrue($this->app->bound('mohammedzaki/importer'));
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Factory\ExporterFactory::class,
            $this->app->make('mohammedzaki/exporter')
        );
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Factory\ImporterFactory::class,
            $this->app->make('mohammedzaki/importer')
        );
        //Test aliases
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Exporter\AbstractSpreadsheet::class,
            Exporter::make("Excel")
        );
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Importer\AbstractSpreadsheet::class,
            Importer::make("Excel")
        );
    }
}
