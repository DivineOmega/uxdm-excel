<?php

use DivineOmega\uxdm\Objects\DataItem;
use DivineOmega\uxdm\Objects\DataRow;
use DivineOmega\uxdm\Objects\Destinations\ExcelDestination;
use PHPUnit\Framework\TestCase;
use Spatie\SimpleExcel\SimpleExcelReader;

final class ExcelDestinationTest extends TestCase
{
    private function getDestination()
    {
        return new ExcelDestination(__DIR__.'/data/Destination.xlsx');
    }

    private function createDataRows()
    {
        $faker = Faker\Factory::create();

        $dataRows = [];

        $dataRow = new DataRow();
        $dataRow->addDataItem(new DataItem('id', 1, true));
        $dataRow->addDataItem(new DataItem('name', $faker->name));
        $dataRow->addDataItem(new DataItem('email', $faker->email));
        $dataRows[] = $dataRow;

        $dataRow = new DataRow();
        $dataRow->addDataItem(new DataItem('id', 2, true));
        $dataRow->addDataItem(new DataItem('name', $faker->name));
        $dataRow->addDataItem(new DataItem('email', $faker->email));
        $dataRows[] = $dataRow;

        return $dataRows;
    }

    private function alterDataRows(array $dataRows)
    {
        $faker = Faker\Factory::create();

        foreach ($dataRows as $dataRow) {
            $dataItem = $dataRow->getDataItemByFieldName('email');
            $dataItem->value = $faker->email;
        }

        return $dataRows;
    }

    private function getActualArray()
    {
        return SimpleExcelReader::create(__DIR__.'/data/Destination.xlsx')->getRows()->toArray();
    }

    private function getExpectedArray(array $dataRows)
    {
        $expectedArray = [];

        foreach ($dataRows as $dataRow) {
            $expectedArrayRow = [];
            foreach ($dataRow->getDataItems() as $dataItem) {
                $expectedArrayRow[$dataItem->fieldName] = $dataItem->value;
            }
            $expectedArray[] = $expectedArrayRow;
        }

        return $expectedArray;
    }

    public function testPutDataRows()
    {
        $dataRows = $this->createDataRows();

        $destination = $this->getDestination();
        $destination->putDataRows($dataRows);
        $destination->finishMigration();

        $this->assertEquals($this->getExpectedArray($dataRows), $this->getActualArray());

        $destination = $this->getDestination();
        $dataRows = $this->alterDataRows($dataRows);
        $destination->putDataRows($dataRows);
        $destination->finishMigration();

        $this->assertEquals($this->getExpectedArray($dataRows), $this->getActualArray());

        $destination->finishMigration();
    }
}
