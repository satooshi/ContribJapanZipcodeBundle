<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkOfficeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        return $this->count();
    }
}
