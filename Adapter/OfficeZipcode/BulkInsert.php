<?php

namespace Contrib\JapanZipcodeBundle\Adapter\OfficeZipcode;

class BulkInsertOfficeZipcode extends BaseAdapter
{
    public function execute()
    {
        $sql = $this->getInsertOfficeZipcode();

        return $this->executeUpdate($sql);
    }

    protected function getInsertOfficeZipcode()
    {
        return "
insert
    office_zipcode
select
    t1.id
,   t1.zipcode
,   t1.pref
,   t1.city
,   t1.town
,   t1.street
,   t1.office_name_kana
,   t1.office_name
,   t1.branch_name
from
    w_office_zipcode as t1";
    }
}
