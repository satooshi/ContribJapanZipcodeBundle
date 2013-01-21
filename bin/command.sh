#!/bin/sh

URL=http://www.post.japanpost.jp/zipcode/dl

rm -f ken_all.zip jigyosyo.zip
wget ${URL}/kogaki/zip/ken_all.zip
wget ${URL}/jigyosyo/zip/jigyosyo.zip

unzip ken_all.zip
unzip jigyosyo.zip

iconv -f cp932 -t utf8 ken_all.csv > ken_all_iconv.csv
iconv -f cp932 -t utf8 jigyosyo.csv > jigyosyo_iconv.csv

rm -f ken_all.csv ken_all_iconv.csv jigyosyo.csv jigyosyo_iconv.csv ken_all.zip jigyosyo.zip
