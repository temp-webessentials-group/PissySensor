import PM
import gases
import time
import requests

pm_data = [] #empty list

def send_data(nh3, pm):
    url = 'http://groupalpha.ca/api.php'
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
        



while True:
    nh3 = gases.ammonia()
    pm = PM.pmsensor()
    
    #testing to send data for particulates
    
    #print(pm_data)
    

    
    pm_data.clear()
    
    time.sleep(5)
