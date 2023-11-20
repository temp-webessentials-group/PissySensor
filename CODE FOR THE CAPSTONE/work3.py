from gps import GPSModule

def main():
    # Create an instance of the GPSModule
    gps_module = GPSModule('/dev/serial/by-id/usb-u-blox_AG_-_www.u-blox.com_u-blox_7_-_GPS_GNSS_Receiver-if00')

    try:
        while True:
            # Read GPS data
            gps_data = gps_module.read_gps_data()

            if gps_data is not None:
                # Use the GPS data as needed
                print(gps_data)
            else:
                print("No valid GPS data.")

    except KeyboardInterrupt:
        print("User interrupted script")

    except Exception as e:
        print(f"An error occurred: {e}")
    finally:
        # Close the serial port
        gps_module.serial_port.close()

if __name__ == "__main__":
    main()
