# Laravel Courses

This project is a simple, single-resource RESTful CRUD API for managing courses, and it is built on:

- PHP 8.2
- Laravel 9
- MySQL 8
- Doctrine ORM (instead of Eloquent)

## Configuring .env files

.env files are provided for both Docker Compose and Laravel, and must be
configured in order to boot up the project.

### For Docker Compose .env

From the repository root, run the following commands:

    cd docker
    cp .env.example .env

You can edit the newly-created `.env` file if you want.

### For Laravel .env

From the repository root, run the following commands:

    cd src
    cp .env.example .env

You should edit the newly-created `.env` file in order to match the Docker Compose
configuration.

## Booting up the project

A docker-compose.yml file is provided for development purposes only and can be used as follows:

    docker compose up -d

As soon as the containers are ready, an empty database named `laravel_courses` will be created.
Connect to the `php` container as follows:

    docker compose exec php bash

In the `php` container, run the following commands in order to install Composer dependencies, generate the
application key, and create the database schema:

    composer install
    php artisan key:generate
    php artisan doctrine:schema:create

In order to build the frontend (Swagger UI), run the following command:

    npm run build

Swagger UI will now be accessible at [http://localhost:8080](http://localhost:8080).

Once you are done using the API, bring down the containers like this:

    docker compose down
