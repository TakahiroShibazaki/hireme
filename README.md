<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 規格

###コード規約
PHPコーディング規約
本資料について
本資料はPHPによる開発する上での規約をまとめたものです。

開発者毎の品質の差を少なくし、ソースコードの可読性を高めることで、アプリケーションの保守性を高めていくことを目的として作成しています。


開発環境
PHP
PHPのバージョンは7.0を使用してください。

phpコマンドを実行できるように環境変数PATHにphpまでのパスを通してください。

php.ini
下記を適宜設定します

short_open_tag = ON
max_execution_time = 30
max_input_time = 30
memory_limit = 512M
display_errors = On
error_reporting = E_ALL & ~E_NOTICE & ~E_STRICT
post_max_size = 256M
upload_max_filesize = 256M
date.timezone = Asia/Tokyo
session.gc_divisor = 1000
session.gc_maxlifetime = 10800
mbstring.language = Japanese
mbstring.internal_encoding = UTF-8
mbstring.http_input = auto
mbstring.http_output = UTF-8
mbstring.encoding_translation = On
mbstring.detect_order = auto
mbstring.substitute_character = none;
Composer
アプリケーションのパッケージ管理にはComposerを使用しています。

開発環境にComposerをインストールしてください。

IDE（統合開発環境）
PhpStormを推奨しています。

1. 概要
1.1. PHPコーディング規約について
PSR1/2 をベースにして規約を策定します。

http://www.infiniteloop.co.jp/docs/psr/psr-0.html
http://www.infiniteloop.co.jp/docs/psr/psr-1-basic-coding-standard.html
http://www.infiniteloop.co.jp/docs/psr/psr-2-coding-style-guide.html


1.2. 概要
文字コードはUTF-8（BOM無し）を使用しなければなりません。
改行コードはLFでなければなりません。
行末に空白文字列を含んではいけません。
インデントは半角スペース4文字でなければいけません。タブ文字をそのまま使用してはいけません。
PHPコードは「<?php ?>」または短縮記述の「<?= ?>」を使用しなければなりません。
PHPコードのみからなるファイルでは、終了タグ「?>」は含めてはいけません。
PHPファイルは、最後に空行を入れなければいけません。
PHPの予約語はすべて小文字で記載しなければいけません。
PHPの定数であるtrue、false、nullは小文字で記載しなければいけません。
2. 命名規則
2.1. ファイル名
sampleTest.php

キャメルケースを使用します。
ファイル名は半角英数字とアンダースコアとハイフンのみが使用可能です。
クラスファイルの場合はアンダースコア・ハイフンを使用することはできません。
コントローラークラスファイルの場合はコントローラークラスファイルの命名規則に従ったファイル名で命名しなければいけません。
モデルクラスファイルの場合はモデルクラスファイルの命名規則に従ったファイル名で命名しなければいけません。
PHPコードを含むすべてのスクリプトファイルは「.php」の拡張子を使用しなければいけません。ただしビューファイルは例外で「.phtml」の拡張子を使用しなければいけません。
2.2. クラス名
Sample_Test

クラス名は半角英数字とアンダースコアのみが使用可能です。
クラス名は、StudlyCaps（単語の先頭文字を大文字で表記する記法）記法で定義しなければなりません。
コントローラークラスの場合はコントローラークラスの命名規則に従ったクラス名で命名しなければいけません。
モデルクラスの場合はモデルクラスの命名規則に従ったクラス名で命名しなければいけません。
その他のクラスは「library」フォルダの中に作成し、クラスの名前が保存先フォルダに直接対応するようなクラス名でなければいけません。
フォルダ区切りをアンダースコアにして命名しなければいけません。例えば「library/Ztr/Db/Table/User.php」のクラス名は「Ztr_Db_Table_User」になります。
※ 例外として「cnv_1」、「cnv_2」、「es」データベースへのアクセスクラスは、それぞれ最上位レベルのフォルダが「Cnv1」「Cnv2」「Es」になります。
2.3. メソッド名
sampleTest()

