<?php

namespace Contrib\JapanZipcodeBundle\Adapter\OfficeZipcode;

use Contrib\JapanZipcodeBundle\Adapter\RepositoryAdapter;

abstract class BaseAdapter extends RepositoryAdapter
{
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
