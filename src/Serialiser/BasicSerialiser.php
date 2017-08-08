<?php

namespace CyberduckWithSheets\LaravelExcel\Serialiser;

use Illuminate\Database\Eloquent\Model;
use CyberduckWithSheets\LaravelExcel\Contract\SerialiserInterface;

class BasicSerialiser implements SerialiserInterface {

    public function getData($data) {
        if ($data instanceof Model) {
            return $data->toArray();
        } elseif (is_array($data)) {
            return $data;
        } else {
            return get_object_vars($data);
        }
    }

    public function getHeaderRow() {
        return [];
    }

}
