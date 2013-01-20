<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        $sql = 'truncate w_home_zipcode';

        return $this->executeStatement($sql);
    }
}
