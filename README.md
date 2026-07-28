# Resource Totals

[Omeka S](https://omeka.org/s/) 用モジュール。サイトページに、現在のアイテム数・メディア数を表示するブロックを追加します。表示内容は自由に編集できるマークアップ（HTML）として管理します。

## 動作要件

- Omeka S ^4.0.0

## インストール

1. [リリースページ](https://github.com/wakitosh/ResourceTotals/releases) から zip をダウンロードするか、リポジトリを取得します。

   ```sh
   cd /path/to/omeka-s/modules
   git clone https://github.com/wakitosh/ResourceTotals.git
   ```

2. ディレクトリ名が `ResourceTotals` であることを確認します（`config/module.ini` を参照するため）。
3. Omeka S 管理画面の「モジュール」からインストールします。

## 使い方

1. サイトページ編集画面でブロック「Resource totals」を追加します。
2. 「Markup text」欄に表示したいHTMLを記述します。初期値は以下の通りです。

   ```html
   <p>Items: <strong>{item_total}</strong><br>Media: <strong>{media_total}</strong></p>
   ```

3. 必要に応じて「Class」欄にCSSクラス名を指定すると、ブロック全体が `<div class="...">` で囲まれます。

### 利用できる変数

マークアップ中に以下の変数を埋め込むと、現在のアイテム数・メディア数に置き換えられます。`{item_total}` のように単一の波括弧、または `{{ item_total }}` のように二重の波括弧（前後の空白は任意）のどちらでも使用できます。

| 変数 | 内容 |
| --- | --- |
| `item_total` / `items_total` / `item_count` | アイテム総数（3桁区切りの数値表記） |
| `media_total` / `media_count` | メディア総数（3桁区切りの数値表記） |
| `item_total_raw` / `items_total_raw` / `item_count_raw` | アイテム総数（区切りなしの数値） |
| `media_total_raw` / `media_count_raw` | メディア総数（区切りなしの数値） |

未対応の変数名はそのまま文字列として出力されます。

### 補足

- 「Markup text」に入力したHTMLは、Omeka Sの `HtmlPurifier` によって保存時にサニタイズされます。
- アイテム数・メディア数は `Api::search()` を `limit=0` で呼び出して取得しており、ページ表示のたびに検索が実行されます。

## ライセンス

MIT

## 作者・リンク

- 作者: Toshihito Waki ([@wakitosh](https://github.com/wakitosh))
- モジュールリポジトリ: https://github.com/wakitosh/ResourceTotals
- 不具合報告・要望: https://github.com/wakitosh/ResourceTotals/issues

---

## English

A module for [Omeka S](https://omeka.org/s/) that adds a site page block displaying the current item and media totals, using editable markup (HTML).

### Requirements

- Omeka S ^4.0.0

### Installation

1. Download a zip from the [releases page](https://github.com/wakitosh/ResourceTotals/releases), or clone the repository into your `modules` directory:

   ```sh
   cd /path/to/omeka-s/modules
   git clone https://github.com/wakitosh/ResourceTotals.git
   ```

2. Make sure the directory is named `ResourceTotals`.
3. Install the module from the Omeka S admin panel under "Modules".

### Usage

1. Add the "Resource totals" block to a site page.
2. Enter the desired HTML in the "Markup text" field. The default is:

   ```html
   <p>Items: <strong>{item_total}</strong><br>Media: <strong>{media_total}</strong></p>
   ```

3. Optionally set a "Class" value to wrap the block in a `<div class="...">`.

### Available variables

Variables may use single braces (`{item_total}`) or double braces (`{{ item_total }}`, with optional surrounding whitespace):

| Variable | Value |
| --- | --- |
| `item_total` / `items_total` / `item_count` | Item total, formatted with thousands separators |
| `media_total` / `media_count` | Media total, formatted with thousands separators |
| `item_total_raw` / `items_total_raw` / `item_count_raw` | Item total, unformatted |
| `media_total_raw` / `media_count_raw` | Media total, unformatted |

Unrecognized variable names are left as-is in the output.

### Notes

- Markup entered in "Markup text" is sanitized on save via Omeka's `HtmlPurifier`.
- Totals are fetched via `Api::search()` with `limit=0` on every page render.

### License

MIT

### Author & links

- Author: Toshihito Waki ([@wakitosh](https://github.com/wakitosh))
- Repository: https://github.com/wakitosh/ResourceTotals
- Issues: https://github.com/wakitosh/ResourceTotals/issues
