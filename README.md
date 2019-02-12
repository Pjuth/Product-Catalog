# Product Catalog
Laravel project 

## Description

Simple product catalog application with basic management and price calculation capabilities.

## Features

- Administration area

    - Ability to authenticate with email and password.
    - Ability to view product list.
    - Ability to view, create, edit, delete product, upload image.
    - Ability to view, submit and delete product review.
    - Ability to set basic application configuration: global discount, tax rate and its inclusion in price.
    
- Frontend area

    - Ability to view product list.
    - Ability to view single product.
    - Ability to view and submit reviews.

## Getting started

### Installation

Clone the repository

    git clone git@github.com:Pjuth/Product-Catalog.git

Switch to the repo folder

    cd Product-Catalog

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations and seeds (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## Authentication

Ir you have seeded database, there is user created for testing purposes with credentials:

    email: info@info.lt
    password: secret