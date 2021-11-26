<?php

namespace Fut7\Infrastructure\Persistence\Shared;

use Fut7\Infrastructure\Persistence\Shared\Csv\Exception\CsvItemNotFoundException;
use League\Csv\CannotInsertRecord;
use League\Csv\Statement;
use League\Csv\Writer;
use League\Csv\Reader;

class CsvRepository
{
    private string $persistenceFilename;

    public function __construct($persistenceFilename)
    {
        $this->persistenceFilename = $persistenceFilename;
    }

    /**
     * @param $data
     * @throws CannotInsertRecord
     */
    public function create($data)
    {
        $csv = Writer::createFromPath($this->persistenceFilename, 'a+');
        $csv->insertAll($data);
    }

    /**
     * @param $id
     * @return mixed
     * @throws CsvItemNotFoundException
     */
    public function find($id)
    {
        $reader = Reader::createFromPath($this->persistenceFilename, 'r');
        $records = $reader->getRecords();

        $recordFound = null;
        foreach ($records as $offset => $record) {
            if ($id === $record[0]) {
                $recordFound = $record;
            }
        }

        if (null === $recordFound) {
            throw new CsvItemNotFoundException($id);
        }

        return $recordFound;
    }

    public function search(array $criteria): array
    {
        $reader = Reader::createFromPath($this->persistenceFilename, 'r');
        $records = $reader->getRecords();

        $recordFound = [];
        foreach ($records as $offset => $record) {
            $searchId = strpos($record[0], $criteria['id']);
            if ($searchId !== false) {
                $recordFound[] = $record;
            }
        }

        return $recordFound;
    }

    /**
     * @param $id
     * @param $data
     * @throws CannotInsertRecord
     */
    public function update($id, $data)
    {
        $this->delete($id);
        $this->create($data);
    }

    /**
     * @param $id
     * @throws CannotInsertRecord
     */
    public function delete($id)
    {
        $reader = Reader::createFromPath($this->persistenceFilename, 'r');
        $records = $reader->getRecords();

        $newDataToInsert = [];
        foreach ($records as $offset => $record) {
            if ($id === $record[0]) {
                continue;
            }
            $newDataToInsert[] = $record;
        }

        $csv = Writer::createFromPath($this->persistenceFilename, 'w');
        $csv->insertAll($newDataToInsert);
    }

    /**
     * @param $header
     * @throws CannotInsertRecord
     */
    public function createHeaders($header): void
    {
        try {
            $writer = Writer::createFromPath($this->persistenceFilename, 'a+');
            $reader = Reader::createFromPath($this->persistenceFilename, 'r');
            $reader->setHeaderOffset(0);
            $records = Statement::create()->process($reader);
            $headers = $records->getHeader();
            if(empty($headers)) {
                $writer->insertOne($header);
                echo ' #> Header added'.PHP_EOL;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            $writer->insertOne($header);
            echo ' >> Header added'.PHP_EOL;
        }
    }

    public function showData()
    {
        $reader = Reader::createFromPath($this->persistenceFilename, 'r');
        $records = $reader->getRecords();

        echo PHP_EOL.PHP_EOL.'### Show Data Stored ###'.PHP_EOL;
        foreach ($records as $offset => $record) {
            echo json_encode($record) . PHP_EOL;
        }
    }
}