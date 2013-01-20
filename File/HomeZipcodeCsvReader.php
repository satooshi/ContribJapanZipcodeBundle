<?php

namespace Contrib\JapanZipcodeBundle\File;

use Doctrine\ORM\EntityManager;
use Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode\Insert;
use Contrib\CommonBundle\File\CsvSequentialReader;

class HomeZipcodeCsvReader extends CsvSequentialReader
{
    /**
     * @var array
     */
    protected $entitySet = array();

    /**
     * @var \Contrib\CommonBundle\Adapter\WorkHomeZipcode\Insert
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

        if ($numLine % 25 == 0) {
            $this->insert();
        }

        return true;
    }

    public function insert()
    {
        if (count($this->entitySet) > 0) {
            $affectedRows = $this->adapter->execute($this->entitySet);

            $this->entitySet = array();

            return $affectedRows;
        }

        return 0;
    }

    protected function convert($data)
    {
        $data[1] = trim($data[1]);
        $data[3] = mb_convert_kana($data[3], 'AKSV');
        $data[4] = mb_convert_kana($data[4], 'AKSV');
        $data[5] = mb_convert_kana($data[5], 'AKSV');

        return $data;
    }

    protected function map($data)
    {
        return array(
            'zipcode'     => $data[2],
            'old_zipcode' => $data[1],
            'jiscode'     => $data[0],
            'pref'        => $data[6],
            'city'        => $data[7],
            'town'        => $data[8],
            'pref_kana'   => $data[3],
            'city_kana'   => $data[4],
            'town_kana'   => $data[5],
            'flg1'        => $data[9],
            'flg2'        => $data[10],
            'flg3'        => $data[11],
            'flg4'        => $data[12],
            'flg5'        => $data[13],
            'flg6'        => $data[14],
        );
    }
}
