ContribJapanZipcodeBundle
=========================

Symfony2 bundle for Japan zipcode search api.

郵便局が提供している[郵便番号データ](http://www.post.japanpost.jp/zipcode/download.html)を使用した検索APIです。現在は2種類の郵便番号データを元に検索APIを実装しています。

* [都道府県一覧データ](http://www.post.japanpost.jp/zipcode/dl/kogaki.html)
* [事業所の個別郵便番号データ](http://www.post.japanpost.jp/zipcode/dl/jigyosyo/index.html)

### 上記データからの主な変更点

* 複数に分割されている長い町域名のレコードを1つのレコードに統合
* 町域名に"（"が含まれる場合、それ以降の文字を削除
* 次の条件の場合、町域名・町域名フリガナを空文字に変更
	* 町域名が"以下に掲載がない場合"の場合
	* 町域名が"場合"で終わる場合
	* 町域名が"一円"で終わる場合
