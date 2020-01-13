#  Evertec exam

This project is the solution to an exam test for Lead Developer.

A basic eCommerce with payment platform integration.

## Requirements 
- docker 
- docker-compose

You can install docker [Here](https://docs.docker.com/install/)

## Clone project
```
git clone git@github.com:apolo96/evertec-exam.git && cd evertec-exam/
```

## Setup Instructions

These instructions assume OSX or Linux development environment. This project uses docker, which can be a bit quirky on Windows machines.


### Run app services

```
docker-compose up -d
```

### Install dependencies

```
docker exec --user www -it app composer install
```

### Generate key app

Enter in the `app` docker container. 

```
docker exec --user www -it app bash
```

Once inside the container,

Copy dev environment file. 

``` 
cp .env.dev .env 
``` 

And type this command:

```
php artisan key:generate
```

### Run database migrations

on the `app` container type this command.

```
php artisan migrate
```
Then exit container.

### Set ownership permission

Enter in the `app` docker container as the root user.

```
docker exec --user root -it app bash
```

Once inside container, type following commands:

```
chown -R $USER:www-data storage
chown -R $USER:www-data bootstrap/cache
```

And set permissions to the directory.
```
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

Now, open the browser on `127.0.0.1`

You should see the available and functional app.

### Run suite test

```
/vendor/bin/phpunit
```
