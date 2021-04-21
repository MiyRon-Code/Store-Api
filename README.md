[![][stars-shield]][stars-url]
[![][contributors-shield]][contributors-url]
[![][issues-shield]][issues-url]


<br />
<p align="center">
  <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></a>
  </p>

  <h3 align="center">JSON API сервис интернет-магазина</h3>

  <p align="center">Краткая документацая по использованию API
посредством Postman
    <br />
    <a href="https://github.com/MiyRon-Code/Store-Api#readme"><strong>Ознакомиться с документацией »</strong></a>
    <br />
    <br />
    <a href="https://github.com/MiyRon-Code/Store-Api/issues">Сообщить об ошибке</a>
    ·
    <a href="https://github.com/MiyRon-Code/Store-Api/issues">Предложить идею</a>
  </p>
</p>

<details open="open">
  <summary>Содержание</summary>
  <ol>
    <li>
      <a href="#о-проекте">О проекте</a>
      <ul>
        <li><a href="#функционал">Функционал</a></li>
      </ul>
    </li>
    <li>
      <a href="#начало">Начало</a>
      <ul>
        <li><a href="#требования">Требования</a></li>
        <li><a href="#установка">Установка</a></li>
      </ul>
    </li>
    <li>
        <a href="#использование">Использование</a>
          <ul>
            <li><a href="#пользователи">Пользователи</a></li>
            <li><a href="#продавцы">Продавцы</a></li>
            <li><a href="#категории">Категории</a></li>
            <li><a href="#продукты">Продукты</a></li>
            <li><a href="#заказы">Заказы</a></li>
          </ul>
        </li>
    <li><a href="#контакты">Контакты</a></li>
  </ol>
</details>

<br>

# О проекте
<b>Store-Api</b> - это JSON API сервис интернет-магазина, реализованный посредством PHP (Laravel) и MySQL.

## Функционал
- Пользователи регистрируются самостоятельно через e-mail;
- Пользователи могут просматривать каталог товаров (название,
цена, наличие) по категориям и осуществлять заказ выбранных
позиций;
- Не авторизованные пользователи не могут осуществлять заказы;
- Пользователи имеют возможность производить поиск по
товарам;
- Приложение автоматически направляет e-mail уведомление
на почту при регистрации или новом заказе товара. 
- Раз в сутки в 00:00 все заказы подтверждаются
автоматически.

<br>

# Начало
Ниже приложена инструкция по установке проекта. Чтобы запустить локальную копию, следуйте этим простым примерам действий.

## Требования
- `PHP` версией [`7.4+`][3]
- [`Laravel`][1] ([`8+`][0] версия фреймворка) 
- [`Composer`][4]
- `MySQL` база данных
- Локальный сервер, на котором будет запускаться приложение [`Laravel`][1] (рекомендую [`xampp`][2], уже имеющий в пакете [`php`][3])

<br>

# Установка
После того как Вы настроили окружение, Вам нужно создать проект [`Laravel`][1]. Перейдите в директорию с проектами на Вашем локальном сервере. Если это [`xampp`][2], то директория называется `htdocs`. 

Путь до этой директории:

```
$ cd xampp\htdocs
```

Создание проекта:
```
$ laravel new name-your-project
```

Клонирование репозитория:
```
$ git clone https://github.com/MiyRon-Code/Store-Api.git
```
<br>
Замените все файлы из Вашего проекта на файлы Store-Api. Перетащите все файлы из Store-Api в папку Вашего проекта.

После замены файлов перейдите в файл конфигурации Apache - `httpd.conf`. 

Если Вы используете [`xampp`][2], файл конфигурации находится по следующему пути:
```
$ cd xampp\apache\conf
``` 
<br>

Откройте файл и замените `DocumentRoot` и `Directory` так, чтобы Apache мог найти точку входа `index.php` Вашего приложения [`Laravel`][1] 

```Apache config
DocumentRoot "C:/xampp/htdocs/name-of-your-project/public"
<Directory "C:/xampp/htdocs/name-of-your-project/public">
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
<br>

Теперь Вам необходимо настроить подключение к Вашей базе данных `MySQL`. 

Перейдите в директорию Вашего проекта:

```
$ cd name-your-project
```

Создайте базу данных с именем, например, `store-api`. Откройте файл `.env`. Введите название Вашей базы данных напротив `DB_DATABASE`, укажите пользователя со всеми правами и его пароль напротив `DB_USERNAME`, `DB_PASSWORD`:
```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=store-api
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
Теперь, когда у Вас есть подключение к базе данных, выполните установку пакета [`Sanctum`][5]: он нужен для авторизации. 

В директории Вашего проекта выполните команду:
```
$ composer require laravel/sanctum
```
Запустите локальный сервер и сервер базы данных.

Выполните миграции. Это создаст нужные таблицы в Вашей базе данных и установит отношения:
```
$ php artisan migrate
```
Заполните базу данных тестовыми данными:
```
$ php artisan db:seed
```
<br>

