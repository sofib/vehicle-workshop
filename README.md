# Vehicle workshop

## Description
This repository is an example code demonstrating several coding principles and patterns but most importantly it obeys to the dependency rule, the beloved one!

The programing language used is PHP 7+.

## Running code
Code can run in following modes:
* as a docker executable
* as OpenFaaS function(s) within the PLONK stack
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

## Running single functions in a PLONK stack (via kind)
Prerequisites for this run are to have:
* docker
* kubectl
* kind
* faas-cli

A shell script `init_kind.sh` is available that sets up new kind cluster, builds and deploys functions.
After it's run is successful it may take few seconds until containers are ready, afterwards single functions can be executed by faas-cli or via some https client. Curl example:
```sh
curl http://127.0.0.1:31112/function/repair\?type=car
```


## Preinstalled PHP and the Composer
Navigate to the root of the repository, then run (assuming composer is in path and available as `composer`)
```sh
composer install
php ./entrypoint/cli/cli.php wash -t car
```
