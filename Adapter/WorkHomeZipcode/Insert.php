<?php

namespace Contrib\CommonBundle\Adapter\WorkHomeZipcode;

class Insert extends BaseAdapter
{
    public function execute(array $params)
    {
        $types = $this->getTypes();

        return $this->multipleInsert('work_home_zipcode', $params, $types);
    }
}
