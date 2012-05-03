<?php
/* 
 * Finds the followers of the user
 */
define(QIBDIP_TW_ARG_NUM_ERROR,"You need to inform 1 argument with the following meaning:\n\t1.username:\tthe username we want to know the followers. Without initial @\n");
include_once('library/qibdip_web_functions.php');
if (!qibdip_verify_argument_number(1,QIBDIP_TW_ARG_NUM_ERROR)):
    exit(1);
endif;
$user=qibdip_argument(1);
$url=  qibdip_twitter_url($user);
$web=file_get_contents($url);
if(!$web):
    exit(1);
endif;
//print_r(json_decode($web, true));
$following=qibdip_json_parse($web, 'friends_count');
echo $following;
?>
