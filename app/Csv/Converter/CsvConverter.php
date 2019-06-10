<?php


namespace App\Csv\Converter;


use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\ResultSet;
use League\Csv\Statement;

class CsvConverter
{

    /**
     * @param $content
     * @return array|Reader
     * @throws CreateCsvReaderException
     */
    private function createReader($content)
    {
        if (is_string($content)) {
            return $this->createReaderFromString($content);
        }
        throw new CreateCsvReaderException("No Reader created from Source.");
    }

    private function createReaderFromString(string $content) {
        return Reader::createFromString($content);
    }

    /**
     * @param $content
     * @return array
     * @throws CreateCsvReaderException
     * @throws Exception
     */
    public function fromStringToArray($content):array {
        $csvReader = $this->createReader($content);
        $csvReader->setHeaderOffset(0);
        $csvReader->setDelimiter(';');

        $records = (new Statement())->process($csvReader);
        return $this->getCsvArray($records);
    }

    /**
     * @param ResultSet $records
     * @return array
     */
    public function getCsvArray(ResultSet $records): array
    {
        $csvArray = [];
        foreach ($records as $record) {
            $csvArray[] = $record;
        }
        return $csvArray;
    }


}