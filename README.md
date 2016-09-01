catfeeder
=========
Software for an automatic web-controlled cat feeder built with RaspberryPi. 

# What is this and why?
Some cat owners (mostly with flat-only cats) know the problem: You are one or two days not at home. 
Your cat has enough water, enough toilets with sand filled, etc., but when your cat sees food it will eat it immediately. 
In many countries you just get a programmable cat feeder with day and time setting, but you get no chance to connect it 
anywhere and build your own interface.

This is a tutorial with software how to build your own automatic cat feeder controlled via a web interface.
It is build with simple materials/ stuff that is simple available and cheap. You will need a little understand in electronic circles,
Raspberry Pi and manual work. In other words, you need a leaning to be a maker.

# How does it work?

This cat feeder is located in a self-made wood-box and in it is a meat chopper without blades, that holds dry food for cats.
The meat chopper is plugged in a wireless socket which gets controlled by a Raspberry Pi. The Pi sets the wireless socket
on and off in a time that you can control via the web interface, so that you can portioning it. In the box there is a
hole where the food drops out. If you install the light barrier there is another hole where the cat can put something in, e.g. 
a textile mouse, to get food reward.

# What do you need?

- a Raspberry Pi - I reference in this tutorial to the Raspberry Pi B+
- a simple meet chopper, where you can remove the blades
- a 433 MHz transmitter, connectable to the Pi
- a wireless socket, where you can set the unit and channel code by your own
- if you want to use the light barrier, a breadboard and a IR sending and receiving diode, some resistors and cable

The total amount is about 100€ (in Germany), depending on your country's prices.

# How to build
## Electronic stuff

## Wood box
# Connect to the internet

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
But don't be afraid, it's all wrapped in a single bash script on which *www-data* has access. 
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



