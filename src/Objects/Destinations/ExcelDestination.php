<?php

namespace DivineOmega\uxdm\Objects\Destinations;

use DivineOmega\uxdm\Interfaces\DestinationInterface;
use DivineOmega\uxdm\Objects\DataRow;

class ExcelDestination implements DestinationInterface
{
    private $excelFilePath;

    public function __construct(string $excelFilePath)
    {
        $this->excelFilePath = $excelFilePath;
    }

    public function putDataRows(array $dataRows): void
    {
        // TODO: Implement putDataRows() method.
    }

    public function finishMigration(): void
    {
        // TODO: Implement finishMigration() method.
    }
}
