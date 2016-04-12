
. laravel new panniversary

. composer config repo.packagist composer https://packagist.phpcomposer.com
. composer self-update
. composer update

. composer require tremby/laravel-db-shell-command
. app.php/providers: Tremby\DbShellCommand\ServiceProvider::class,

. composer require intervention/image
. php artisan vendor:publish
. aliases: 'Image' => Intervention\Image\Facades\Image::class,
. app.php/providers: 'Illuminate\Html\HtmlServiceProvider',

. composer require frozennode/administrator
. php artisan vendor:publish
. app.php/providers: 'Frozennode\Administrator\AdministratorServiceProvider'

. config .env

. config app.php
. 'timezone' => 'Asia/Shanghai'

. php artisan serve [--port 8080]

. php artisan make:model Item -m
. edit ./database/migrations/xxx_create_yyy
. php artisan migrate
