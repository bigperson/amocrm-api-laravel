<?php
/**
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Авторизация в системе amoCRM
    |--------------------------------------------------------------------------
    |
    | Эти параметры необходимы для авторизации в системе amoCRM.
    | - Поддомен компании. Приставка в домене перед .amocrm.ru;
    | - Логин пользователя. В качестве логина в системе используется e-mail;
    | - Ключ пользователя, который можно получить на странице редактирования
    |   профиля пользователя.
    |
    */

    'domain' => env('AMO_DOMAIN', 'domain'),
    'login'  => env('AMO_LOGIN', 'user@domain.com'),
    'hash'   => env('AMO_HASH', ''),
];