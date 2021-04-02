#Начало
Прежде всего у вас должна быть установлена [`8+`][0] версия фреймворка [`Laravel`][1]. Вам также необходимы база данных `mySql` и локальный сервер   на котором вы будете запускать приложение [`Laravel`][1]. Я рекомендую использовать [`xampp`][2] обратите внимание что `php` должен быть версией выше [`7.4+`][3] обычно [`xampp`][2] уже имеет в пакете [`php`][3] поэтому вам не нужно беспокоиться. Также вам понадобиться [`Composer`][4].

#Установка
После того как вы настроили окружение вам нужно создать проект [`Laravel`][1]. Перейдите в директорию с проектами в вашем локальном сервере. Если это [`xampp`][2] то директория называется `htdocs` путь до этой директории 

```
$ cd xampp\htdocs
```

Создайте проект
```
$ laravel new name-your-project
```

Склонируйте мой репозиторий
```
$ git clone https://github.com/MiyRon-Code/Store-Api.git
```
Замените все файлы из вашего проекта на файлы Store-Api. (Перетащите все файлы из Store-Api в папку вашего проекта)

После замены файлов перейдите в файл конфигурации Apache `httpd.conf`. Если вы используете [`xampp`][2] файл конфигурации находится по следующему пути
```
$ cd xampp\apache\conf
``` 
Откройте файл и замените `DocumentRoot` и `Directory` чтобы Apache мог найти точку входа `index.php` вашего приложения [`Laravel`][1] 
```Apache config
DocumentRoot "C:/xampp/htdocs/name-your-project/public"
<Directory "C:/xampp/htdocs/name-your-project/public">
    #
    # Possible values for the Options directive are "None", "All",
    # or any combination of:
    #   Indexes Includes FollowSymLinks SymLinksifOwnerMatch ExecCGI MultiViews
    #
    # Note that "MultiViews" must be named *explicitly* --- "Options All"
    # doesn't give it to you.
    #
    # The Options directive is both complicated and important.  Please see
    # http://httpd.apache.org/docs/2.4/mod/core.html#options
    # for more information.
    #
    Options Indexes FollowSymLinks Includes ExecCGI

    #
    # AllowOverride controls what directives may be placed in .htaccess files.
    # It can be "All", "None", or any combination of the keywords:
    #   AllowOverride FileInfo AuthConfig Limit
    #
    AllowOverride All

    #
    # Controls who can get stuff from this server.
    #
    Require all granted
</Directory>
```
После того как вы указали точку входа вашего приложения вам необходимо настроить подключение к вашей базе данных `mySql` для этого перейдите в директорию вашего проекта

```
$ cd name-your-project
```
Откройте файл `.env`
Настройте подключение к вашей базе данных. Перед этим создав базу с именем например `store-api` ( имя на ваше усмотрение ). Напишите название вашей базы данных напротив `DB_DATABASE`, укажите пользователя со всеми правами и его пароль напротив `DB_USERNAME`, `DB_PASSWORD`
```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=store-api
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
Теперь когда у вас есть подключение к базе данных 
выполните установку пакета [`Sanctum`][5] он нужен для авторизации. В директории вашего проекта выполните команду 
```
$ composer require laravel/sanctum
```
Запустите локальный сервер и сервер базы данных.

Выполните миграции. Это создаст нужные таблицы в вашей базе данных и установит отношения.
```
$ php artisan migrate
```
Заполните базу данных тестовыми данными
```
$ php artisan db:seed
```

######Настройка отправки писем на почту ( можете пропустить этот шаг если не хотите отправлять письма )

В файле `.env` напишите конфигурацию для подключения к smtp серверу для отправки писем. Вы можете использовать сторонние сервисы например [`mailtrap`][7] или [`gmail.smtp`][8]

```
MAIL_MAILER=smtp
MAIL_HOST=<your_host>
MAIL_PORT=<your_post>
MAIL_USERNAME=<your_username>
MAIL_PASSWORD=<your_password>
MAIL_ENCRYPTION=<your_encr>
MAIL_FROM_ADDRESS=<your_address>
MAIL_FROM_NAME="${APP_NAME}"

