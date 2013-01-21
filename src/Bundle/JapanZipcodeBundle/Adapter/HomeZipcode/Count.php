<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\HomeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        return $this->count();
    }
}
