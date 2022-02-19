# About 

Create a single page application that uses the database provided (SQLite 3) to list and
categorize country phone numbers.\
Phone numbers should be categorized by country, state (valid or not valid), country code and
number.\
The page should render a list of all phone numbers available in the DB. It should be possible to
filter by country and state. Pagination is an extra.
----------

# Getting started

## Prerequisites

- [Composer](https://getcomposer.org/)
- [Laravel: ^8.75](http://laravel.com/)
- [SQlite](https://sqlite.org) and libsqlite3-dev
- [PHP: ^7.3|^8.0](https://www.php.net/)
- PHP Extensions (pdo, zip, curl, and sqlite)

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/mnourrhan/phone-number-validator.git

Switch to the repo folder

    cd phone-number-validator

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run all tests

    vendor/bin/phpunit

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/mnourrhan/phone-number-validator.git
    cd phone-number-validator
    composer install
    cp .env.example .env
    php artisan key:generate
    vendor/bin/phpunit
    php artisan serve