```


Включите очередь для отправки писем
```
$ php artisan queue:work
```

######Если вам нужно отменить миграции выполните команду 
```
$ php artisan migrate:reset
```

Отлично! Теперь всё готово к работе. 

#API - как использовать?
Выполняйте `http` запросы на  адрес вашего локального сервера средствами [`postman`][6] или другими аналогами.

##User
Получить всех пользователей

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/users</span> 

Получить всех пользователей в том числе и "мягко удалённых"

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/users/all</span> 

Получить пользователя по id 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/user/{user_id}</span> 

`response json`
```json
  {
    "id": Number,
    "name": String,
    "email": String,
    "email_verified_at": String DateTime,
    "created_at": String DateTime,
    "updated_at": String DateTime,
    "deleted_at": String DateTime
  }
```

Создать нового пользователя 

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/create/user</span> 

`request json`

```json
{
    "name":String,
    "email":String,
    "password": String
}
```


Получить токен авторизации

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/create/user/token</span> 

`request json`
`необходимо указать password и email существующего пользователя`

```json
{
    "email":String,
    "password": String
}
```

Обновить данные пользователя

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/update/user/{user_id}</span> 

`request json`

```json
{
    "name":String,
    "email":String,
    "password": String
}
```
Мягко удалить пользователя ( с возможностью восстановить )

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/user/{user_id}</span> 

`response json`

```json
{
    "id": Number,
    "name": String,
    "email": String,
    "email_verified_at": String DateTime,
    "created_at": String DateTime,
    "updated_at": String DateTime,
    "deleted_at": String DateTime,
}
```

Удалить пользователя ( без возможности восстановить )

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/user/{user_id}</span> 

##Seller

Получить всех продавцов

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/sellers</span> 

Получить  продавца по id

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/seller/{seller_id}</span>

`json response`

```json
{
    "id": Number,
    "name": String,
    "mail": String,
    "address": String,
    "phone_number": String,
    "created_at": String DateTime,
    "updated_at": String DateTime,
    "deleted_at": String DateTime
  }
