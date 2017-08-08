<?php
namespace CyberduckWithSheets\LaravelExcel\Importer;

use Box\Spout\Reader\ReaderFactory;
use Illuminate\Database\Eloquent\Model;
use CyberduckWithSheets\LaravelExcel\Parser\BasicParser;
use CyberduckWithSheets\LaravelExcel\Contract\ParserInterface;
use CyberduckWithSheets\LaravelExcel\Contract\ImporterInterface;

abstract class AbstractSpreadsheet implements ImporterInterface
{
    protected $path;
    protected $type;
    protected $parser;
    protected $sheet;
    protected $model;
    protected $hasHeaderRow;

    public function __construct()
    {
        $this->path = '';
        $this->sheet = 1;
        $this->hasHeaderRow = 0;
        $this->type = $this->getType();
        $this->parser = new BasicParser();
        $this->model = false;
    }

    public function load($path)
    {
        $this->path = $path;
    }

    public function setSheet($sheet)
    {
        $this->sheet = $sheet;
    }

    public function hasHeader($hasHeaderRow)
    {
        $this->hasHeaderRow = $hasHeaderRow;
    }

    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    abstract public function getType();

    public function getCollection()
    {
        $headers = false;

        $reader = $this->open();

        foreach ($reader->getSheetIterator() as $index => $sheet) {
            if ($index !== $this->sheet) {
                continue;
            }

            $collection = $this->model ? $this->model->newCollection() : collect([]);

            foreach ($sheet->getRowIterator() as $rowindex => $row) {
                if ($rowindex == 1 && $this->hasHeaderRow) {
                    $headers = $row;
                } else {
                    $data = $this->parser->transform($row, $headers);

                    if ($this->model) {
                        $data = $this->model->getQuery()->insert($data);
                    }

                    $collection->push($data);
                }
            }
        }

        $reader->close();

        return $collection;
    }

    public function save($updateIfEquals = [])
    {
        if (!$this->model) {
            return;
        }

        $headers = false;

        $reader = $this->open();

        $updateIfEquals = array_flip($updateIfEquals);

        foreach ($reader->getSheetIterator() as $index => $sheet) {
            if ($index !== $this->sheet) {
                continue;
            }

            foreach ($sheet->getRowIterator() as $rowindex => $row) {
                if ($rowindex == 1 && $this->hasHeaderRow) {
                    $headers = $row;
                } else {
                    $data = $this->parser->transform($row, $headers);
                    $when = array_intersect_key($data, $updateIfEquals);
                    $values = array_diff($data, $when);
                    if (!empty($when)) {
                        $this->model->getQuery()->updateOrInsert($when, $values);
                    } else {
                        $this->model->getQuery()->insert($values);
                    }
                }
            }
        }
    }

    protected function open()
    {
        $reader= ReaderFactory::create($this->type);
        $reader->open($this->path);
        return $reader;
    }
}
