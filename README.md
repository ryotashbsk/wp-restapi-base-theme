# WordPress Theme for WP REST API

## 基本プラグイン
- ACF PRO（カスタムフィールド）：https://www.advancedcustomfields.com/pro/
- ACF to REST API（RESTAPIレスポンスにACFの値を含める）：https://ja.wordpress.org/plugins/acf-to-rest-api/
- WP REST Cache（APIキャッシュ）：https://ja.wordpress.org/plugins/wp-rest-cache/

## WP REST APIのデフォルト機能を使用する場合
### エンドポイント
- ```server/cms/wp-json/v2/posts/```：基本投稿一覧
- ```server/cms/wp-json/v2/posts/{記事ID}/```：指定IDの記事
- ```server/cms/wp-json/v2/pages/```：固定ページ一覧
- ```server/cms/wp-json/v2/pages/{固定ページID}/```：指定IDの固定ページ
- ```server/cms/wp-json/v2/{カスタム投稿タイプ}/```：カスタム投稿の記事一覧
- ```server/cms/wp-json/v2/{カスタム投稿タイプ}/{記事ID}/```：指定IDのカスタム投稿記事

### APIレスポンス例
```
[{
  id: 1,
  date: "2020-01-01T00:00:00",
  slug: "hoge",
  link: "http://server/cms/news/hoge/",
  title:
  {
    rendered: "タイトル"
  },
  categories: [
    1
  ],
  acf:
  {
    hoge_field:
  }
}]
```
### よく使うパラメータ
- ```per_page```：表示件数
- ```page```：ページネーション
- ```search```：タイトルと、コンテンツから検索（ACF値は除く）
- ```order```：表示順（asc, desc）、初期値はdesc
- ```orderby```：並び替えの基準（author, date, id, include, modified, parent, relevance, slug, include_slugs, title）、初期値はdate
- ```slug```：スラッグ名
- ```categories```：所属カテゴリー


## ACF to REST API版を使用する場合
### エンドポイント
ACFの値のみに制限したレスポンスになり、不要なデフォルト値を削除できる。　
フロントエンドで利用する際に、すべてACFの値で完結する場合は、こちらを使うのが良い。
- ```server/cms/wp-json/acf/v3/posts/```：基本投稿一覧
- ```server/cms/wp-json/acf/v3/posts/{記事ID}/```：指定IDの記事
- ```server/cms/wp-json/acf/v3/pages/```：固定ページ一覧
- ```server/cms/wp-json/acf/v3/pages/{固定ページID}/```：指定IDの固定ページ
- ```server/cms/wp-json/acf/v3/{カスタム投稿タイプ}/```：カスタム投稿一覧
- ```server/cms/wp-json/acf/v3/{カスタム投稿タイプ}/{記事ID}/```：指定IDのカスタム投稿記事

### APIレスポンス例
```
[{
  id: 1,
  acf:
  {
    hoge_field:
  }
}]
```

### よく使うパラメータ
- ```per_page```：表示件数
- ```page```：ページネーション
- ```search```：タイトルと、コンテンツから検索（ACF値は除く）
- ```order```：表示順（asc, desc）、初期値はdesc
- ```orderby```：並び替えの基準（author, date, id, include, modified, parent, relevance, slug, include_slugs, title）、初期値はdate
- ```slug[]```：スラッグ名 ※デフォルト版とはことなるので要注意
- ```categories```：所属カテゴリー
