<?php

namespace DivineOmega\uxdm\Objects\Destinations;

use DivineOmega\uxdm\Interfaces\DestinationInterface;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExcelDestination implements DestinationInterface
{
    private $excelFilePath;
    private $simpleExcelWriter;

    public function __construct(string $excelFilePath)
    {
        $this->excelFilePath = $excelFilePath;

        $this->simpleExcelWriter = SimpleExcelWriter::create($excelFilePath);
    }

    public function putDataRows(array $dataRows): void
    {
        foreach ($dataRows as $dataRow) {
            $this->simpleExcelWriter->addRow($dataRow->toArray());
        }
    }

    public function finishMigration(): void
    {
        $this->simpleExcelWriter->close();
    }
}
