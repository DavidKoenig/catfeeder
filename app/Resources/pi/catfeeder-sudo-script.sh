#!/bin/bash
#
# sudo script for allowing the user www-data to run commands with root privilegs.

sudo python /var/www/html/cat-feeder/app/Resources/pi/light-barrier.py 11010 4 1 &

exit 0