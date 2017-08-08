<?php
namespace CyberduckWithSheets\LaravelExcel\Parser;

use RuntimeException;
use CyberduckWithSheets\LaravelExcel\Contract\ParserInterface;

class BasicParser implements ParserInterface
{
    public function transform($row, $header)
    {
        if ($header) {
            $row = array_combine($header, $row);

            if ($row == false) {
                throw new RuntimeException('Unvalid header');
            }
        }

        return $row;
    }
}
