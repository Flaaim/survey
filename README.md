# Тестовое задание

1. Скачать
```
    git clone git@github.com:Flaaim/survey.git
```
2. Установить зависимости
```
    cd survey
    composer install
```
3. Установить данные для доступа к БД
```
//Коннект к базе данных. файл db.php
    'dsn' => 'mysql:host=127.0.0.1;dbname=survey',
    'user' => 'root',
    'password' => '',
// Миграции файл. phinx.php
    'development' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'survey',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
```
3. Выполнить миграции
```
    php ./vendor/bin/phinx migrate -e development
```