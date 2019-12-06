## Description
Мини проект разделен на 
- пользовательскую часть (frontend) 
- административную часть (backend) 
- реализован контроль по роли при помощи Rbac
- в админки создаются категории, товар, есть фильтрации
- на пользовательской стороне просмотр товара, фильтрация по категориям, детальный просмотр товара
## Project Init

#### Install packages
```
composer install
```

#### Run Migrations
```
php yii migrate
php yii migrate --migrationPath=@yii/rbac/migrations

Запускаем миграцию для создания таблицы image в бд
php yii migrate/up --migrationPath=@vendor/costa-rico/yii2-images/migrations
```

#### Init RBAC
```
php yii rbac/init
```

## Admin User
```
Пользователь с id = 1 будет администратор
Пользователь с id = 2 будет менеджер
```