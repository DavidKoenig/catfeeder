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

if [ $1 = "prod" ]
    then
        # composer install takes care of cache cleaning
        printf "\n\nComposer install...\n"
        composer install --no-dev --optimize-autoloader

        printf "\n\Dump assetic...\n"
        php bin/console assetic:dump --env=prod --no-debug
    else
        printf "\n\nComposer install...\n"
        composer install
fi

printf "\n\nUpdating database...\n"
php bin/console doctrine:schema:update --force

printf "\n\nBuilding new optimized class map...\n"
composer dump-autoload --optimize

## Success message
printf "\n\nSuccessfully deployed new version!\n"