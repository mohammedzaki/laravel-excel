<?php
namespace CyberduckWithSheets\LaravelExcel\Importer;

use Box\Spout\Common\Type;

class Csv extends AbstractSpreadsheet
{
    public function getType()
    {
        return Type::CSV;
    }
}
