<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkOfficeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        return $this->truncate();
    }
}
