import time
import subprocess
import sys

# arg[0] is the file name, so skip it
channelCode = sys.argv[1]
unitCode = sys.argv[2]
duration = sys.argv[3]

subprocess.call('./send ' + channelCode + ' ' + unitCode + ' 1', shell=True)
time.sleep(float(duration))
subprocess.call('./send ' + channelCode + ' ' + unitCode + ' 0', shell=True)

    
        
