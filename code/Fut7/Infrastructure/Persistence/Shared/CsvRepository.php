<?php

namespace Fut7\Infrastructure\Persistence\Shared;

use Fut7\Domain\Exception\Season\SeasonNotFoundException;
use League\Csv\Statement;
use League\Csv\Writer;
use League\Csv\Reader;

class CsvRepository
{
    private $persistenceFilename;

    public function __construct($persistenceFilename)
    {
        $this->persistenceFilename = $persistenceFilename;
    }

    public function checkPersistFile($filename)
    {
        // check exist filename

    }

    public function create($data)
    {
        $csv = Writer::createFromPath($this->persistenceFilename, 'a+');
        $this->checkInsertHeader($csv, $data['header']);
//        $csv->insertOne($data['header']);
        $csv->insertAll($data['records']);
    }

    /**
     * @throws SeasonNotFoundException
     */
    public function find($id)
    {
        $reader = Reader::createFromPath($this->persistenceFilename, 'r');
        $records = $reader->getRecords();

        echo PHP_EOL . '### Data Stored ###' . PHP_EOL;
        $recordFound = null;
        foreach ($records as $offset => $record) {
            echo json_encode($record) . PHP_EOL;
            if ($id === $record[0]) {
                $recordFound = $record;
            }
        }

        if (null === $recordFound) {
            throw new SeasonNotFoundException($id . ' NOT FOUND');
        }

        return $recordFound;
    }

    public function search(array $criteria)
    {
        // TODO: Implement search() method.
    }

    public function update($data)
    {
        // TODO: Implement update() method.
    }

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

        echo PHP_EOL.'########################';
        echo PHP_EOL.' Season '.$id.' found >> deleting';
        echo PHP_EOL.'########################'.PHP_EOL;

        echo PHP_EOL . '### New Data Stored ###' . PHP_EOL;
        foreach ($newDataToInsert as $offset => $record) {
            echo json_encode($record) . PHP_EOL;
        }

        $csv = Writer::createFromPath($this->persistenceFilename, 'w');
        $csv->insertAll($newDataToInsert);
    }

    /**
     * @param Writer $csv
     * @param $header
     * @throws \League\Csv\CannotInsertRecord
     */
    public function checkInsertHeader(Writer $csv, $header): void
    {
        try {
            $reader = Reader::createFromPath($this->persistenceFilename, 'r');
            $reader->setHeaderOffset(0);
            $records = Statement::create()->process($reader);
            $headers = $records->getHeader();
            if(empty($headers)) {
                $csv->insertOne($header);
                echo ' #> Header added'.PHP_EOL;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            $csv->insertOne($header);
            echo ' >> Header added'.PHP_EOL;
        }
    }
}