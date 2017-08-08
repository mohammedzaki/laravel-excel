<?php

use CyberduckWithSheets\LaravelExcel\Contract\SerialiserInterface;
use Illuminate\Database\Eloquent\Model;

class FirstColumnOnlySerialiser implements SerialiserInterface {

    public function getData($data) {
        $arrayValues = $data->toArray();
        return [$arrayValues['field1']];
    }

    public function getHeaderRow() {
        return ['HEADER'];
    }

}
