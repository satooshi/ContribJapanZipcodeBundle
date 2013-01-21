#!/bin/sh

bin_dir=`dirname $0`
bundle_root_dir=`cd ${bin_dir}; cd ../;pwd`

cd ${bundle_root_dir}
cd ../../../

root_dir=`pwd`
tmp_dir=tmp/zipcode
URL=http://www.post.japanpost.jp/zipcode/dl

if [ ! -d ${tmp_dir} ]; then
    mkdir -p ${tmp_dir}
fi

# tmp dir
cd ${tmp_dir}

rm -rf *

# home zipcode file
wget ${URL}/kogaki/zip/ken_all.zip
unzip ken_all.zip

if [ ! -f KEN_ALL.CSV ]; then
    exit 1
fi

iconv -f cp932 -t utf8 KEN_ALL.CSV > ken_all_iconv.csv

# office zipcode file
wget ${URL}/jigyosyo/zip/jigyosyo.zip
unzip jigyosyo.zip

if [ ! -f JIGYOSYO.CSV ]; then
    exit 1
fi

iconv -f cp932 -t utf8 JIGYOSYO.CSV > jigyosyo_iconv.csv

# prj root
cd ${root_dir}

php app/console contrib:japan-zipcode:home-zipcode-fixture -f ${tmp_dir}/ken_all_iconv.csv $*
php app/console contrib:japan-zipcode:office-zipcode-fixture -f ${tmp_dir}/jigyosyo_iconv.csv $*
