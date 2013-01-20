<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        $sql = 'select count(*) count from work_home_zipcode';

        return $this->executeScalar($sql);
    }
}
