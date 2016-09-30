#!/bin/sh

# activate gpio for light barrier
echo "17" > /sys/class/gpio/export
echo "in" > /sys/class/gpio/gpio17/direction

# activate daemon for remote send
/var/www/html/catfeeder/app/Resources/pi/daemon &

exit 0

