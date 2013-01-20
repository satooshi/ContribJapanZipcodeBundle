<?php

namespace Contrib\JapanZipcodeBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Connection;
use Contrib\CommonBundle\Adapter\WorkOfficeZipcode\Insert;
use Contrib\JapanZipcodeBundle\File\OfficeZipcodeCsvReader;
use Contrib\CommonBundle\File\CsvFileClient;
use Contrib\JapanZipcodeBundle\Adapter\WorkOfficeZipcode\Truncate as TruncateWorkOfficeZipcode;
use Contrib\JapanZipcodeBundle\Adapter\OfficeZipcode\Truncate as TruncateOfficeZipcode;
use Contrib\JapanZipcodeBundle\Adapter\WorkOfficeZipcode\Count as CountWorkOfficeZipcode;
use Contrib\JapanZipcodeBundle\Adapter\OfficeZipcode\Count as CountOfficeZipcode;
use Contrib\JapanZipcodeBundle\Adapter\OfficeZipcode\BulkInsert;

class OfficeZipcodeFixtureCommand extends BaseCommand
{
    protected $path;

    protected function configure()
    {
        $this
        ->setName('contrib:japan-zipcode:office-zipcode-fixture')
        ->setDescription('setup office_zipcode fixture')
        ->addOption(
            'file', // --file
            'f', // -f /path/to/JIGYOSYO.CSV
            InputOption::VALUE_REQUIRED,
            'JIGYOSYO.CSV file path',
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

        // w_office_zipcode
        $driver->beginTransaction();
        $this->transactWorkOfficeZipcode($em, $this->path);
        $driver->commit();

        // office_zipcode
        $driver->beginTransaction();
        $this->transactOfficeZipcode($em);
        $driver->commit();
    }

    protected function transactWorkOfficeZipcode($em, $path)
    {
        $this->truncateWorkOfficeZipcode($em);
        $this->console('truncated w_office_zipcode');

        $reader = new OfficeZipcodeCsvReader($em, 0);
        $client = new CsvFileClient($path);
        $client->walk(array($reader, 'readline'));
        $reader->insert(false);

        $count = $this->countWorkOfficeZipcode($em);
        $this->console(sprintf('inserted %d records to w_office_zipcode', $count));
    }

    protected function transactOfficeZipcode($em)
    {
        $this->truncateOfficeZipcode($em);
        $this->console('truncated office_zipcode');

        $this->insertOfficeZipcode($em);

        $count = $this->countOfficeZipcode($em);
        $this->console(sprintf('inserted %d records to office_zipcode', $count));
    }

    protected function truncateWorkOfficeZipcode($em)
    {
        $adapter = new TruncateWorkOfficeZipcode($em);

        return $adapter->execute();
    }

    protected function truncateOfficeZipcode($em)
    {
        $adapter = new TruncateOfficeZipcode($em);

        return $adapter->execute();
    }

    protected function countWorkOfficeZipcode($em)
    {
        $adapter = new CountWorkOfficeZipcode($em);

        return $adapter->execute();
    }

    protected function countOfficeZipcode($em)
    {
        $adapter = new CountOfficeZipcode($em);

        return $adapter->execute();
    }

    protected function insertOfficeZipcode($em)
    {
        $adapter = new BulkInsert($em);

        return $adapter->execute();
    }
}