キャメルケースを使用します。
クラスの中で定義された関数のことをメソッドと呼称します。
メソッド名には半角英数字とアンダースコアが使用可能です。
メソッド名の最初の文字は小文字でなければいけません。
アクションの場合にはアクションメソッドの命名規則に従ったメソッド名で命名しなければいけません。
アクセス権が private あるいは protected と宣言されるメソッドはアンダースコアを使用することはできません。
マジックメソッド以外の public と宣言されるメソッドにはアンダースコアを使用することはできません。
オブジェクトのプロパティの値を取得するためのメソッド名は"get"で始めなければいけません。
オブジェクトのプロパティの値を設定するためのメソッド名は"set"で始めなければいけません。
2.3.1 アクション名
editexecuteAction()

2.4. プロパティ名
$sampleTest

キャメルケースを使用します。
クラスの中で定義された変数のことをプロパティと呼称します。
プロパティ名には半角英数字とアンダースコアが使用可能です。
プロパティ名の最初の文字は小文字でなければいけません。
アクセス権が private あるいは protected と宣言されるプロパティはアンダースコアを使用することはできません。
アクセス権が public と宣言されているもの、あるいはメンバ変数以外のプロパティはアンダースコアを使用することはできません。
2.5. 関数名
sample_test()

スネークケースを使用します。
関数名には半角英数字のみが使用可能です。
関数の最初の文字は小文字でなければなりません。
2.6. 変数名
$sampleTest

キャメルケースを使用します。
変数名には半角英数字とアンダースコアが使用可能です。
変数名の最初の文字は小文字でなければいけません。
2.7. 定数
SAMPLE_TEST

