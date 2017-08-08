<?php

use CyberduckWithSheets\LaravelExcel\Factory\ImporterFactory;
use CyberduckWithSheets\LaravelExcel\Factory\ExporterFactory;

class ImporterFactoryTest extends TestCase
{
    public function test_factory_can_create_csv()
    {
        $factory = new ImporterFactory();
        $spreadsheet = $factory->make('csv');
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Importer\Csv::class,
            $spreadsheet
        );
        $this->assertEquals(
            \Box\Spout\Common\Type::CSV,
            $spreadsheet->getType()
        );
    }

    public function test_factory_can_create_odt()
    {
        $factory = new ImporterFactory();
        $spreadsheet = $factory->make('openoffice');
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Importer\OpenOffice::class,
            $factory->make('openoffice')
        );
        $this->assertEquals(
            \Box\Spout\Common\Type::ODS,
            $spreadsheet->getType()
        );
    }

    public function test_factory_can_create_xls()
    {
        $factory = new ImporterFactory();
        $spreadsheet = $factory->make('excel');
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Importer\Excel::class,
            $factory->make('excel')
        );
        $this->assertEquals(
            \Box\Spout\Common\Type::XLSX,
            $spreadsheet->getType()
        );
    }
    public function test_exporter_factory_can_create_csv()
    {
        $factory = new ExporterFactory();
        $spreadsheet = $factory->make('csv');
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Exporter\Csv::class,
            $spreadsheet
        );
        $this->assertEquals(
            \Box\Spout\Common\Type::CSV,
            $spreadsheet->getType()
        );
    }

    public function test_exporter_factory_can_create_odt()
    {
        $factory = new ExporterFactory();
        $spreadsheet = $factory->make('openoffice');
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Exporter\OpenOffice::class,
            $spreadsheet
        );
        $this->assertEquals(
            \Box\Spout\Common\Type::ODS,
            $spreadsheet->getType()
        );
    }

    public function test_exporter_factory_can_create_xls()
    {
        $factory = new ExporterFactory();
        $spreadsheet = $factory->make('excel');
        $this->assertInstanceOf(
            \CyberduckWithSheets\LaravelExcel\Exporter\Excel::class,
            $spreadsheet
        );
        $this->assertEquals(
            \Box\Spout\Common\Type::XLSX,
            $spreadsheet->getType()
        );
    }
}
