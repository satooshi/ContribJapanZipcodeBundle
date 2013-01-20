<?php

namespace Contrib\JapanZipcodeBundle\Adapter\HomeZipcode;

class FindByZipcode extends BaseAdapter
{
    public function execute($zipcode, $limit = 100, $offset = 0)
    {
        $sql = "select
            id, zipcode, pref, city, town, pref_kana prefKana, city_kana cityKana, town_kana townKana
            from home_zipcode
            where zipcode = ?
            limit ? offset ?";

        $params = array(
            1 => array($zipcode, 'string'),
            2 => array((int)$limit, 'int'),
            3 => array((int)$offset, 'int'),
        );

        return $this->executeStatement($sql, $params);
    }
}
