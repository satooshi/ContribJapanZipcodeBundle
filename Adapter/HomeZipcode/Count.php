<?php

namespace Contrib\JapanZipcodeBundle\Adapter\HomeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        $sql = 'select count(*) count from home_zipcode';

        return $this->executeScalar($sql);
    }
}
