<?php

namespace DivineOmega\uxdm\Objects\Sources;

use DivineOmega\uxdm\Interfaces\SourceInterface;
use DivineOmega\uxdm\Objects\DataItem;
use DivineOmega\uxdm\Objects\DataRow;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelSource implements SourceInterface
{
    private $excelFilePath;
    private $collection;
    private $perPage = 100;

    public function __construct(string $excelFilePath)
    {
        $this->excelFilePath = $excelFilePath;

        $this->collection = (new SimpleExcelReader($excelFilePath))->getRows();
    }

    public function getDataRows(int $page = 1, array $fieldsToRetrieve = []): array
    {
        $startIndex = ($page - 1) * $this->perPage;
        $endIndex = $startIndex + $this->perPage;

        $rows = $this->collection->filter(function ($row, $index) use ($startIndex, $endIndex) {
            return ($index >= $startIndex && $index < $endIndex);
        });

        $dataRows = $rows->map(function ($row) use ($fieldsToRetrieve) {
           $dataRow = new DataRow();
           foreach ($row as $key => $value) {
               if (in_array($key, $fieldsToRetrieve)) {
                   $dataRow->addDataItem(new DataItem($key, $value));
               }
           }
           return $dataRow;
        })->toArray();

        return $dataRows;
    }

    public function countDataRows(): int
    {
        return $this->collection->count();
    }

    public function countPages(): int
    {
        return ceil($this->countDataRows() / $this->perPage);
    }

    public function getFields(): array
    {
        return array_keys($this->collection->first());
    }
}
