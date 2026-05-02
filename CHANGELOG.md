# Changelog Laravel Meta Tags

## 3.6.0 - 2026-05-02

- Added compatibility with Laravel 10, 11, 12, 13 (range: 5.8-13).
- Improved migration stub compatibility for Laravel 5.8+ (`bigIncrements('id')`).
- Replaced Blade `Str` alias usage with FQCN for more stable cross-version behavior.

## 2.0.0 - 2019-02-11

- Added fields `seo_text`, `timestamps`
- Remove helper `meta_tag_prepare_path`
- Added support Laravel 5.8

## 1.2.0 - 2018-10-25

- Added caninical tag
- Added robots tag

## 1.1.0 - 2018-10-25

- Added `setDefault()` & `meta_tag_prepare_path`
- Fixed `singleton` for path
- Updated docs

## 1.0.0 - 2018-10-24

- Initial release package
