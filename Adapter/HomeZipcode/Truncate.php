<?php

namespace Contrib\JapanZipcodeBundle\Adapter\HomeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        return $this->truncate('home_zipcode');
    }
}
