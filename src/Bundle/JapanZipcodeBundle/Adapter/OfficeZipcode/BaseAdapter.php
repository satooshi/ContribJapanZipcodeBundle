<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\OfficeZipcode;

use Contrib\Bundle\JapanZipcodeBundle\Adapter\RepositoryAdapter;

abstract class BaseAdapter extends RepositoryAdapter
{
    const TABLE_NAME = 'office_zipcode';

    public function getTypes()
    {
        return array(
            'id' => 'int',
            'zipcode' => 'string',
            'pref' => 'string',
            'city' => 'string',
            'town' => 'string',
            'street' => 'string',
            'office_name' => 'string',
            'office_name_kana' => 'string',
            'branch_name' => 'string',
        );
    }
}
