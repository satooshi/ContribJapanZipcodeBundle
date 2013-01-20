<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        $sql = 'truncate work_home_zipcode';

        return $this->executeStatement($sql);
    }
}
