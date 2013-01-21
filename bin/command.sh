#!/bin/sh

bin_dir=`dirname $0`
root_dir=`cd ${bin_dir}; cd ../;pwd`

cd ${root_dir}
cd ../../../

URL=http://www.post.japanpost.jp/zipcode/dl

rm -f ken_all.zip jigyosyo.zip
wget ${URL}/kogaki/zip/ken_all.zip
wget ${URL}/jigyosyo/zip/jigyosyo.zip

unzip ken_all.zip
unzip jigyosyo.zip

iconv -f cp932 -t utf8 ken_all.csv > ken_all_iconv.csv
iconv -f cp932 -t utf8 jigyosyo.csv > jigyosyo_iconv.csv

php app/console contrib:japan-zipcode:home-zipcode-fixture -f ken_all_iconv.csv $*
php app/console contrib:japan-zipcode:office-zipcode-fixture -f jigyosyo_iconv.csv $*

rm -f ken_all.csv ken_all_iconv.csv jigyosyo.csv jigyosyo_iconv.csv ken_all.zip jigyosyo.zip
