# :twisted_rightwards_arrows: UXDM Excel

[![Build Status](https://travis-ci.com/DivineOmega/uxdm-excel.svg?branch=master)](https://travis-ci.com/DivineOmega/uxdm-excel)

This package provides Microsoft Excel source and destination objects for the [UXDM data migrator](https://github.com/DivineOmega/uxdm).

## Installation

To install the UXDM Eloquent package, just run the following composer 
command.

```bash
composer require divineomega/uxdm-excel
```

# UXDM Excel Source

The UXDM Excel source allows you to source data from a Microsoft Excel spreadsheet. This can be useful to directly import data from a spreadsheet into a bespoke web application database or other file format.

### Creating

To create a new Excel source, you must provide it with the path to the spreadsheet file (`*.xlsx`) that you wish to use.

The following example creates a Excel source object, using a `User.xlsx` file within the same directory.

```php
$excelSource = new ExcelSource(__DIR__.'/User.xlsx');
```

### Assigning to migrator

To use the Excel source as part of a UXDM migration, you must assign it to the migrator. This process is the same for most sources.

```php
$migrator = new Migrator;
$migrator->setSource($excelSource);
```

## UXDM Excel Destination

The UXDM Excel destination allows you to migrate data into a Microsoft Excel spreadsheet. This can be useful if you wish to export data from your database powered system into a spreadsheet, or simply convert from one format to another.

### Creating

To create a new Excel destination, you must provide it with the path to the spreadsheet file (`*.xlsx`) that you wish to use.

The following example creates a Excel destination object, using a `User.xlsx` file within the same directory.

```php
$excelDestination = new ExcelDestination(__DIR__.'/User.xlsx');
```

### Assigning to migrator

To use the Excel destination as part of a UXDM migration, you must assign it to the migrator. This process is the same for most destinations.

```php
$migrator = new Migrator;
$migrator->setDestination($excelDestination);
```

Alternatively, you can add multiple destinations, as shown below. You can also specify the fields you wish to send to each destination by passing an array of field names as the second parameter.

```php
$migrator = new Migrator;
$migrator->addDestination($excelDestination, ['field1', 'field2']);
$migrator->addDestination($otherDestination, ['field3', 'field2']);
```
