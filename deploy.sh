#!/bin/sh

## Check first argument (can either be dev or prod)
if [ -z "$1" ]
    then
        printf "No argument supplied! (Supply either \"dev\" or \"prod\" \n"
        exit 1
    else
        if [ $1 != "prod" ]
            then
                if [ $1 != "dev" ]
                    then
                        printf "Invalid argument \"$1\" \n"
                        exit 1
                fi
        fi
fi

## Set symfony environment variable
export SYMFONY_ENV=$1


## Pull the master branch
printf "Pulling master branch...\n"
git pull origin master


## Composer install
if [ -e "composer.phar" ] && [ $1 = "prod" ]
    then
        printf "\n\nComposer install...\n"
        php composer.phar install --no-dev
    else
        php composer.phar install
fi


## Clear production cache
printf "\n\nClearing production cache...\n"
php bin/console cache:clear --env=prod

## Dump out new class map
if [ -e "composer.phar" ]
    then
        printf "\n\nBuilding new optimized class map...\n"
        php composer.phar dump-autoload --optimize
fi


## Success message
printf "\n\nSuccessfully deployed new version!\n"