```
Создать продавца

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/create/seller</span> 

Обновить данные продавца

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/update/seller/{seller_id}</span> 

`request json`

```json
{
    "name": String,
    "mail": String,
    "address": String,
    "phone_number": String
}
```

Мягко удалить продавца  ( с возможностью восстановить )

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/seller/{seller_id}</span> 

`response json`

```json
{
  "id": Number,
  "name": String,
  "mail": String,
  "address": String,
  "phone_number": String,
  "created_at": String DateTime,
  "updated_at": String DateTime,
  "deleted_at": String DateTime
}
```

Удалить продавца  ( без возможности восстановить )

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/seller/{seller_id}</span> 

#Category

Получить все категории

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/categories</span> 

Получить категорию по id 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/category/{category_id}</span> 

`response json`

```json
{
    "id": Number,
    "code": String,
    "name": String,
    "created_at": String DateTime,
    "updated_at": String DateTime,
    "deleted_at": String DateTime
},
```

Получить продукты категории по id 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/category/{category_id}/products</span> 

`response json`

```json
{
    "id": Number,
    "name": String,
    "description": String
    "price": Number,
    "category_id": Number,
    "seller_id": Number,
    "created_at":  String DateTime,
    "updated_at":  String DateTime,
    "deleted_at":  String DateTime,
},
```

Создать категорию

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/create/category</span> 

Обновить категорию
    
<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/update/category/{category_id}</span> 


`request json`

```json
{
    "code": String,    
    "name": String,
    "description": String
}
```

Мягко удалить категорию ( с возможностью восстановить )
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/category/{category_id}</span> 

`response json`

```json
{
    "id": Number,
    "code": String,
    "name": String,
    "created_at": String DateTime,
    "updated_at": String DateTime,
    "deleted_at": String DateTime,
}
```

Удалить категорию ( без возможности восстановить )
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/category/{category_id}</span>

#Product

Получить все продукты
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/products</span>

Получить продукт по id 
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/product/{product_id}</span>

`response json`

```json
{
    "id": Number,
    "name": String,
    "description": String,
    "price": Number,
    "category_id": Number,
    "seller_id": Number,
    "created_at": String DateTime,
    "updated_at": String DateTime,
    "deleted_at": Boolean
}
```

Создать продукт  
    
<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/create/product</span>

Обновить продукт  
    
<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/update/product</span>

`request json`

```json
{
    "name":String,
    "category_id": Number,
    "description": String,
    "price": Number,
    "seller_id": Number
}
```
Мягко удалить продукт по id ( с возможностью восстановить ) 
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/product/{product_id}</span>

Мягко удалить все продукты ( с возможностью восстановить )
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/products</span>

Мягко удалить все продукты по id категории ( с возможностью восстановить )
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/products/category/{category_id}</span>

Удалить продукт по id ( без возможности восстановить ) 
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/product/{product_id}</span>


Удалить все продукты ( без возможности восстановить )
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/products</span>

Удалить все продукты по id категории ( без возможности восстановить )
    
<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/products/category/{category_id}</span>

`при удалении сущности все записи связанные с данной сущностью будут также удалены`

#Order
###авторизация
Работа с данными запросами требует `Токена Авторизации` это значит что вам нужно создать своего пользователя и получить токен авторизации. 

Создать своего пользователя

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/create/user</span> 

`request json`

```json
{
    "name":String,
    "email":String,
    "password": String
}
```

Получить его `Токен Авторизации`

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/create/user/token</span>

при запросе нужно указать `email` и `password` вашего пользователя

`request json`

```json
{
    "email":String,
    "password": String
}
```

`response json`

```json
{
    "token": "<your_token_here>"
}
```
Что бы доказать Laravel что вы авторизованы необходимо указать `Заголовок http запроса` `Authorization` с значением `Bearer <your_token_here>` после этой процедуры вы сможете получить доступ к запросам требующих авторизации

Получить все заказы

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/orders</span>

Получить заказы вашего пользователя

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/my/orders</span>


Получить подтвержденные заказы 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/orders/confirmed</span>

Получить  не подтвержденные заказы 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/get/orders/unconfirmed</span>

`response json`

```json
{
    "id": Number,
    "code": String,
    "product_id": Number,
    "user_id": Number,
    "confirmed": Number,
    "created_at": String DateTime,
    "updated_at": String DateTime,
    "deleted_at": String DateTime
},
```

Создать заказ

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/create/order/{product_id}</span>

`response json`

```json 
{
    "code": String,
    "product_id": Number,
    "user_id": Number,
    "confirmed": Boolean,
    "updated_at": String DateTime,
    "created_at": String DateTime,
    "id": Number
}
```

Обновить заказ

<span style="color:white; background-color:#3300FF; padding:5px 10px; border-radius: 3px 0px 0px 3px;">POST</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/update/order/{order_id}</span>

`request json`

```json
{
    "user_id": Number,
    "product_id": Number,
    "confirmed": Boolean
}
```


Мягко удалить заказ ( с возможностью восстановить ) 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/order/{order_id}</span>

Мягко удалить заказы вашего пользователя ( с возможностью восстановить ) 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/my/orders</span>

Мягко удалить все заказы ( с возможностью восстановить ) 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/delete/orders</span>

Удалить заказ ( без возможности восстановить ) 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/order/{order_id}</span>

Удалить  заказы вашего пользователя ( без возможности восстановить ) 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/my/orders</span>

Удалить все заказы ( без возможности восстановить ) 

<span style="color:white; background-color:#EF002A; padding:5px 10px; border-radius: 3px 0px 0px 3px;">GET</span><span style="color:white; background-color:#26262B; padding:5px; border-radius: 0px 3px 3px 0px; letter-spacing: 2px">localhost:80/api/destroy/orders</span>

#Контакты


<a target="_blank" style="display:flex; align-items:center;" href="https://t.me/M_MiyRon"><img src="https://roi4cio.com/uploads/roi/company/Telegram_LLC_Logo.png" style="width:30px; height:30px; margin: 5px;"> MiyRon</a>

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></a>
</p>



[0]: https://laravel.com/docs/8.x
[1]: https://laravel.com/
[2]:https://www.apachefriends.org/ru/index.html
[3]:https://www.php.net/downloads
[4]:https://getcomposer.org/ 
[5]:https://laravel.com/docs/8.x/sanctum
[6]:https://www.postman.com/
