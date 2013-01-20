<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkOfficeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        return $this->count();
    }
}
