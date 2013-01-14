<?php

/*
 * Count query results
 */
define(QIBDIP_GQC_ARG_NUM_ERROR, "You need to inform 1 argument with the following meaning:\n\t1.Query:\tquery to launch on google.\n");
include_once('library/qibdip_web_functions.php');
if (!qibdip_verify_argument_number(1, QIBDIP_GQC_ARG_NUM_ERROR)):
    exit(1);
endif;
$query = qibdip_argument(1);
$url = qibdip_url_google_search($query);
$web = qibdip_get_webpage($url);
//echo "query:".$query."\nurl:".$url."\n";
//echo "web:\n".$web['html']."\n";
$regex = qibdip_regex_google_search_count();
//echo "regex: ".$regex,"\n";
$count = qibdip_get_count($web['html'], $regex);
if (!isset($count)):
    $count = 0;
endif;
echo $count . "\n";
?>
