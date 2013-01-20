<?php

namespace Contrib\JapanZipcodeBundle\Command;

use Contrib\CommonBundle\Adapter\WorkHomeZipcode\Insert;
use Contrib\JapanZipcodeBundle\File\HomeZipcodeCsvReader;
use Contrib\CommonBundle\File\CsvFileClient;
use Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode\Truncate as TruncateWorkHomeZipcode;
use Contrib\JapanZipcodeBundle\Adapter\HomeZipcode\Truncate as TruncateHomeZipcode;
use Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode\Count as CountWorkHomeZipcode;
use Contrib\JapanZipcodeBundle\Adapter\HomeZipcode\Count as CountHomeZipcode;
use Contrib\JapanZipcodeBundle\Adapter\HomeZipcode\BulkInsertHomeZipcode;

class HomeZipcodeFixtureCommand extends BaseCommand
{
    protected $path;

    public function setPath($path)
    {
        $this->path = $path;
    }

    protected function doWork(InputInterface $input)
    {
        // configure csv path
        $path = __DIR__ . '/Fixture/KEN_ALL.CSV';

        $em     = $this->getEntityManager();
        $driver = $this->getDatabaseConnection();

        // w_home_zipcode
        $driver->beginTransaction();
        $this->transactWorkHomeZipcode($em, $path);
        $driver->commit();

        // home_zip_code
        $driver->beginTransaction();
        $this->transactHomeZipcode($em);
        $driver->commit();
    }

    protected function transactWorkHomeZipcode($em, $path)
    {
        $this->truncateWorkHomeZipcode($em);

        $reader = new HomeZipcodeCsvReader($em, 0);
        $client = new CsvFileClient($path);
        $client->walk(array($reader, 'readline'));
        $reader->insert();

        $count = $this->countWorkHomeZipcode($em);
        $this->console(sprintf('inserted %d records to work_home_zipcode', $count));
    }

    protected function transactHomeZipcode($em)
    {
        $this->truncateHomeZipcode($em);
        $this->insertHomeZipcode($em);

        $count = $this->countHomeZipcode($em);
        $this->console(sprintf('inserted %d records to home_zipcode', $count));
    }

    protected function truncateWorkHomeZipcode($em)
    {
        $adapter = new TruncateWorkHomeZipcode($em);

        return $adapter->execute();
    }

    protected function truncateHomeZipcode($em)
    {
        $adapter = new TruncateHomeZipcode($em);

        return $adapter->execute();
    }

    protected function countWorkHomeZipcode($em)
    {
        $adapter = new CountWorkHomeZipcode($em);

        return $adapter->execute();
    }

    protected function countHomeZipcode($em)
    {
        $adapter = new CountHomeZipcode($em);

        return $adapter->execute();
    }

    protected function insertHomeZipcode($em)
    {
        $adapter = new BulkInsertHomeZipcode($em);

        return $adapter->execute();
    }
}
