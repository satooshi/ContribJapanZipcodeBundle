<?php

namespace Contrib\Bundle\JapanZipcodeBundle\File;

use Doctrine\ORM\EntityManager;
use Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkOfficeZipcode\Insert;
use Contrib\CommonBundle\File\CsvSequentialReader;

class OfficeZipcodeCsvReader extends CsvSequentialReader
{
    /**
     * @var array
     */
    protected $entitySet = array();

    /**
     * @var \Contrib\CommonBundle\Adapter\WorkOfficeZipcode\Insert
    */
    protected $adapter;

    /**
     * Constructor.
     *
     * @param EntityManager $em
     * @param integer       $headerCount
     */
    public function __construct(EntityManager $em, $headerCount = 0)
    {
        parent::__construct($em, $headerCount);

        $this->adapter = new Insert($em);
    }

    public function insert($useCachedSql = true)
    {
        if (count($this->entitySet) > 0) {
            $affectedRows = $this->adapter->execute($this->entitySet, $useCachedSql);

            $this->entitySet = array();

            return $affectedRows;
        }

        return 0;
    }

    // internal API

    /**
     * {@inheritdoc}
     *
     * @see \Contrib\CommonBundle\File\CsvSequentialReader::assertHeader()
     */
    protected function assertHeader($items, $numLine, $length)
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see \Contrib\CommonBundle\File\CsvSequentialReader::assertBody()
     */
    protected function assertBody($items, $numLine, $length)
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see \Contrib\CommonBundle\File\CsvSequentialReader::processHeader()
     */
    protected function processHeader($items, $numLine, $length)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Contrib\CommonBundle\File\CsvSequentialReader::processBody()
     */
    protected function processBody($items, $numLine, $length)
    {
        $this->entitySet[] = $this->map($this->convert($items));

        if ($numLine % 35 == 0) {
            $this->insert();
        }

        return true;
    }

    // internal method

    protected function convert($data)
    {
        $data[8] = trim($data[8]);
        $data[1] = mb_convert_kana($data[1], 'AKSV');

        return $data;
    }

    protected function map($data)
    {
        return array(
            'zipcode'          => $data[7],
            'old_zipcode'      => $data[8],
            'jisCode'          => $data[0],
            'pref'             => $data[3],
            'city'             => $data[4],
            'town'             => $data[5],
            'street'           => $data[6],
            'office_name'      => $data[2],
            'office_name_kana' => $data[1],
            'branch_name'      => $data[9],
            'flg1'             => $data[10],
            'flg2'             => $data[11],
            'flg3'             => $data[12],
        );
    }

    // accessor

    public function getEntitySet()
    {
        return $this->entitySet;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }
}
