<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        return $this->truncate();
    }
}
