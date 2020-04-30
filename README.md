# Vehicle workshop

## Description
This repository is an example code demonstrating several coding principles and patterns but most importantly it obeys to the dependency rule. The beloved one!

The programing language used is PHP 7+.

## Requirements
There are 2 ways code can be used:
* via Docker (recommended)
* on a machine that has PHP 7+ and the Composer installed.

## Running via Docker
Build docker image from the root of the cloned repository using for example:
```sh
docker build -t workshop .
```
Next, you can use built image as an executable, for example:
```sh
docker run --rm workshop wash -t car
```

## Preinstalled PHP and the Composer
Navigate to the root of the repository, then run (assuming composer is in path and available as `composer`)
```sh
composer install
php ./src/Delivery/cli.php wash -t car
```
