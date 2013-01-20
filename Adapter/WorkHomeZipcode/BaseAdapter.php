<?php

namespace Contrib\JapanZipcodeBundle\Adapter\WorkHomeZipcode;

use Contrib\JapanZipcodeBundle\Adapter\RepositoryAdapter;

abstract class BaseAdapter extends RepositoryAdapter
{
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
