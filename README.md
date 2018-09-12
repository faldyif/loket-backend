# Loket Backend Test

Backend of simple ticketing system made with Laravel, built for Loket Backend Code Assignment. Built with [TDD](http://agiledata.org/essays/tdd.html) approach.

## Installing

1. Clone this repository with git command on your working directory: `git clone https://github.com/faldyif/loket-backend.git`
2. Edit the .env.example file. Change the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME and DB_PASSWORD parameter as your database configuration.
3. Save the file as .env
4. Install the dependencies: `composer install --no-scripts`
5. Generate a random key with artisan command `php artisan key:generate`
6. Migrate the tables to database `php artisan migrate`
7. For symlinking the storage folder for file uploads, use: `php artisan storage:link`

## Running the server

```
$ php artisan serve
```

## Running the tests

```
$ vendor/bin/phpunit
```

## Endpoints

### Create new Location
```
[POST] /location/create
```
Params:
```
name // required, between: 5-100 chars
city // required
address // required
latitude // required, latitude
longitude // required, longitude
```

### Create new Event
```
[POST] /event/create
```
Params:
```
name // required, between: 5-100 chars
description // required, min: 10 chars
location_id // required, location id that has created before
start_at // required, date time
end_at // required, date time
```

### Create new Event Ticket Type
```
[POST] /event/create
```
Params:
```
quota // required, between: 5-100 chars
price // required, min: 10 chars
name // required, min: 10 chars
event_id // required, location id that has created before
```

### List Events
```
[GET] /event/get_info
```

### Create new Transaction Data
```
[POST] /transaction/create
```
Params:
```
customer // required, array, consists of name, email, phone, and address
event_id // required, between: 5-100 chars
location_id // required, event id that has created before
ticket_types // required, array, consists of collection array that has ticket_type_id, and quantity
```




## Built With

* [Laravel 5.6](https://laravel.com/docs/5.6) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management
* [PHPUnit](https://phpunit.de/) - Testing framework
