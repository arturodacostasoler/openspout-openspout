<?php

namespace OpenSpout\Reader\Common\Creator;

use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\TestUsingResource;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ReaderFactoryTest extends TestCase
{
    use TestUsingResource;

    public function testCreateFromFileCSV(): void
    {
        $validCsv = $this->getResourcePath('csv_test_create_from_file.csv');
        $reader = ReaderFactory::createFromFile($validCsv);
        static::assertInstanceOf('OpenSpout\Reader\CSV\Reader', $reader);
    }

    public function testCreateFromFileCSVAllCaps(): void
    {
        $validCsv = $this->getResourcePath('csv_test_create_from_file.CSV');
        $reader = ReaderFactory::createFromFile($validCsv);
        static::assertInstanceOf('OpenSpout\Reader\CSV\Reader', $reader);
    }

    public function testCreateFromFileODS(): void
    {
        $validOds = $this->getResourcePath('csv_test_create_from_file.ods');
        $reader = ReaderFactory::createFromFile($validOds);
        static::assertInstanceOf('OpenSpout\Reader\ODS\Reader', $reader);
    }

    public function testCreateFromFileXLSX(): void
    {
        $validXlsx = $this->getResourcePath('csv_test_create_from_file.xlsx');
        $reader = ReaderFactory::createFromFile($validXlsx);
        static::assertInstanceOf('OpenSpout\Reader\XLSX\Reader', $reader);
    }

    public function testCreateReaderShouldThrowWithUnsupportedType(): void
    {
        $this->expectException(UnsupportedTypeException::class);

        ReaderFactory::createFromType('unsupportedType');
    }

    public function testCreateFromFileUnsupported(): void
    {
        $this->expectException(UnsupportedTypeException::class);
        $invalid = $this->getResourcePath('test_unsupported_file_type.other');
        ReaderFactory::createFromFile($invalid);
    }

    public function testCreateFromFileMissingShouldWork(): void
    {
        $notExistingFile = 'thereisnosuchfile.csv';
        $reader = ReaderEntityFactory::createReaderFromFile($notExistingFile);
        static::assertInstanceOf('OpenSpout\Reader\CSV\Reader', $reader);
    }
}