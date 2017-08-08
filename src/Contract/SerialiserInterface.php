<?php

namespace CyberduckWithSheets\LaravelExcel\Contract;

use Illuminate\Database\Eloquent\Model;

interface SerialiserInterface {

    public function getData($data);

    public function getHeaderRow();
}
