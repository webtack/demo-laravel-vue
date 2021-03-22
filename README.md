# demo-laravel-vue

The News portal who use Laravel framework as backend and Vue framework as frontend.

## Tested by
- PHP7.1
- MYSQL 5.7
- Laravel 5.8
- Vue 2.6

## Features

- Custom Eloquent
- Unit Tests
- Each news has unique slug field based on title field
- News's slug defines auto
- Each news can have only three tags
- Each tag can have only unique slug
- Tag's slug defines by user
- Related links to tag will auto remove when tag or news has been deleted

## [Demo Video](https://bit.ly/31b8dat)

## From Laravel

**NOTE:** Spa's part of the application has been compiled and put to the `public/spa` folder. 
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

## From docker

`docker-compose up --build`

`docker exec dlv_app composer install`

`docker exec dlv_app cp .env.docker .env`

`docker exec dlv_app php artisan migrate --seed`

#### Let's go to `localhost:8080`

#### Spa news list `localhost:8080/spa/news/list`
#### Spa tag list `localhost:8080/spa/tag/list`


## From vue development

`cd vue`

- Set `VUE_APP_BASE_API` variable in `.env.development` for getting data by REST from backend

`npm i`

`npm run dev`



