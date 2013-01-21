<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\OfficeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        return $this->count();
    }
}
