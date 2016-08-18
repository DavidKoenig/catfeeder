cat-feeder
=========
Software for a cat feeder built with RaspberryPi. 

# How to Install
## Dependencies
First install these packages to your raspbian:
- apache2
- php5, php5-pgsql, curl, php5-cli
- postgresql
- composer

## Clone Repository
Clone this repository to `/var/www/html/`

## Create database
Create a database, e.g. *catfeeder* (you will be later asked about the name and credentials and when executing `composer install`)

## Set rights
##### bash script
Because of the usage of the [Raspberry Pi Remote library](https://github.com/xkonni/raspberry-remote.git) the python scripts in this project need sudo rights. 
But doen't be afraid, it's all wrapped in a single bash script on which *www-data* has access. 
But we need to make it accessible for *www-data*.

To do so add the following at the end of `/etc/sudoers`:
 
    www-data ALL=NOPASSWD:/var/www/html/cat-feeder/app/Resources/pi/catfeeder-sudo-script.sh

Furthermore if something doesn't work with the deploy script you have to add the user *pi* to *www-data* with `sudo usermod -a -G www-data pi`' 

## Deploy
You have to do the following steps to deploy the:

- create a file named `cat-feeder.conf` in `/etc/apache2/conf-available` and write the following in it:
    ```
    Alias /cat-feeder "/var/www/html/cat-feeder/web/"
    <Directory "var/www/html/cat-feeder/web">
        Options +FollowSymLinks
        AllowOverride All
    </Directory>
    ```
- enable the config with `sudo a2ensite cat-feeder.conf`
- activate the apache url rewrite module with `sudo a2enmod rewrite`
- finally launch the deploy script in with `bash /var/www/html/cat-feeder/delpoy.sh prod`



