<?php

namespace Contrib\JapanZipcodeBundle\Adapter\OfficeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        return $this->count();
    }
}
