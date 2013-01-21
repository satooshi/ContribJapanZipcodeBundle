<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\OfficeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        return $this->truncate();
    }
}
