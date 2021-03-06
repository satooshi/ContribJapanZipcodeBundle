<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Connection;
use Contrib\Bundle\CommonBundle\File\CsvFileClient;
use Contrib\Bundle\JapanZipcodeBundle\File\HomeZipcodeCsvReader;
use Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkHomeZipcode\Truncate as TruncateWorkHomeZipcode;
use Contrib\Bundle\JapanZipcodeBundle\Adapter\HomeZipcode\Truncate as TruncateHomeZipcode;
use Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkHomeZipcode\Count as CountWorkHomeZipcode;
use Contrib\Bundle\JapanZipcodeBundle\Adapter\HomeZipcode\Count as CountHomeZipcode;
use Contrib\Bundle\JapanZipcodeBundle\Adapter\HomeZipcode\BulkInsert;

class HomeZipcodeFixtureCommand extends BaseCommand
{
    protected $path;

    protected function configure()
    {
        $this
        ->setName('contrib:japan-zipcode:home-zipcode-fixture')
        ->setDescription('setup home_zipcode fixture')
        ->addOption(
            'file', // --file
            'f', // -f /path/to/ken_all.csv
            InputOption::VALUE_REQUIRED,
            'ken_all.csv file path',
            null
        );
    }

    protected function prepareFile(InputInterface $input)
    {
        $file = $input->getOption('file');

        if (file_exists($file) && is_file($file) && is_readable($file)) {
            $this->path = $file;
        }
    }

    protected function doWork(InputInterface $input)
    {
        // configure csv path
        $this->prepareFile($input);

        $em     = $this->getEntityManager();
        $driver = $this->getDatabaseConnection();

        // w_home_zipcode
        $driver->beginTransaction();
        $this->transactWorkHomeZipcode($em, $this->path);
        $driver->commit();

        // home_zipcode
        $driver->beginTransaction();
        $this->transactHomeZipcode($em);
        $driver->commit();
    }

    protected function transactWorkHomeZipcode($em, $path)
    {
        $this->truncateWorkHomeZipcode($em);
        $this->console('truncated w_home_zipcode');

        $reader = new HomeZipcodeCsvReader($em, 0);
        $client = new CsvFileClient($path);
        $client->walk(array($reader, 'readline'));
        $reader->insert(false);

        $count = $this->countWorkHomeZipcode($em);
        $this->console(sprintf('inserted %d records to w_home_zipcode', $count));
    }

    protected function transactHomeZipcode($em)
    {
        $this->truncateHomeZipcode($em);
        $this->console('truncated home_zipcode');

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
        $adapter = new BulkInsert($em);

        return $adapter->execute();
    }
}
