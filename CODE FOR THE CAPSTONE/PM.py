#!/usr/bin/env python3

import time
from pms5003 import PMS5003, ReadTimeoutError

pms5003 = PMS5003()

def pmsensor():
    try:
        readings = pms5003.read()
        return readings
    except ReadTimeoutError:
        pms5003 = PMS5003()
    except KeyboardInterrupt:
        pass
