from enviroplus import gas
import time
import requests

from bme280 import BME280

try:
    from smbus2 import SMBus
except ImportError:
    from smbus import SMBus

bus = SMBus(1)
bme280 = BME280(i2c_dev=bus)

def gasReadings():
    reading = gas.read_all()
    return reading

def ammonia():
    nh3 = gas.read_nh3()
    return nh3

def getWeather():
    temperature = bme280.get_temperature()
    pressure = bme280.get_pressure()
    humidity = bme280.get_humidity()
    return temperature, pressure, humidity

def sendData(somedata):
    url = "https://www.mysite.com"
    x = requests.post(url, json=somedata)
    print(x)

time.sleep(10)