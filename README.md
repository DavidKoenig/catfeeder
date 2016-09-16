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

## The web interface

You have a secured web interface where you have to login to control the catfeeder:

![login](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/login.JPG)

Then you have a page where you can feed immediately and power on/off the training light-barrier:

![feed](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/feed.JPG)

There is also a control center where you can configure your wireless socket and the time settings for the portions of one feed unit:

![settings](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/settings.JPG)

And of course this web-app is responsive:

![responsive](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/responsive.JPG)

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

![wiring-diagram](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/wiring-diagram.JPG)

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

This is an example of how to build a wooden box, that keeps the meet-chopper, pi, wireless socket, etc. in it.
The wood box is a little bit larger than the meet chopper - the dimensions are attached to the one I bought.
As you can see in the pictures, I have put a raised floor into the box - this is not a must. Initially I wanted to bring the meet chopper 
a little bit up to place a slide outwards on the box. But I rejected this idea because it works also nice without a slide. Now it's used to 
put the cable stuff and Pi under it. You don't need to build this raised floor for construction reasons (then you can build the box a little 
less higher) - do as you want. If you don't want to use the light-barrier / training hole you can also build the box smaller - just adjust it to your meat chopper.

You need these things:
- 4 side plates with
    - A: 2 of them have a little bit more width than the meat chopper has depth [for mine 38cm]
    - B: the other 2 having the width of A minus the their thickness (together) [for mine 35,4cm]
- C: 2 matching head (a) and bottom (b) plates --> they are a square with the measure of the width of A
- D: about 10 to 12 brackets
- E: 2 hinge
- F: some screws (maybe 30), that are not longer than the thickness of A, B and C [for mine 1,8cm]
- G: some screws (4 to 5) that are about the double longer than F
- H: if you want to build the raised floor: 1 plate (a) that can carry the meat chopper [for mine 23cm x 35,4cm] and a little square timber (b) [for mine about 10cm high]
- I: 1 little plate about 5cm x 5cm to place one IR of the light-barrier  
    
The steps to build are the following:

- Step 1: Screw the plates A and B with the brackets D together as you can see in picture 1 and 2
(don't mind my additional silver brackets in the picture - I used it because one plate was not 100% straight).

![box1](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box1.JPG)

As you can see my box is a square in the width and a rectangle in the height.

![box2](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box2.JPG)

- Step 2: Screw on the bottom plate C(b) with G

![box3](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box3.JPG)

- Step 3 (additional): Place the raised floor H(a) with two brackets D and the square timber H(b) with one G    

![box4](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box4.JPG)

![box5](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box5.JPG)

- Step 4: Apply the head plate C(a) with the hinge E and some screws F

![box6](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box6.JPG)

- Step 5: If you don't use the light-barrier skip this step. Place the little plate I with 1 bracket D and F about 10cm 
away from the wall and 10cm from the top (the space to the top is necessary to avoid detection errors because of incident light, 
the space between wall and plate to let the cat toy fall through). 

![box7](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box7.JPG)

- Step 7: Place a hole at the back bottom of the box to put the power cable through.
- Step 8: Put a outlet manifold (at least 2 sockets), the wireless socket and the Pi with everything attached on it in the box.
- Step 9: If you use the light-barrier: Put the IRs on the little plate I and the wall. Make sure they are exactly on the opposite of each other. 

![box8](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box8.JPG)

- Step 6: Measure where the outgoing of the meat chopper from the bottom is and place a hole in box at this position [for mine about 4cm diameter and 28cm high]. 
If you use the light-barrier also place a hole on head between the wall and the plate you attached in Step 5. 

![box9](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box9.JPG)

![box10](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box10.JPG)

![box11](https://github.com/DavidKoenig/catfeeder/blob/gh-pages/images/box11.JPG)

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
These are just hints, I will not provide a tutorial for this, there are enough to find on the search engine of your choice ;-)


