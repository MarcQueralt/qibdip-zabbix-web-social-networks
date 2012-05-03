<?php
/* 
 * Finds the talking about in a facebook page
 */
define(QIBDIP_FB_ARG_NUM_ERROR,"You need to inform 1 argument with the following meaning:\n\t1.facebook_url:\tpage we want to know the number of likes. It must begin with http://\n");
include_once('library/qibdip_web_functions.php');
if (!qibdip_verify_argument_number(1,QIBDIP_FB_ARG_NUM_ERROR)):
    exit(1);
endif;
$id=qibdip_argument(1);
$url=qibdip_facebook_graph_url($id);
$web=file_get_contents($url);
if(!$web):
    exit(1);
endif;
$talking=qibdip_facebook_json_parse($web,'talking_about_count');
echo $talking."\n";
?>
