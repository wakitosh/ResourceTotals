# 変更履歴 (Changelog)

このファイルは本モジュールの主な変更点を記録します。
形式は [Keep a Changelog](https://keepachangelog.com/ja/1.1.0/) に、バージョニングは [Semantic Versioning](https://semver.org/lang/ja/) に準拠します。

## [0.1.0] - 2026-07-28

### Added

- サイトページブロック「Resource totals」を追加。編集可能なマークアップ（HTML）内でアイテム数・メディア数を表示可能に。
- マークアップ内で使用できる変数 `{item_total}` / `{media_total}` および、そのエイリアス（`items_total`, `item_count`, `media_count`）、区切りなし版（`_raw`）に対応。単一波括弧・二重波括弧（`{{ ... }}`）の両記法をサポート。
- ブロックラッパーにCSSクラスを付与できる「Class」設定項目を追加。
- 入力されたHTMLを `Omeka\HtmlPurifier` でサニタイズ。

---

## English

This file documents notable changes to this module.
The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/).

## [0.1.0] - 2026-07-28

### Added

- Initial release: adds a "Resource totals" site page block that displays item and media totals via editable markup (HTML).
- Support for template variables `{item_total}` / `{media_total}`, their aliases (`items_total`, `item_count`, `media_count`), and unformatted `_raw` variants. Both single-brace and double-brace (`{{ ... }}`) syntax are supported.
- Added a "Class" setting to apply a CSS class to the block wrapper.
- Sanitizes submitted HTML via `Omeka\HtmlPurifier`.
