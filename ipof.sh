#!/bin/bash
# ipof.sh
# gets the domain ip address
# by qibdip
# v1.7
# parameters
# 	$1	monitored server
echo `date` "$@" >> /etc/zabbix/externalscripts/external_script.log
nslookup $1 | grep "Address" | cut -c10- | tail -n 1