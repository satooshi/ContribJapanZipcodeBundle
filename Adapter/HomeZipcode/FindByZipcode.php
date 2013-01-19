<?php

namespace Contrib\JapanZipcodeBundle\Adapter\HomeZipcode;

use Contrib\JapanZipcodeBundle\Adapter\RepositoryAdapter;

class FindByZipcode extends RepositoryAdapter
{
    public function execute($zipcode, $limit = 100, $offset = 0)
    {
        $limit  = (int)$limit;
        $offset = (int)$offset;

        $sql = "select
            id, zipcode, pref, city, town, pref_kana prefKana, city_kana cityKana, town_kana townKana
            from home_zipcode
            where zipcode = ?
            limit ? offset ?";

        $params = array(
            1 => array($zipcode, 'string'),
            2 => array($limit, 'int'),
            3 => array($offset, 'int'),
        );

        return $this->executeStatement($sql, $params);
    }
}
