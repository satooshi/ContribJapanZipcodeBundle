<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\OfficeZipcode;

class FindByZipcode extends BaseAdapter
{
    public function execute($zipcode, $limit = 100, $offset = 0)
    {
        $sql = "select
            id, zipcode, pref, city, town, street, office_name officeName, office_name_kana officeNameKana, branch_name branchName
            from %s
            where zipcode = ?
            limit ? offset ?";
        $sql = sprintf($sql, static::TABLE_NAME);

        $params = array(
            1 => array($zipcode, 'string'),
            2 => array((int)$limit, 'int'),
            3 => array((int)$offset, 'int'),
        );

        return $this->executeStatement($sql, $params);
    }
}
