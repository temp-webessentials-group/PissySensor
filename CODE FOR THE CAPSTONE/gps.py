import serial

class GPSModule:
    def __init__(self, serial_port_path):
        self.serial_port = serial.Serial(
            port=serial_port_path,
            baudrate=9600,
            timeout=1
        )

    def read_gps_data(self):
        try:
            while True:
                line = self.serial_port.readline().decode('utf-8').strip()

                if line.startswith('$GPGLL'):
                    parts = line.split(',')
                    if len(parts) >= 7:
                        status = parts[6]
                        if status == 'V':
                            gps_data = {
                                'latitude': 0,
                                'longitude': 0
                            }
                        else:
                            latitude = format(float(parts[1]) / 100, '.6f')
                            longitude = format(float(parts[3]) / 100, '.6f')
                            if parts[2] == 'S':
                               latitude = latitude * -1
                            if parts[4] == 'W':
                               longitude = float(longitude) * -1.0

                            gps_data = {
                                'latitude': latitude,
                                'longitude': longitude,
                            }

                        return gps_data
        except KeyboardInterrupt:
            pass


if __name__ == "__main__":
    # Example usage when running the module as a script
    gps_module = GPSModule('/dev/serial/by-id/usb-u-blox_AG_-_www.u-blox.com_u-blox_7_-_GPS_GNSS_Receiver-if00')
    data = gps_module.read_gps_data()
    print(data)

