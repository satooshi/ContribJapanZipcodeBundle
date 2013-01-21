<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkOfficeZipcode;

use Contrib\Bundle\JapanZipcodeBundle\Adapter\RepositoryAdapter;

abstract class BaseAdapter extends RepositoryAdapter
{
    const TABLE_NAME = 'w_office_zipcode';

    public function getTypes()
    {
        return array(
            'id' => 'int',
            'zipcode' => 'string',
            'old_zipcode' => 'string',
            'jiscode' => 'string',
            'pref' => 'string',
            'city' => 'string',
            'town' => 'string',
            'street' => 'string',
            'office_name' => 'string',
            'office_name_kana' => 'string',
            'branch_name' => 'string',
            'flg1' => 'int',
            'flg2' => 'int',
            'flg3' => 'int',
        );
    }
}
