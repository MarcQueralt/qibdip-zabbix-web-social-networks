#!/bin/bash
# twitter listed
# get the number of times the user is listed
# by qibdip
# v1.6
# parameters
# 	$1	monitored server
#	$2	twitter user without @
echo `date` "$@" >> /etc/zabbix/externalscripts/external_script.log
php -f /etc/zabbix/externalscripts/php/twitter_listed.php $2