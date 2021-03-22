# demo-laravel-vue

## Features

- Custom Eloquent
- Unit Tests
- News has only three tags
- News has unique slug use title field
- Tag has unique slug
- Tag's relations removed when Tag or News has been deleted

## [Demo Video](https://bit.ly/31b8dat)

## From Laravel

NOTE: Spa's part of the application has been compiled and put to the public/spa folder. 
Therefore It's already ready for using. You need only run application. 
Please use next commands for it.


`cd laravel`

`composer install`

- Config connect to DB

`php artisan migrate --seed`

- Run application

### !important

If you will use `php artisan serve` command
Use only **Spa** link in **Spa menu**

- Then use Spa's menu

## From vue development

`cd vue`

- Set `VUE_APP_BASE_API` variable in `.env.development` for getting data by REST from backend

`npm i`

`npm run dev`



