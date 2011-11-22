#!/bin/bash
# google_query_count
# counts the results in a google query
# by qibdip
# v1.2
# parameters
# 	$1	monitored server
#	$2	query
resultat=`lynx -dump "http://google.com/search?hl=en&safe=off&q=%22$2%22"|grep -o -e "Results .* about .* for" | grep -o -e "about [0-9,]* for" | grep -o -e " [0-9,]* "`
if [ "$resultat" == "" ]; then
	echo '0'
else
	echo ${resultat//,/}
fi
