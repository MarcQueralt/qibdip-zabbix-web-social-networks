<?php
/* 
 * Fins a link's rank in a google query
 */
define(QIBDIP_GQR_ARG_NUM_ERROR,"You need to inform 2 arguments with the following meaning:\n\t1.Query:\tquery to launch on google.\n\t2.Text:\tText willing to rank. Usually is an url or the final part of it.");
include_once('library/qibdip_web_functions.php');
if (!qibdip_verify_argument_number(2,QIBDIP_GQR_ARG_NUM_ERROR)):
    exit(1);
endif;
$query=qibdip_argument(1);
$text=qibdip_argument(2);
$url=qibdip_url_google_search($query);
$web=qibdip_get_webpage($url);
//echo "query:".$query."\ntext:".$text."\nurl:".$url."\nweb:\n".$web['html']."\n";
$regex=qibdip_regex_google_search_result();
$rank=qibdip_get_rank($web['html'],$text,$regex);
echo $rank."\n";
?>
