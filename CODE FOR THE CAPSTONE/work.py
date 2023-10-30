from enviroplus import gas
import time
import requests
from pms5003 import PMS5003, ReadTimeoutError

from bme280 import BME280

try:
    from smbus2 import SMBus
except ImportError:
    from smbus import SMBus

bus = SMBus(1)
bme280 = BME280(i2c_dev=bus)


def get_serial_number():
    with open('/proc/cpuinfo', 'r') as f:
        for line in f:
            if line[0:6] == 'Serial':
                return line.split(":")[1].strip()


def getGas():
    reading = gas.read_all()
    return reading


def getWeather():
    temperature = bme280.get_temperature()
    pressure = bme280.get_pressure()
    humidity = bme280.get_humidity()
    return temperature, pressure, humidity


def sendData(somedata):
    url = "http://www.groupalpha.ca/api.php"
    try:
        response = requests.post(url, json=somedata)
        if response.status_code == 200:
            print('Data sent successfully')
        else:
            print(f'Failed to send data. Status code: {response.status_code}')
    except Exception as e:
        print(f'Error sending data: {str(e)}')


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

try:
    while True:
        time.sleep(5)
        gasReading = getGas()
        gasStr = str(gasReading)
        weather = getWeather()
        particulates = getParticulates()
        #print("gas " + str(gasReading))
        #print("weather " + str(weather))
        x = str(particulates)
        y = x.splitlines()
        z = y[1].split()
        #print(z)
        serialNumber = get_serial_number()
        print(serialNumber)
        myDict = {
              'gases' : gasStr,
              'climate' : weather
        }
        print(myDict)
        sendData(myDict)
except KeyboardInterrupt:
    pass
