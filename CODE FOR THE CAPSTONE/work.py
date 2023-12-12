from enviroplus import gas
import time
import requests
from pms5003 import PMS5003, ReadTimeoutError
from gps import GPSModule

from bme280 import BME280

try:
    from smbus2 import SMBus
except ImportError:
    from smbus import SMBus

bus = SMBus(1)
bme280 = BME280(i2c_dev=bus)

# Initialize the GPS module
gps_module = GPSModule('/dev/serial/by-id/usb-u-blox_AG_-_www.u-blox.com_u-blox_7_-_GPS_GNSS_Receiver-if00')

#get cpu temp for compensation
with open("/sys/class/thermal/thermal_zone0/temp", "r") as f:
    temp = f.read()
    temp = int(temp) / 1000.0

#tuning factor for compensation
factor = 2.25

#generate array for cpu temp
tempArray = [temp] * 5

#define loop counter and iteration limit
loop_counter = 0
iteration_limit = 10

#Device S/N
def get_serial_number():
    with open('/proc/cpuinfo', 'r') as f:
        for line in f:
            if line[0:6] == 'Serial':
                return line.split(":")[1].strip()

#get gas readings
def getGas():
    reading = gas.read_all()
    return reading

#get weather readings 
def getWeather():
    cpuTemp = tempArray[1:] + [temp]
    avgTemp = sum(cpuTemp) / float(len(cpuTemp))
    rawTemp = bme280.get_temperature()
    temperature = round(rawTemp - ((avgTemp - rawTemp) / factor))
    pressure = round(bme280.get_pressure())
    humidity = round(bme280.get_humidity())
    return temperature, pressure, humidity

#send data into database
def sendData(somedata):
    url = "https://www.smarkair.com/api.php"
    try:
        response = requests.post(url, json=somedata)
        if response.status_code == 200:
            print('Data sent successfully')
        else:
            print(f'Failed to send data. Status code: {response.status_code}')
    except Exception as e:
        print(f'Error sending data: {str(e)}')

#get PM sensor readings
def getParticulates():
    pms5003 = PMS5003()
    try:
        while True:
            try:
                readings = pms5003.read()
                return readings
            except ReadTimeoutError:
                pms5003 = PMS5003()
    except KeyboardInterrupt:
        pass

#loop to generate readings to be sent to the database
#loop will run a number of times before sending data to website
try:
    while True:

        time.sleep(5)

        #retrieve gas readings
        gasReading = getGas()
        gasStr = str(gasReading)
        gasLineList = gasStr.splitlines()
        oxidisingLine = gasLineList[0].split()
        oxidising = oxidisingLine[-2]
        reducingLine = gasLineList[1].split()
        reducing = reducingLine[-2]
        nh3Line = gasLineList[2].split()
        nh3 = nh3Line[-2]

        #retrieve weather data
        weather = getWeather()
        splitWeather = list(weather)
        temperature = splitWeather[0]
        pressure = splitWeather[1]
        humidity = splitWeather[2]

        #retrieve particulates data
        particulates = getParticulates()
        particulatesToString = str(particulates)
        particulatesToLines = particulatesToString.splitlines()
        pm1Line = particulatesToLines[1].split()
        pm1 = pm1Line[-1]
        pm25Line = particulatesToLines[2].split()
        pm25 = pm25Line[-1]
        pm10Line = particulatesToLines[3].split()
        pm10 = pm10Line[-1]

        #gather gps data from gps.py
        gps_data = gps_module.read_gps_data()
        if gps_data is not None:
            latitude = gps_data.get('latitude')
            longitude = gps_data.get('longitude')
        else:
            latitude = gps_data.get('latitude')
            longitude = gps_data.get('longitude')

        
        
        loop_counter += 1 #increment counter
        #if block to determine if iteration_limit has been reached
        if loop_counter >= iteration_limit:
            loop_counter = 0 #reset counter
            
            #retrieve device Serial Number
            serialNumber = get_serial_number()
        
            #data to be sent to website database
            myDict = {
                'Serial Number' : serialNumber,
                'Temperature °C' : temperature,
                'Pressure kPa' : pressure,
                'Humidity %' : humidity,
                'PM 1.0 μg/m3' : pm1,
                'PM 2.5 μg/m3' : pm25,
                'PM 10 μg/m3' : pm10,
                'Oxidising Gas ohms' : oxidising,
                'Reducing Gas ohms' : reducing,
                'NH3 ohms' : nh3,
                'Latitude': latitude,
                'Longitude': longitude

            }
            
            print("Sending Data...")
            #try except block to show connection to api failed
            try:
                sendData(myDict)
            except Exception as e:
                print(f"Failed to connect to this API: {str(e)}")

except KeyboardInterrupt:
    pass
