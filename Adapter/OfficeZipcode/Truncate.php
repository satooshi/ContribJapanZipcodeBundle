<?php

namespace Contrib\JapanZipcodeBundle\Adapter\OfficeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        return $this->truncate();
    }
}
