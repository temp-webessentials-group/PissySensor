from enviroplus import gas
import time
import requests
from pms5003 import PMS5003, ReadTimeoutError

from bme280 import BME280

from gps import GPSReader
try:
    gps_reader = GPSReader('/dev/serial/by-id/usb-u-blox_AG_-_www.u-blox.com_u-blox_7_-_GPS_GNSS_Receiver-if00')
except serial.serialutil.SerialException as e:
    print(f"Error opening serial port: {str(e)}")

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
        time.sleep(10)
        gasReading = getGas()
        gasStr = str(gasReading)
        gasLineList = gasStr.splitlines()
        oxidisingLine = gasLineList[0].split()
        oxidising = oxidisingLine[-2]
        reducingLine = gasLineList[1].split()
        reducing = reducingLine[-2]
        nh3Line = gasLineList[2].split()
        nh3 = nh3Line[-2]
        weather = getWeather()
        splitWeather = list(weather)
        temperature = splitWeather[0]
        pressure = splitWeather[1]
        humidity = splitWeather[2]

        particulates = getParticulates()
        particulatesToString = str(particulates)
        particulatesToLines = particulatesToString.splitlines()
        pm1Line = particulatesToLines[1].split()
        pm1 = pm1Line[-1]
        pm25Line = particulatesToLines[2].split()
        pm25 = pm25Line[-1]
        pm10Line = particulatesToLines[3].split()
        pm10 = pm10Line[-1]
        #device Serial Number
        serialNumber = get_serial_number()
        #gps data
        gps_data = gps_reader.read_gps_data()
        print(gps_data)

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

        }
        print(myDict)
        #sendData(myDict)
#parse all variables
except KeyboardInterrupt:
    pass
