import serial

class GPSReader:
    def __init__(self, serial_port_path):
        self.serial_port_path = serial_port_path
        try:
            self.serial_port = serial.Serial(port=serial_port_path, baudrate=9600, timeout=1)
        except serial.serialutil.SerialException as e:
            print(f"Error opening serial port: {str(e)}")

    def __del__(self):
        if hasattr(self, 'serial_port') and self.serial_port.is_open:
            self.serial_port.close()

    def read_gps_data(self):
        try:
            while True:
                line = self.serial_port.readline().decode('utf-8').strip()

                if line.startswith('$GPGLL'):
                    parts = line.split(',')
                    if len(parts) >= 7:
                        status = parts[6]  # Extract the status
                        if status == 'V':
                            gps_data = None
                        else:
                            latitude = parts[1]
                            longitude = parts[3]
                            time = parts[5]
                            gps_data = {
                                'latitude': latitude,
                                'longitude': longitude,
                                'time': time
                            }

                        return gps_data
        except KeyboardInterrupt:
            pass
        finally:
            self.serial_port.close()

if __name__ == "__main__":
    # You can use this section for testing the module
    gps_reader = GPSReader('/dev/serial/by-id/usb-u-blox_AG_-_www.u-blox.com_u-blox_7_-_GPS_GNSS_Receiver-if00')
    gps_data = gps_reader.read_gps_data()
    print(gps_data)

