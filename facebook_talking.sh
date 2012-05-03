#!/bin/bash
# facebook talking about
# tracks the number of talking about in a facebook page
# by qibdip
# v1.5
# parameters
# 	$1	monitored server
#	$2	page id
echo `date` "$@" >> /etc/zabbix/externalscripts/external_script.log
php -f /etc/zabbix/externalscripts/php/facebook_talking.php $2