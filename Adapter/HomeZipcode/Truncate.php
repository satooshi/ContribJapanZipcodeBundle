<?php

namespace Contrib\JapanZipcodeBundle\Adapter\HomeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        $sql = 'truncate home_zipcode';

        return $this->executeStatement($sql);
    }
}
