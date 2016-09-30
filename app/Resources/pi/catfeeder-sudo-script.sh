#!/bin/bash
#
# params: 
# $1 'feed' or 'lightBarrier'
# $2 channel code
# $3 unit code
# $4 time
# $5 true or false --> activate light-barrier or not
#
### sudo script for allowing the user www-data to run commands with root privileges. ###

### feed part ###
if [ $1 = "feed" ]
    then
        python /var/www/html/catfeeder/app/Resources/pi/feed.py $2 $3 $4
### light barrier part ###
elif [ $1 = "lightBarrier" ]
    then
        # if true, then python script shall be activated, if it is false it should be killed and process id's should be given as arguments
        if [ $5 = "true" ]
            then
                python /var/www/html/catfeeder/app/Resources/pi/light-barrier.py $2 $3 $4 &
        fi

        if [ $5 = "false" ]
            then
                kill -9 `ps -ef | grep light-barrier.py | grep -v grep | awk '{print $2}'` &
        fi
fi
exit 0