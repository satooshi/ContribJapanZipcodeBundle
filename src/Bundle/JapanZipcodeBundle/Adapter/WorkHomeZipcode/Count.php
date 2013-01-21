<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        return $this->count();
    }
}
