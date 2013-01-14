#!/bin/bash
# google_query_rank
# counts the results in a google query
# by qibdip
# v1.3
# parameters
# 	$1	monitored server
#	$2	query
#	$3	string to find
#	$4	language: lang_es as default
echo `date` "$@" >> /etc/zabbix/externalscripts/external_script.log
php -f /etc/zabbix/externalscripts/php/google_query_rank.php $2 $3 $4
