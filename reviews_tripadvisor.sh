#!/bin/bash
# tripadvisor review count
# counts the reviews on tripadvisor
# by qibdip
# v1.3
# parameters
# 	$1	monitored server
#	$2	objectid in tripadvisor
resultat=`wget -q -O - "http://www.tripadvisor.com/$2.html"| grep -o -e '<var 
property="v:count">[0-9]*'|grep -o -e '>.*'|cut -d'>' -f2 `
if [ "$resultat" == "" ]; then
	echo '0'
else
	echo ${resultat//,/}
fi
