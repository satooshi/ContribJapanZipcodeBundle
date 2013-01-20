<?php

namespace Contrib\CommonBundle\Adapter\HomeZipcode;

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
            'pref_kana' => 'string',
            'city_kana' => 'string',
            'town_kana' => 'string',
        );
    }
}
