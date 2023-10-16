import PM
import gases
import time
import requests

pm_data = [] #empty list

def send_data(nh3, pm):
    url = 'http://groupalpha.ca/'
    data = {
        'ammonia' : nh3,
        'particulate' : pm
    }
    
    #print('data')
    
    try:
        response = requests.post(url, json=data)
        
        if response.status_code == 200:
            print('Data sent successfully')
        else:
            print('Failed to send data')
    except Exception as e:
        print(f'Error sending data: {str(e)}')
        
    pm_data.clear() # clear list
        
pm = PM.pmsensor()


while True:
    nh3 = gases.ammonia()
    pm = PM.pmsensor()
    
    #testing to send data for particulates
    pm_data.append(pm) #append to list
    #print(pm_data)
    
    for pm_value in pm_data:
        #send data
        send_data(nh3, pm_value)
    
    pm_data.clear()
    
    time.sleep(5)