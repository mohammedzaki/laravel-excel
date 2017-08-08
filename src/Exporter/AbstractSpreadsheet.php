<?php
namespace CyberduckWithSheets\LaravelExcel\Exporter;

use Illuminate\Support\Collection;
use Box\Spout\Writer\WriterFactory;
use Illuminate\Database\Query\Builder;
use CyberduckWithSheets\LaravelExcel\Serialiser\BasicSerialiser;
use CyberduckWithSheets\LaravelExcel\Contract\SerialiserInterface;
use CyberduckWithSheets\LaravelExcel\Contract\ExporterInterface;

abstract class AbstractSpreadsheet implements ExporterInterface {

    protected $data;
    protected $index;
    protected $type;
    protected $serialiser;
    protected $chuncksize;

    public function __construct() {
        $this->index = 0;
        $this->data[$this->index] = [];
        $this->type = $this->getType();
        $this->serialiser = new BasicSerialiser();
    }

    public function load(Collection $data, $sheetName = "sheet1") {
        $this->data[$this->index]['sheetName'] = $sheetName;
        $this->data[$this->index]['data'] = $data;
        return $this;
    }

    public function loadToNewSheet(Collection $data, $sheetName) {
        $this->load($data, $sheetName);
        $this->index++;
        return $this;
    }

    public function loadQuery(Builder $query, $sheetName = "sheet1") {
        $this->data[$this->index]['sheetName'] = $sheetName;
        $this->data[$this->index]['data'] = $query;
        return $this;
    }

    public function loadQueryToNewSheet(Builder $query, $sheetName) {
        $this->loadQuery($query, $sheetName);
        $this->index++;
        return $this;
    }

    public function setChunk($size) {
        $this->chunksize = $size;
        return $this;
    }

    public function setSerialiser(SerialiserInterface $serialiser) {
        $this->serialiser = $serialiser;
        return $this;
    }

    abstract public function getType();

    public function save($filename) {
        $writer = $this->create();
        $writer->openToFile($filename);
        if ($this->index > 0) {
            foreach ($this->data as $index => $dataSheet) {
                if ($index == 0) {
                    $writer = $this->makeRows($writer, $dataSheet['data']);
                    $writer->getCurrentSheet()->setName($dataSheet['sheetName']);
                } else {
                    $newSheet = $writer->addNewSheetAndMakeItCurrent()->setName($dataSheet['sheetName']);
                    $writer = $this->makeRows($writer, $dataSheet['data']);
                }
            }
        } else {
            $writer = $this->makeRows($writer, $this->data[0]['data']);
        }
        $writer->close();
    }

    public function stream($filename) {
        $writer = $this->create();
        $writer->openToBrowser($filename);
        $writer = $this->makeRows($writer, $this->data[0]['data']);
        $writer->close();
    }

    protected function create() {
        return WriterFactory::create($this->type);
    }

    protected function makeRows($writer, $data) {
        $headerRow = $this->serialiser->getHeaderRow();
        if (!empty($headerRow)) {
            $writer->addRow($headerRow);
        }
        if ($data instanceof Builder) {
            if (isset($this->chuncksize)) {
                $data->chunk($this->chuncksize);
            } else {
                $dataRows = $data->get();
                foreach ($dataRows as $record) {
                    $writer->addRow($this->serialiser->getData($record));
                }
            }
        } else {
            foreach ($data as $record) {
                $writer->addRow($this->serialiser->getData($record));
            }
        }
        return $writer;
    }

}