## Настройка отправки писем на почту
<i>  Вы можете пропустить этот шаг, если не планируете отправлять письма. </i>

В файле `.env` введите конфигурацию для подключения к smtp серверу для отправки писем. Вы можете использовать сторонние сервисы, например, [`mailtrap`][7] или [`gmail.smtp`][8]

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


Включите очередь для отправки писем:
```
$ php artisan queue:work
```

 Если Вам нужно отменить миграции, выполните команду:
```
$ php artisan migrate:reset
```

### На этом этапе установка и настройка приложения завершена.

<br>

# Использование
Выполняйте `http` запросы на адрес Вашего локального сервера посредством [`postman`][6] или другими аналогами.

<br>

## Пользователи
### Получение пользователей
<i>Ниже описаны все возможные способы получения пользователей.</i>

<br>

Получение всех пользователей:

>GET    `localhost:80/api/get/users` 

<br>

Получение всех пользователей, в том числе и "мягко удалённых":

>GET    `localhost:80/api/get/users/all` 

<br>

Получение пользователя по ID: 

>GET    `localhost:80/api/get/user/{user_id}` 

<br>

`Response JSON`
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

<br>

### Создание пользователя:


>POST    `localhost:80/api/create/user` 

<br>

`Request JSON`

```json
{
    "name": String,
    "email": String,
    "password": String
}
```

### Обновление пользователя:
>POST  `localhost:80/api/update/user/{user_id}` 

<br>

`Request JSON`

```json
{
    "name": String,
    "email": String,
    "password": String
}
```
<br>

### Удаление пользователей
<i>Ниже описаны все возможные способы удаления пользователей.</i>

<br>

Мягкое удаление пользователя (с возможностью восстановить):

>GET    `localhost:80/api/delete/user/{user_id}` 

<br>

`Response JSON`

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

<br>

Удаление пользователя (без возможности восстановить):

>GET    `localhost:80/api/destroy/user/{user_id}` 


<br>

### Получение токена авторизации:

>POST    `localhost:80/api/create/user/token`

<i>Необходимо указать password и email существующего пользователя.</i>


<br>

`Request JSON`


```json
{
    "email": String,
    "password": String
}
```

<br>

## Продавцы
### Получение продавцов
<i>Ниже описаны все возможные способы получения продавцов.</i>

<br>

Получение всех продавцов:
>GET    `localhost:80/api/get/sellers` 

<br>

Получение продавца по ID:

>GET    `localhost:80/api/get/seller/{seller_id}`

<br>

`Response JSON`

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

<br>

### Создание продавца:

>POST    `localhost:80/api/create/seller`

<br>

### Обновление продавца:

>POST    `localhost:80/api/update/seller/{seller_id` 

<br>

`Request JSON`

```json
{
    "name": String,
    "mail": String,
    "address": String,
    "phone_number": String
}
```

<br>

### Удаление продавцов
<i>Ниже описаны все возможные способы удаления продавцов.</i>

<br>

Мягкое удаление продавца  (с возможностью восстановить):

>GET    `localhost:80/api/delete/seller/{seller_id}` 

<br>

`Response JSON`

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

<br>

Удаление продавца  (без возможности восстановить):

>GET    `localhost:80/api/destroy/seller/{seller_id}` 

<br>

# Категории
### Получение категорий
<i>Ниже описаны все возможные способы получения категорий.</i>

<br>

Получение всех категорий:
>GET    `localhost:80/api/get/categories`

<br>

Получение категории по ID:
>GET    `localhost:80/api/get/category/{category_id}` 

<br>

`Response JSON`

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


### Создание категории

>POST    `localhost:80/api/create/category` 

<br>

### Обновление категории
    
>POST    `localhost:80/api/update/category/{category_id}` 


<br>

`Request JSON`

```json
{
    "code": String,    
    "name": String,
    "description": String
}
```

<br>


### Удаление категорий
<i>Ниже описаны все возможные способы удаления категорий.</i>

Мягкое удаление категории (с возможностью восстановить):
    
>GET    `localhost:80/api/delete/category/{category_id}` 

<br>

`Response JSON`

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

<br>

Удаление категории (без возможности восстановить):
    
>GET    `localhost:80/api/destroy/category/{category_id}`

<br>

# Продукты
### Получение продуктов
<i>Ниже описаны все возможные способы получения продуктов.</i>

<br>

Получение всех продуктов:
    
>GET    `localhost:80/api/get/products`

<br>


Получение всех продуктов по категории: 
>GET    `localhost:80/api/get/category/{category_id}/products` 

<br>


Получение продукта по ID: 
>GET    `localhost:80/api/get/product/{product_id}`

<br>

`Response JSON`

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

<br>

Создание продукта:
>POST    `localhost:80/api/create/product`

<br>

Обновление продукта:
>POST    `localhost:80/api/update/product`

<br>

`Request JSON`

```json
{
    "name": String,
    "category_id": Number,
    "description": String,
    "price": Number,
    "seller_id": Number
}
```

<br>

