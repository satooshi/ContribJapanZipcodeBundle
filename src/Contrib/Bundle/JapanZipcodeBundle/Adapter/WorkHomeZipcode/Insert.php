<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

class Insert extends BaseAdapter
{
    public function execute(array $params, $useCachedSql = true)
    {
        $types = $this->getTypes();

        return $this->multipleInsert($params, $types, $useCachedSql);
    }
}
