<?php

namespace Contrib\JapanZipcodeBundle\Adapter\HomeZipcode;

use Contrib\JapanZipcodeBundle\Adapter\RepositoryAdapter;

abstract class BaseAdapter extends RepositoryAdapter
{
    const TABLE_NAME = 'home_zipcode';

    public function getTypes()
    {
        return array(
            'id' => 'int',
            'zipcode' => 'string',
            'pref' => 'string',
            'city' => 'string',
            'town' => 'string',
            'pref_kana' => 'string',
            'city_kana' => 'string',
            'town_kana' => 'string',
        );
    }
}
