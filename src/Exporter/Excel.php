<?php
namespace CyberduckWithSheets\LaravelExcel\Exporter;

use Box\Spout\Common\Type;

class Excel extends AbstractSpreadsheet
{
    public function getType()
    {
        return Type::XLSX;
    }
}
