import time
import subprocess
import RPi.GPIO as GPIO
import sys

channelCode = sys.argv[1]
unitCode = sys.argv[2]
duration = sys.argv[3]

# Use the pins as they are on the board.
GPIO.setmode(GPIO.BOARD)
# Pin 18
GPIO.setup(12, GPIO.IN)

while 1:
    if GPIO.input(12) == GPIO.LOW:
        subprocess.call('sudo ./send ' + channelCode + ' ' + unitCode + ' 1', shell=True)
        time.sleep(float(duration))
        subprocess.call('sudo ./send ' + channelCode + ' ' + unitCode + ' 0', shell=True)
        # 1 sec sleep to get just one low, instead of multpiple because of high sensitivity.
        time.sleep(1)
    # Don't slow down system because of endless loop.
    time.sleep(0.01)
    
        