スネークケースを使用します。
定数名には半角英数字およびアンダースコアが使用可能です。
定数名はすべて大文字でなければいけません。
定数名の単語の間はアンダースコアで区切らなければなりません。
3. コーディングスタイル
3.1. クラスおよびプロパティ
クラスの開き中括弧はクラス名の次の行に記載しなければいけません。
クラスの閉じ中括弧はファイルの最後(空行前)に記載しなければいけません。
クラス定義は一つのファイルに一つのみでなければいけません。
クラスのプロパティはクラスの先頭で宣言されていなければいけません。
クラスのプロパティの宣言にvar構文を使用してはいけません。
クラスのプロパティは private、protected、public のいずれかの修飾子を用いてアクセス権を指定しなければいけません。
クラスのメソッドの開き中括弧は、メソッド名の次の行に記載しなければいけません。
クラスのメソッドは private、protected、public のいずれかの修飾子を用いてアクセス権を指定しなければいけません。
クラスのメソッド名と引数定義用の開き括弧の間にはスペースを入れてはいけません。
クラスのメソッドの引数リストでは、それぞれのカンマの前にスペースを入れてはいけません。また各カンマの後ろには１スペースを入れなければいけません。
クラスのメソッドの引数でデフォルト値を持つものは、引数リストの最後に配置しなければいけません。
```php
<?php
class ClassName
{
    public $property;
    
    public function bar($arg1, $arg2, $arg3 = '')
    {
        // 処理内容
    }
}

```
引数リストを複数行に分割する場合、インデントでそろえなければいけません。
引数リストを複数行に分割する場合、閉じ括弧と開き中括弧の間にはスペースを含め同じ行に配置しなければいけません。
```php
<?php
class ClassName
{
    public function aVeryLongMethodName(
        $arg1,
        $arg2,
        $arg3 = ''
    ) {
        // 処理内容
    }
}
```
値の参照渡しは、メソッドの宣言時にパラメーターを渡す部分においてのみ可能です。
```php
<?php
class ClassName
{
    public function bar(&$arg)
    {
        // 処理内容
    }
}
```
abstractとfinalはアクセス修飾子の前に定義しなければいけません。
staticはアクセス修飾子の後に定義しなければいけません。
```php
<?php
class ClassName
{
    protected static $foo;
    final public function bar()
    {
        // 処理内容
    }
}
```
3.2. 関数
関数の開き中括弧は、関数名の次の行に記載しなければいけません。
関数名と引数定義用の開き括弧の間にはスペースを入れてはいけません。
関数の引数リストでは、それぞれのカンマの前にスペースを入れてはいけません。また各カンマの後ろには１スペースを入れなければいけません。
関数のメソッドの引数でデフォルト値を持つものは、引数リストの最後に配置しなければいけません。
```php
<?php
function bar($arg1, $arg2, $arg3 = '')
{
    // 処理内容
}
```
引数リストを複数行に分割する場合、インデントでそろえなければいけません。
引数リストを複数行に分割する場合、閉じ括弧と開き中括弧の間にはスペースを含め同じ行に配置しなければいけません。
```php
<?php
function aVeryLongFunctionName(
    $arg1,
    $arg2,
    $arg3 = ''
) {
    // 処理内容
}
```
値の参照渡しは、関数の宣言時にパラメーターを渡す部分においてのみ可能です。
```php
<?php
function bar(&$arg)
{
    // 処理内容
}
```
3.3. メソッド・関数の呼び出し
メソッドや関数名と開き括弧の間にスペースがあってはいけません。
開き括弧の後や、閉じ括弧の前にスペースがあってはいけません。
引数リストのそれぞれのカンマの前にスペースを入れてはいけません。また各カンマの後ろには１スペースを入れなければいけません。
```php
<?php
bar();
$foo->bar($arg1);
Foo::bar($arg2, $arg3);
引数リストを複数行に分割する場合、インデントでそろえなければいけません。
<?php
$foo->bar(
    $longArgument,
    $longerArgument,
    $muchLongerArgument
);
```
メソッド・関数の呼び出し時に引数を参照渡ししてはいけません。
<?php
// メソッド・関数の呼び出し時に引数を参照渡しするのは禁止です。
bar(&$arg);
3.4. if/else/elseif
条件指定の開き括弧の前に空白をひとつ入れなければいけません。
条件指定の閉じ括弧の後に空白をひとつ入れなければいけません。
括弧で囲まれた条件文の演算子の前後にも空白を入れなければいけません。
開き中括弧は条件指定の行と同じ行に記載しなければいけません。
閉じ中括弧は常に改行してそれのみで記述しなければいけませんが、else/elseifがある場合はそれを同じ行に記載しなければいけません。
elseifを使用する場合、elseとifの間に空白を含めてはいけません。
elseifを使用数場合の条件指定の決まりは通常のifと同様でなければいけません。
```php
<?php
if ($bar === 1) {
    // 処理1
} elseif ($bar === 2) {
    // 処理2
} else {
    // 処理3
}
```
条件式が複数ある場合複数行に分割して記載できますが、インデントでそろえなければいけません。
条件式を複数行で分割する場合のインデント量は、最初の条件式の開始位置と同じでなければいけません。
条件式を複数行で分割する場合は論理演算の前で改行しなければいけません。
条件式を複数行で分割する場合、閉じ括弧と開き中括弧の間にはスペースを含め同じ行に配置しなければいけません。
OR条件は || で、AND条件は && で記述します。
```php
<?php
if ($bar === 1 || $bar === 2 || $bar === 3) {
    // 処理１
} elseif ($bar === 4
          && $bar === 5
          && $bar === 6
) {
    // 処理２
} else {
    // 処理３
}
```
曖昧な判定を避けるため、条件の判定には型指定の === または !== を使用します
直感的に理解しやすくするため、基本的に否定の条件は使用しません。
否定の条件では空白スペース無しで ! を添えます。
```php
<?php
// boolean型
$bar = false;
if ($bar === false) {
    // 推奨
}
if (empty($bar)) {
    // 非推奨
}
// int型
$bar = 0;
if (is_numeric($bar)) {
    // 推奨
}
if ($bar === 0) {
    // 推奨
}
if ($bar == '0') {
    // 非推奨
}
if ($bar == 0) {
    // 非推奨
}
if (empty($bar)) {
    // 非推奨
}
// string型
$bar = '';
if (is_string($bar)) {
    // 推奨
}
if ($bar === '') {
    // 推奨
}
if (empty($bar)) {
    // 非推奨
}
if ($bar == 0) {
    // 使用不可
}
// array型
$bar = [];
if (is_array($bar)) {
    // 推奨
}
if ($bar === []) {
    // 推奨
}
if (empty($bar)) {
    // 使用頻度高い
}
if (!empty($bar)) {
    // 使用頻度高い
}
// null
$bar = null;
if (is_null($bar)) {
    // 推奨
}
if (empty($bar)) {
    // 非推奨
}
```
型がわからない場合には
3.5. for
ループ条件の開き括弧の前には空白を一つ入れなければいけません。
ループ条件の閉じ括弧の後には空白を一つ入れなければいけません。
ループ条件内の演算子の前後には空白を一つ入れなければいけません。
開き中括弧はループ条件指定の行と同じ行に記載しなければいけません。
ループ条件内のそれぞれのセミコロンの前にスペースを入れてはいけません。また各セミコロンの後ろには１スペースを入れなければいけません。
```php
<?php
for ($i = 0; $i < 10; $i++) {
    // 処理
}
```
3.6. foreach
ループ条件の開き括弧の前には空白を一つ入れなければいけません。
ループ条件の閉じ括弧の後には空白を一つ入れなければいけません。
ループ条件内の演算子の前後には空白を一つ入れなければいけません。
開き中括弧はループ条件指定の行と同じ行に記載しなければいけません。
```php
<?php
foreach ($bars as $key => $bar) {
    // 処理
}
```
3.7. while
条件指定の開き括弧の前に空白をひとつ入れなければいけません。
条件指定の閉じ括弧の後に空白をひとつ入れなければいけません。
括弧で囲まれた条件文の演算子の前後にも空白を入れなければいけません。
開き中括弧は条件指定の行と同じ行に記載しなければいけません。
```php
<?php
while ($bar === 1) {
    // 処理
}
```
3.8. do while
開き中括弧はdoと同じ行に記載しなければいけません。
開き中括弧の前には空白を一つ入れなければいけません。
閉じ中括弧の後には空白を一つ入れなければいけません。
閉じ中括弧はwhileと同じ行に記載しなければいけません。
条件指定の開き括弧の前に空白をひとつ入れなければいけません。
条件指定の閉じ括弧の後に空白をひとつ入れなければいけません。
括弧で囲まれた条件文の演算子の前後にも空白を入れなければいけません。
```php
<?php
do {
    // 処理;
} while ($bar === 1);
```
3.9. switch/case
条件指定の開き括弧の前に空白をひとつ入れなければいけません。
条件指定の閉じ括弧の後に空白をひとつ入れなければいけません。
括弧で囲まれた条件文の演算子の前後にも空白を入れなければいけません。
開き中括弧は条件指定の行と同じ行に記載しなければいけません。
case文は switch からインデントし、break、returnはcase内本文と同じレベルのインデントでそろえなければいけません。
各case文内で break や return を記載せず意図的に次のcase処理を流す場合は、「// no break」のコメント行を記述しなければいけません。
```php
<?php
switch ($var) {
    case 0:
        // 処理１
        break;
    case 1:
        // 処理２
        // no break
    case 2:
    case 3:
        // 処理３
        return;
    default:
        // 処理４
        break;
}
```
3.10. try/catch
tryの開き中括弧はtryと同じ行に空白を一つ入れて記載しなければいけません。
閉じ中括弧に続くcatchがある場合は、空白を一つ入れて同じ行に記載しなければいけません。
catchで取得する例外の引数の開き括弧の前には空白を一つ、閉じ括弧の後には空白を一つ入れなければいけません。
catchブロックの開き中括弧は例外の引数の行と同じ行に記載しなければいけません。
finallyは前ブロックの閉じ中括弧と同じ行に空白を一つ入れて記載しなければいけません。
finallyブロックの開き中括弧はfinallyと同じ行に空白を一つ入れて記載しなければいけません。
```php
<?php
try {
    // 処理１
} catch (FirstExceptionType $e) {
    // 処理２
} catch (OtherExceptionType $e) {
    // 処理３
} finally {
    // 処理４
}
```
3.11. 三項演算子
条件部分は () で括ります
直感的に理解しやすくするため、基本的に否定の条件は使用しません。
```php
<?php
// 通常の記法
if ($bool === true) {
    $a = 1;
} else {
    $a = 0;
}
```
// 三項演算子で記述
```php
$a = ($bool === true) ? 1 : 0;
```
3.12. エルビス演算子（?:演算子）
A ?: B
Aの評価が真(true)のとき、Aの結果が返る。偽(false)のとき、Bの結果が返る。
ただしAが未定義の場合noticeエラーが発生してしまう
```php
<?php
// 通常の記法
if ($bool === false) {
    $a = 'hoge';
} else {
    $a = $bool;
}
// ?:演算子で記述
$a = $bool ?: 'hoge';
```
3.13. NULL合体演算子（??演算子）
Noticeエラーを出さないようにするメリットが有る
```php
<?php
// 通常の記法
if (is_null($bool)) {
    $a = 0;
} else {
    $a = $bool;
}
// ??演算子で記述
$a = $null ?? 0;
```
4. 文字列
文字列がリテラルである（変数の展開などが含まれない）場合は、シングルクォートで囲まなければいけません。
```php
<?php
$str = '文字列';
```
文字列自体にシングルクォートが含まれている場合はダブルクォートを使用しなければいけません。
```php
<?php
$str = "HOME'S";
```
文字列内で変数の展開を行う場合は文字列をダブルクォーテーションで囲み、変数を中括弧で囲まなければいけません。
```php
<?php
$str = "こんにちは{$name}さん";
```
文字列を連結する場合は「.」演算子の前後に空白を入れなければいけません。
```php
<?php
$str = $str1 . ' ' . $str2;
```
文字列を連結する場合に複数行に分割することもできますが、各行の「.」演算子のインデントが最初の行の「=」と同じ位置になるようにしなければいけません。
```php
<?php
$str = $str1
     . ' '
     . $str2;
```
5. 配列
空の配列の定義は [] で記述します。
配列の変数に要素を追加する場合、変数と[]の間に半角スペースを入れてはいけません。
配列の複数の要素を記述する場合、カンマで区切り、最後の要素にもカンマを加えます。
配列の複数の要素を記述する場合、インデントを揃えて記載しなければいけません。
```php
<?php
$array = [];
$array[] = 'sample_value';

$array = [
    'Pen',
    'Pineapple',
    'Apple',
];
```
6. コメント
6.1. 行コメント
行コメントは「//」を使用しなければいけません。
「//」とコメント本文の間には空白を一つ入れなければいけません。
コード行の最後に行コメントを入れる場合、コード部と「//」の間には空白を一つ入れなければいけません。
```php
<?php
// コメント１
$bar = $foo; // コメント２
```
6.2. ブロックコメント
ブロックコメントは「/* */」を使用しなければいけません。
ブロックコメントの開始「/」と終了「/」はそれぞれ単独の行でなければいけません。
ブロックコメント本文は「/* */」とインデントをそろえて記載しなければいけません。
通常のコメント用途にドキュメントブロック用の記述「/** */」を使用してはいけません。
```php
<?php
function bar() {
    /*
    ブロックコメント
    本文
    */
}
```
7. ドキュメントブロック
7.1. ファイル
ファイルのドキュメントブロックには、説明書きを必須とします。
```php
<?php
/**
 * ファイルの説明を記載
 *
 * 詳細なファイルの説明がある場合はここに記載
 */
class Ztr_Auth
{
    
}
```
7.2. クラス
クラスのドキュメントブロックには、説明書きを必須とします。
@author は不要です
```php
<?php
/**
 * クラスの説明を記載
 *
 * 詳細なクラスの説明がある場合はここに記載
 */
class Ztr_Auth
{
    
}
```
7.3. メソッド・関数
メソッド・関数のドキュメントブロックは、引数がある場合は@param タグにすべて記載しなければいけません。
それぞれのタグに記載する場合、型・変数名・説明のインデントはそろえるようにしなければいけません。
また、返り値がある場合は@returnタグに記載しなければいけません。
```php
<?php
/**
 * ここにメソッドの説明を記載します。
 * @param  string  $arg1   引数1の説明
 * @param  int     $arg2   引数2の説明
 * @return boolean         返り値の説明
 */
public function sampleTest($arg1, $arg2) {
    return (is_string($arg1) && is_numeric($arg2));
}
```
7.4. メンバ変数
メンバ変数は@varタグで変数の型を記載しなければいけません。
```php
<?php
/**
 * ここに変数の説明を記載します。
 * @var array
 */
$sampleTest = [];
```
小技 : PhpStormでアローした時に候補が出るようになる
```php
<?php
Class SampleTest 
{
    // ここで何のインスタンスか明示
    /** @var $sampleTestDao Common_Model_Dao_SampleTest() */
    private $sampleTestDao = null;
    
    public function _construct() {
        $this->sampleTestDao = new Common_Model_Dao_SampleTest();
    }
    
    public function execute() {
        // $this->_sampleTestDao-> の時点で候補が出るようになる
        $this->sampleTestDao->sampleMethod();
    }
}
```
9. エラー
9.1. 継承元と同名の関数を作成する場合、継承元と同じメソッド定義にする
異なる引数の数をもつメソッドを作成してはいけない
```php
class Parent 
{
    public function add($val1, $val2, $val3)
    {}
}

class Child extends Parent
{
    public function add($val1, $val2)
    {} //「must be compatible」とエラーが表示されます。
}
```
引数の型の指定が異なるメソッドを作成してはいけない
```php
class Parent 
{
    public function add(array $val1, array $val2)
    {}
}

class Child extends Parent
{
    public function add($val1, $val2)
    {} //「must be compatible」とエラーが表示されます。
}
```
返り値の型の指定が異なるメソッドを作成してはいけない
```php
class Parent 
{
    public function add($val1, $val2) : array
    {}
}

class Child extends Parent
{
    public function add($val1, $val2) :string
    {} // 「must be compatible」とエラーが表示されます
}
```
XX. その他
命名規則
ローマ字変換
日本語読みの単語のローマ字変換はヘボン式を用いる

