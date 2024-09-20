# Laravel Rocket 3.0 へのアップグレードの手引き

## 概要

Laravel Rocket 3.0は、Laravel 11.xをベースにした新しいバージョンです。このバージョンでは、Laravel 6.xからLaravel 11.xへのアップグレードが行われていますが、それに伴い、アプリケーションも更新が必要です。

更新が必要な点は以下の通りです。

1. PHPのバージョンアップ
2. composer.json の更新
3. Trusted Proxy 周りの変更
4. Type declarations の追加


## PHPのバージョンアップ

Laravel Rocket 3.0 は PHP 8.2 以上をサポートしています。PHPのバージョンをアップグレードしてください。


## composer.json の更新

PHP、およびLaravelのバージョンアップに伴い、composer.json のバージョン指定も変更が必要です。本リポジトリのcomposer.jsonのアップデートを行ってください。具体的な変更差分は、以下のリンクを参照してください。

https://github.com/laravel-rocket/base/commit/13727cb1c0b42a2a0fac258ccf7494a7a151be70#diff-d2ab9925cad7eac58e0ff4cc0d251a937ecf49e4b6bf57f8b95aab76648a9d34

ただし上記リンクでは、Laravel Rocketの各パッケージのバージョンが @dev になっていますが、実際には "^3.0"を指定してください。

```
"laravel-rocket/foundation": "@dev",
"laravel-rocket/generator": "@dev",
"laravel-rocket/service-auth": "@dev",
```

正しくは以下の通りです。

```
"laravel-rocket/foundation": "^3.0",
"laravel-rocket/generator": "^3.0",
"laravel-rocket/service-auth": "^3.0",
```

## Trusted Proxy 周りの変更

Laravel Rocket 2.xでは fideloper/proxy を使っていましたが、これはもう必要がありません。composer.jsonから削除してください。
FoundationのTrusted Proxyの修正については、 https://laravel.com/docs/9.x/upgrade こちらを参照してください。

## Type declarations の追加

Laravel Rocket 3.0 では、Type declarations の追加が必要です。
実際には、Type declarations の追加はなくても PHP 8.3で動作しますが、Type declarations を追加することで、型の違いが実行時にもチェックされて問題を早期に発見できる他、IDEの補完機能が強化され、コードの品質が向上するため、追加をしています。

おそらく最も修正が必要な場所は、 /app/Repositories/Eloquent 内のファイルです。
例えば、旧バーじょうんで、以下のようになっていたとします。

```php
    public function getBlankModel()
    {
        return new AdminUser;
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

    protected function buildQueryByFilter($query, $filter)
    {
        return $query;
    }
```

これは以下の様に修正をしないと、実行時にエラーが発生します。

```php
    public function getBlankModel(): AdminUser
    {
        return new AdminUser;
    }

    public function rules(): array
    {
        return [
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }

    protected function buildQueryByFilter(\Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|Base $query, array $filter): \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|Base
    {
        return $query;
    }
```

Type declarationsについての詳細は https://www.php.net/manual/en/language.types.declarations.php こちらを参照してください。

本Baseリポジトリは、FoundationへのType declarationsの追加に伴う修正以外にもリポジトリ内で完結したコードにもType declarationsを追加しています。例えば/app/Services/ のインターフェイスにも追加されています。この修正は必須ではありませんが、これによりコード品質の向上が見込めますので、追加をお勧めします。
