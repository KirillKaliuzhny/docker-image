# Site in Docker
## Введение
Данная сборка рассчитана на оперативное развертывание легковесных и не очень сайтов. Находится в разработке.
## Уже реализовано
 - Работа с laravel 11.x версии на основе php:8.3
    - Поддержка MariaDB
    - Поддержка Microsoft SQL Server
    - Поддержка Postgres
## Настройка
### Microsoft SQL Server Laravel
Переменные для подключения уже прокинуты в контейнер, их нужно лишь указать:  
Файл .env
```.env
DB_CONNECTION=${DB_CONNECTION}
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}
```

Далее для работы необходимо внести правки в config/database.php  
```php
 'connections' => [
    ...
    'sqlsrv' => [
        ...
        'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'true'),
        'options' => [
            'ConnectionPooling' => 'true'
        ]
    ],
 ]
```
На данном этапе отключается проверка сертификата и в опциях задается значение, ускоряющее взаимодействие в БД.
## В планах
1. Расширить документацию по репозиторию
2. Реализация работы с фронтендом, как отдельным сервисом(Vue, React)
3. Проверка работы php-фреймворков(Yii)
4. Реализация работы с Python на бекенде