<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\HomeZipcode;

class Truncate extends BaseAdapter
{
    public function execute()
    {
        return $this->truncate();
    }
}
