catfeeder
=========
Software for an automatic web-controlled cat feeder built with RaspberryPi. 

# What is this and why?
Some cat owners (mostly with flat-only cats) know the problem: You are one or two days not at home. 
Your cat has enough water, enough toilets with sand filled, etc., but when your cat sees food it will eat it immediately. 
In many countries you just get a programmable cat feeder with day and time setting, but you get no chance to connect it 
anywhere and build your own interface.

This is a tutorial with software how to build your own automatic cat feeder controlled via a web interface.
It is build with simple materials/ stuff that is simple available and cheap. You will need a little understand in electronic circuits,
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
- jumper cables

### For the light barrier
- a breadboard
- a IR emitting and receiving diode
- two 470 Ohm resistor
- one 10k Ohm resistor

The total amount is about 100€ (in Germany), depending on your country's prices.

# How to build
## Electronic stuff

### Wiring diagram

[[https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/wiring-diagram.png|alt=wiring-diagram]]

####Legend
- red: +
- black: -
- blue: data cables
- pin 17: data of 433MHz transmitter
- pin 18: data of the IR receiver

The 433MHz transmitter (in the left) is symbolic as text and symbolic on the breadboard. You should connect it
directly to the Pi via jumper cables.

If you just want the feed function without light barrier, you only have to connect the 433MHz transmitter.
For using the light barrier function connect also the stuff on the right side of the breadboard as shown in the wiring plan. 

## Wood box
Will be edited soon...

# How to Install
##### Dependencies
First install these packages to your raspbian:
- apache2
- php5, php5-pgsql, php5-cli
- curl
- postgresql
- composer

##### Clone Repository
Clone this repository to `/var/www/html/`. 

##### Create database
Create a database, e.g. *catfeeder* (you will be later asked about the name and credentials and when executing the deploy script)

##### Install project dependencies
Run `composer install` from the root directory of the project

## Set permissions
##### Bash script
Because of the usage of the [Raspberry Pi Remote library](https://github.com/xkonni/raspberry-remote.git) the python scripts in this project need sudo rights. 
But don't be afraid, it's all wrapped in a single bash script on which *www-data* has access and the command for executing this script is hardcoded. 
But we need to make it accessible for *www-data*.

To do so add the following at the end of `/etc/sudoers`:
 
    www-data ALL=NOPASSWD:/var/www/html/cat-feeder/app/Resources/pi/catfeeder-sudo-script.sh

##### Python scripts
Please make sure, that the scripts in the folder *app/Resources/pi/* are all executable and belong to the user pi and the www-data group
To do so run the following: 

    sudo chmod +x feed.py light-barrier.py send catfeeder-sudo-script.sh
    
for executable right and
 
    sudo chown www-data:pi feed.py light-barrier.py send catfeeder-sudo-script.sh

Further you have to add the user *pi* to *www-data* with 

    sudo usermod -a -G www-data pi

##### Troubleshooting
If there goes something wrong with cache cleaning when running `composer install` (it will be mentioned when the error occurs) set the permissions for cache, logs and sessions folder as following (first go to the *var* folder of the project):
- delete the content of the folders *cache*, *logs*, *sessions* (not the folders themselves)
 - `sudo chmod g+s cache logs session`
 - `sudo setfal -dR -m g::rwx cache logs sessions`

## Deploy
You have to do the following steps to deploy the:

- create a file named `catfeeder.conf` in `/etc/apache2/conf-available` and write the following in it:
    ```
    Alias /catfeeder "/var/www/html/catfeeder/web/"
    <Directory "var/www/html/cat-feeder/web">
        Options +FollowSymLinks
        AllowOverride All
    </Directory>
    ```
- enable the config with `sudo a2ensite catfeeder.conf`
- activate the apache url rewrite module with `sudo a2enmod rewrite`

### Launch the deploy script

Execute the deploy script with 
    
    bash /var/www/html/catfeeder/delpoy.sh prod.
You will be asked about several configurations:
- database settings --> change database password to the your own. Don't use default!
- your can ignore the mailer settings, just hit enter to use default
- login name and password
    * use bcrypt to encode you password with `php bin/console security:encode-password` (use another terminal)
    * paste the generated password to the prompt
    * change your token secret, don't use default!

#### That's it you are finished installing the application!
If you want to use the catfeeder outside you local network (from the internet), you have to create your own ssl
certificate, make port forwarding to the IP of your Pi (on the router) and use a dyndns service to attach it to a domain.
These are just hints, I will not provide a tutorial for this, there are enough to find on the search engine of your choice.


