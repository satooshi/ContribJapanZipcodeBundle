<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkOfficeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        return $this->truncate();
    }
}
