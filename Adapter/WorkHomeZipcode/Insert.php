<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Insert extends BaseAdapter
{
    public function execute(array $params)
    {
        $types = $this->getTypes();

        return $this->multipleInsert('w_home_zipcode', $params, $types);
    }
}
