# Laravel Courses

This project is a simple, single-resource RESTful CRUD API for managing courses, and it is built on:

- PHP 8.2
- Laravel 9
- MySQL 8
- Doctrine ORM (instead of Eloquent)

## Booting up the project

A docker-compose.yml file is provided for development purposes only and can be used as follows:

    docker compose up -d

As soon as the containers are ready, an empty database named `laravel_courses` will be created. You can
SSH into the container which runs PHP as follows:

    docker compose exec php bash

In the `php` container, run the following commands in order to install Composer dependencies, generate the
application key, and create the database schema:

    composer install
    php artisan key:generate
    php artisan doctrine:schema:create
