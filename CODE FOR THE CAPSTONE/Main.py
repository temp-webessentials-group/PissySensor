import PM
import gases
import time
import requests
import re

#parse info from PM sensor
def parse_pm_output(output):
    parsed_data={}
    
    lines = output.split('\n')
    
    for line in lines: 
        parts = line.split(':')
        if len(parts) == 2:
            parameter = parts[0].strip()
            value = parts[1].strip()
            parsed_data[parameter] = int(value)
    
    return parsed_data

#send sensor data to web server
def send_data(nh3, parsed_pm_data):
    url = 'http://groupalpha.ca/'
    data = {
        'ammonia' : nh3,
        **parsed_pm_data
    }
    
    print('data')
    
    try:
        response = requests.post(url, json=data)
        
        if response.status_code == 200:
            print('Data sent successfully')
        else:
            print('Failed to send data')
    except Exception as e:
        print(f'Error sending data: {str(e)}')
        



while True:
    nh3 = gases.ammonia()
    pm_out = PM.pmsensor()
    
    #parse data
    parsed_pm_data = parse_pm_output(pm_out)
    
    #send sensor data
    send_data(nh3, parsed_pm_data)

    
    time.sleep(5)
    