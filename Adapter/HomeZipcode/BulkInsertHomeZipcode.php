<?php

namespace Contrib\JapanZipcodeBundle\Adapter\HomeZipcode;

class BulkInsertHomeZipcode extends BaseAdapter
{
    public function execute()
    {
        $sql = $this->getInsertHomeZipCode();

        return $this->executeUpdate($sql);
    }

    protected function getInsertHomeZipCode()
    {
        return "
insert
    home_zipcode
select
    t.id
,   t.zipcode
,   t.pref_kana
,   t.city_kana
,   case
        when locate('場合', t.town) <> 0
        then ''
        else
        case
            when locate('一円', t.town) > 1
            then ''
            else t.town_kana
        end
    end as town_kana
,   t.pref
,   t.city
,   case
        when locate('場合', t.town) <> 0
        then ''
        else
        case
            when locate('一円', t.town) > 1
            then ''
            else t.town
        end
    end as town
from
(
-- one town per zip code
    select
        t1_1.id
    ,   t1_1.zipcode
    ,   t1_1.pref_kana
    ,   t1_1.city_kana
    ,   t1_1.town_kana
    ,   t1_1.pref
    ,   t1_1.city
    ,   t1_1.town
    from
        w_home_zipcode as t1_1
        inner join
        (
            select
                ta1.zipcode
            from
                w_home_zipcode as ta1
            group by
                ta1.zipcode
            having
                count(ta1.zipcode) = 1
        ) as t2_1 on t1_1.zipcode = t2_1.zipcode

    union

-- more than one town per zip code
    select
        t1_2.id
    ,   t1_2.zipcode
    ,   t1_2.pref_kana
    ,   t1_2.city_kana
    ,   t1_2.town_kana
    ,   t1_2.pref
    ,   t1_2.city
    ,   t1_2.town
    from
        w_home_zipcode as t1_2
        inner join
        (
            select
                ta1.zipcode
            from
                w_home_zipcode as ta1
            where
                ta1.flg4 = 1
            group by
                ta1.zipcode
            having
                count(ta1.zipcode) > 1
        ) as t2_2 on t1_2.zipcode = t2_2.zipcode

    union

-- one town divided into multiple records per zip code
    select
        t1_3.id
    ,   t1_3.zipcode
    ,   t1_3.pref_kana
    ,   t1_3.city_kana
    ,   case t1_3.town_kana_1
            when t1_3.town_kana_2
            then t1_3.town_kana_1
            else substring_index(concat(t1_3.town_kana_1, t1_3.town_kana_2), '（', 1)
        end as town_kana
    ,   t1_3.pref
    ,   t1_3.city
    ,   substring_index(concat(t1_3.town_1, t1_3.town_2), '（', 1) as town
    from
    (
        select
            ta1.id
        ,   ta1.zipcode
        ,   ta1.pref_kana
        ,   ta1.city_kana
        ,   ta1.pref
        ,   ta1.city
        ,   max(case ta1.row_id
                    when 1
                    then ta1.town_kana
                    else null
                end) as town_kana_1
        ,   max(case ta1.row_id
                    when 2
                    then ta1.town_kana
                    else null
                end) as town_kana_2
        ,   max(case ta1.row_id
                    when 1
                    then ta1.town
                    else null
                end) as town_1
        ,   max(case ta1.row_id
                    when 2
                    then ta1.town
                    else null
                end) as town_2
        from
        (
            select
                tb1.*
            ,   tb1.id - tb2.min_id + 1 as row_id
            from
                w_home_zipcode as tb1
                inner join
                (
                    select
                        tc1.zipcode
                    ,   min(tc1.id) as min_id
                    from
                        w_home_zipcode as tc1
                    where
                        tc1.flg4 = 0
                    group by
                        tc1.zipcode
                    having
                        count(tc1.zipcode) > 1
                ) as tb2 on tb1.zipcode = tb2.zipcode
        ) as ta1
        group by
            ta1.zipcode
    ) as t1_3
) as t";
    }
}
