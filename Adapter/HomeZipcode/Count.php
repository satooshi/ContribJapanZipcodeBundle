<?php

namespace Contrib\JapanZipcodeBundle\Adapter\HomeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        return $this->count();
    }
}