### Удаление продуктов
<i>Ниже описаны все возможные способы удаления продуктов.</i>

<br>

Мягкое удаление продукта (с возможностью восстановить):
>GET    `localhost:80/api/delete/product/{product_id}`

<br>

Мягкое удаление всех продуктов (с возможностью восстановить):
>GET    `localhost:80/api/delete/products`

<br>

Мягкое удаление всех продуктов по категории (с возможностью восстановить):
>GET    `localhost:80/api/delete/products/category/{category_id}`

<br>

Удаление продукта (без возможности восстановить):
>GET    `localhost:80/api/destroy/product/{product_id}`

<br>

Удаление всех продукты (без возможности восстановить):
>GET    localhost:80/api/destroy/products

<br>

Удаление всех продуктов по категории (без возможности восстановить):
>GET    `localhost:80/api/destroy/products/category/{category_id}`

<br>

<i>При удалении сущности все записи, связанные с данной сущностью, будут также удалены.</i>

<br>

# Заказы
## Авторизация
Работа с данными запросами требует `Токена Авторизации`. Это значит, что Вам нужно создать своего пользователя и получить токен авторизации. 

<br>

Создание своего пользователя:

>POST    `localhost:80/api/create/user` 

<br>

`Request JSON`

```json
{
    "name": String,
    "email": String,
    "password": String
}
```

<br>

Получение его `Токена Авторизации`:

>POST    `localhost:80/api/create/user/token`

<i>Необходимо указать password и email существующего пользователя.</i>

<br>

`Request JSON`

```json
{
    "email": String,
    "password": String
}
```

`Response JSON`

```json
{
    "token": "<your_token>"
}
```

<br>

Чтобы доказать Laravel, что Вы авторизованы, необходимо указать `Заголовок http запроса` `Authorization` с значением `Bearer <your_token>`. 

После этой процедуры Вы сможете получить доступ к запросам требующих авторизации.

<br>

### Получение заказов
<i>Ниже описаны все возможные способы получения заказов.</i>


<br>

Получение всех заказов:
>GET    `localhost:80/api/get/orders`

<br>

Получение заказов Вашего пользователя:
>GET    `localhost:80/api/get/my/orders`

<br>


Получение подтвержденных заказов: 
>GET    `localhost:80/api/get/orders/confirmed`

<br>

Получение неподтвержденных заказов: 
>GET    `localhost:80/api/get/orders/unconfirmed`

<br>

`Response JSON`

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

<br>

### Создание заказа:
>POST    `localhost:80/api/create/order/{product_id}`

<br>

`Response JSON`

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

<br>

### Обновление заказа:

>POST    `localhost:80/api/update/order/{order_id}`

<br>

`Request JSON`

```json
{
    "user_id": Number,
    "product_id": Number,
    "confirmed": Boolean
}
```

### Удаление заказов
<i>Ниже описаны все возможные способы удаления заказов.</i>

<br>


Мягкое удаление заказа (с возможностью восстановить):
>GET    `localhost:80/api/delete/order/{order_id}`

<br>

Мягкоt удаление заказов Вашего пользователя (с возможностью восстановить):
>GET    `localhost:80/api/delete/my/orders`

<br>

Мягкое удаление всех заказов (с возможностью восстановить):
>GET    `localhost:80/api/delete/orders`

<br>

Удаление заказа (без возможности восстановить):
>GET    `localhost:80/api/destroy/order/{order_id}`

<br>

Удаление заказов Вашего пользователя (без возможности восстановить): 
>GET    `localhost:80/api/destroy/my/orders`

<br>

Удаление все заказов (без возможности восстановить):
>GET    `localhost:80/api/destroy/orders`

<br>

# Контакты

Telegram [MiyRon][9]

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></a>
</p>



[stars-shield]: https://img.shields.io/github/stars/MiyRon-Code/Store-Api.svg?style=for-the-badge
[stars-url]: https://github.com/MiyRon-Code/Store-Api/stargazers
[contributors-shield]: https://img.shields.io/github/contributors/MiyRon-Code/Store-Api.svg?style=for-the-badge
[contributors-url]: https://github.com/MiyRon-Code/Store-Api/graphs/contributors
[issues-shield]: https://img.shields.io/github/issues/MiyRon-Code/Store-Api.svg?style=for-the-badge
[issues-url]: https://github.com/MiyRon-Code/Store-Api/issues

[php-shield]: https://img.shields.io/github/issues/MiyRon-Code/Store-Api.svg?style=for-the-badge

[0]: https://laravel.com/docs/8.x
[1]: https://laravel.com/
[2]:https://www.apachefriends.org/ru/index.html
[3]:https://www.php.net/downloads
[4]:https://getcomposer.org/ 
[5]:https://laravel.com/docs/8.x/sanctum
[6]:https://www.postman.com/
[7]:https://blog.mailtrap.io/send-email-in-laravel/
[8]:https://support.google.com/a/answer/176600?hl=ru
[9]:https://t.me/M_MiyRon
