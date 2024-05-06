#!/bin/bash

/usr/bin/docker-compose -f /home/inexadmin/sign-controller/docker-compose.yml up -d --build app --log-level=DEBUG