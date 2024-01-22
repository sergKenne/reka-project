###Требования

```
PHP 8.1
MySQL 5.7
```

###Настройка среды

```
copy .env.example .env

Настроить доступы к БД:
1. DB_CONNECTION
2. DB_HOST
3. DB_PORT
4. DB_DATABASE
5. DB_USERNAME
6. DB_PASSWORD
```

###Установка

```
composer install
php artisan key:generate
php artisan jwt:secret
php artisan storage:link
php artisan migrate:fresh --seed
php artisan l5-swagger:generate
```

###Запуск

```
php artisan serve
```

###Сборка приложения

```
yarn dev
yarn prod
```

###Папка фронта

```
resources\front
```

###Документация

```
http://127.0.0.1:8000/api/documentation
```
