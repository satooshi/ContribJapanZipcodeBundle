<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        return $this->truncate();
    }
}
