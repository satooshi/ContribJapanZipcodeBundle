<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Count extends BaseAdapter
{
    public function execute()
    {
        return $this->count('w_home_zipcode');
    }
}
