#!/bin/bash
#
# params: 
# $1 true or false --> activate or not
# $2 channel code
# $3 unit code
# $4 time
#
### sudo script for allowing the user www-data to run commands with root privilegs. ###

### light barrier part ###
# if true, then python script shall be activated, if it is false it should be killed and process id's should be given as arguments

if [ $1 = "true" ]
    then 
        python /var/www/html/cat-feeder/app/Resources/pi/light-barrier.py $2 $3 $4 &
fi

if [ $1 = "false" ]
    then
        kill -9 `ps -ef | grep light-barrier.py | grep -v grep | awk '{print $2}'` &
fi

exit 0