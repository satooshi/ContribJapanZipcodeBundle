<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

use Contrib\Bundle\JapanZipcodeBundle\Adapter\RepositoryAdapter;

abstract class BaseAdapter extends RepositoryAdapter
{
    const TABLE_NAME = 'w_home_zipcode';

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
            'pref_kana' => 'string',
            'city_kana' => 'string',
            'town_kana' => 'string',
            'flg1' => 'int',
            'flg2' => 'int',
            'flg3' => 'int',
            'flg4' => 'int',
            'flg5' => 'int',
            'flg6' => 'int',
        );
    }
}
