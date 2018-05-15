# AmoCRM API Laravel Bridge
![amoCRM](https://raw.githubusercontent.com/bigperson/amocrm-api-laravel/master/assets/logo.png)

[![Latest Stable Version](https://poser.pugx.org/bigperson/amocrm-api-laravel/v/stable)](https://packagist.org/packages/bigperson/amocrm-api-laravel)
[![Build Status](https://travis-ci.org/bigperson/amocrm-api-laravel.svg?branch=master)](https://travis-ci.org/bigperson/amocrm-api-laravel)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bigperson/amocrm-api-laravel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bigperson/amocrm-api-laravel/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/bigperson/amocrm-api-laravel/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bigperson/amocrm-api-laravel/?branch=master)
[![License](https://poser.pugx.org/bigperson/amocrm-api-laravel/license)](https://packagist.org/packages/bigperson/amocrm-api-laravel)
[![StyleCI](https://styleci.io/repos/133466152/shield?branch=master)](https://styleci.io/repos/133466152)

# Описание
Данный пакет это ServiceProvider для Laravel 5 предоставляющий интеграцию с API amoCRM используя библиотеку [linkprofit-cpa/amocrm-api](https://github.com/linkprofit-cpa/amocrm-api). Пакет позволяет зарегистрировать все сервисы из родительской библиотеки для использования сервисов через DI, без необходимости создавать каждый раз RequestHandler.

## Установка

### Laravel 5.5+

> Убедитесь, что используете хотя бы PHP 7.1

- `composer require bigperson/amocrm-api-laravel`
- `php artisan vendor:publish --tag=amocrm-api`

### Laravel 5.4 или ранее

- `composer require bigperson/amocrm-api-laravel`
- Добавьте сервис провайдер в ваш `app/config/app.php` файл:
```php
'providers' => [
    // ...
    Bigperson\AmoCrmApi\AmoCrmApiServiceProvider::class,
]
```

- `php artisan vendor:publish --tag=amocrm-api`

Пакет требует указания параметров подключения к API amoCRM. Указать их можно в файле конфигурации. Для этого необходимо опубликовать файл конфигурации.

Эта команда создаст файл config/amocrm-api.php в котором указаны эти данные. Лучше всего использовать переменные окружения добавив файл `.env`
```
AMO_DOMAIN=domain
AMO_LOGIN=email@examle.com
AMO_HASH=RfwPKjHdlNC5UFrB2F8NRfwPKjHdlNC5UFrB2F8N
```

## Использование
После установки пакета вы можете использовать все сервисы через DI контейнер Laravel:
```
...
use linkprofit\AmoCRM\services\CatalogElementService;
...

class Controller extends BaseController
{
    public function getCatalogElements(CatalogElementService $service)
    {
        $catalogElements = $service->lists();
        dd($catalogElements);
    }
}
```

Более подробнее о возможностях сервисов и документацию по ним вы найдете в описании пакета [linkprofit-cpa/amocrm-api](https://github.com/linkprofit-cpa/amocrm-api).

## Лицензия

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details
