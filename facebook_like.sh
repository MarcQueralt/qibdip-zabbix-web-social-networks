#!/bin/bash
# facebook like
# tracks the number of likes in a facebook page
# by qibdip
# v1.4
# parameters
# 	$1	monitored server
#	$2	page id
echo `date` "$@" >> /etc/zabbix/externalscripts/external_script.log
php -f /etc/zabbix/externalscripts/php/facebook_like.php $2