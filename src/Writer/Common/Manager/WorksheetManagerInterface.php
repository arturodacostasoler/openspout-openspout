<?php

namespace OpenSpout\Writer\Common\Manager;

use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\Common\Entity\Worksheet;

/**
 * Interface WorksheetManagerInterface
 * Inteface for worksheet managers, providing the generic interfaces to work with worksheets.
 */
interface WorksheetManagerInterface
{
    public function setDefaultColumnWidth(?float $width): void;

    public function setDefaultRowHeight(?float $height): void;

    /**
     * @param int ...$columns One or more columns with this width
     */
    public function setColumnWidth(float $width, int ...$columns): void;

    /**
     * @param float $width The width to set
     * @param int   $start First column index of the range
     * @param int   $end   Last column index of the range
     */
    public function setColumnWidthForRange(float $width, int $start, int $end): void;

    /**
     * Adds a row to the worksheet.
     *
     * @param Worksheet $worksheet The worksheet to add the row to
     * @param Row       $row       The row to be added
     *
     * @throws \OpenSpout\Common\Exception\IOException              If the data cannot be written
     * @throws \OpenSpout\Common\Exception\InvalidArgumentException If a cell value's type is not supported
     */
    public function addRow(Worksheet $worksheet, Row $row): void;

    /**
     * Prepares the worksheet to accept data.
     *
     * @param Worksheet $worksheet The worksheet to start
     *
     * @throws \OpenSpout\Common\Exception\IOException If the sheet data file cannot be opened for writing
     */
    public function startSheet(Worksheet $worksheet): void;

    /**
     * Closes the worksheet.
     */
    public function close(Worksheet $worksheet): void;
}
