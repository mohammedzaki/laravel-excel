<?php
namespace CyberduckWithSheets\LaravelExcel\Contract;

interface ParserInterface
{
    public function transform($array, $header);
}
