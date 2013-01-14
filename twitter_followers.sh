#!/bin/bash
# twitter followers
# get the number of followers of a twitter user
# by qibdip
# v1.6
# parameters
# 	$1	monitored server
#	$2	twitter user without @
echo `date` "$@" >> /etc/zabbix/externalscripts/external_script.log
php -f /etc/zabbix/externalscripts/php/twitter_followers.php $2