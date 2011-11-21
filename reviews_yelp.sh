#!/bin/bash
# reviews_yelp.sh
# retrieves the number of reviews from yelp for a given id
# (c) qibdip 2011
echo `date` "$@" >> /etc/zabbix/externalscripts/external_script.log
wget -q -O - http://www.yelp.com/biz/$1 | grep -o -e '<span class="count">[0-9]*</span>' | grep -o -e '>.*<' | cut -d'<' -f1 | cut -d'>' -f2