http://hebonshiki-henkan.info/
https://codic.jp


### likeAjaxは、外部ファイルのため以下の通りに構成すること
■likeの総数を表示する
<span id="totalLikeNum_{{ $searchedWordResult[1][$i]['id'] }}" class="totalLikeNum totalLikeNum_{{ $searchedWordResult[1][$i]['id'] }}">
    <i class="fas fa-heart fa-sm"></i> <span>{{ $searchedWordResult[1][$i]['totalLikeNum'] }}</span>
</span>

構成
<span>
id="totalLikeNum_" + postId,
class ="totalLikeNum", "totalLikeNum_" + postId,

<i>
class="fas", "fa-heart", "fa-sm",

<span>
totalLike数

■visitorがいいね済みか判定
<button id="wordLike_{{ $searchedWordResult[1][$i]['id'] }}" class="like reset-button likeFlag_{{ $searchedWordResult[1][$i]['id'] }}" value="{{ $searchedWordResult[1][$i]['likeFlag'] }}">
    <span style="color: #F97855;"><i class="far fa-heart"></i>いいね!</span>
</button>

構成
<button>
id=cardType + "_" + postId,
class="like", "likeFlag_" + postId, 
value="0 or 1(likeFlag)",

<span>
style="color: #F97855",

<i>
class="far", "fa-heart",
    






