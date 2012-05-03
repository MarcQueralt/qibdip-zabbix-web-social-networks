<?php

/**
 * version 1.6
 */
define(QIBDIP_TIMEOUT, 5);

/**
 * retrieves a webpage based on its url
 * @param string $url url to retrieve
 * @return mixed an structured object containing html, info and error
 * @uses curl_init
 * @uses curl_setopt
 * @uses curl_exec
 * @uses curl_getinfo
 * @uses curl_error
 * @uses curl_close
 * @since 1.3
 */
function qibdip_get_webpage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, QIBDIP_TIMEOUT);

    $result['html'] = curl_exec($ch);
    $result['info'] = curl_getinfo($ch);
    $result['error'] = curl_error($ch);

    curl_close($ch);

    return $result;
}

/**
 * creates an url that sends a query to google search
 * @param string $query the query to be sent to google
 * @return string the url to retrieve
 * @since 1.3
 */
function qibdip_url_google_search($query,$lang=null) {
    $url = "http://www.google.com/search?q=" . $query;
    $url.="&num=100";
    $url.="&hl=en";
    $url.="&safe=off";
    $url.="&pws=0";  //no personalization
    if(isset($lang)):
        $url.="&lr=".$lang;
    endif;
//    $url.="&filter=0"; //filter duplicates 0 means do not filter
    return $url;
}

/**
 * returns the regex required to identify a result in a google SERP
 * @return string
 * @since 1.3
 */
function qibdip_regex_google_search_result() {
    return '/<li .*?class="g"><h3\b[^>]*>(.*?)<\/h3>/';
}

/**
 * Calculate the rank of first appearance of $text in $web after application of $regex
 * @param string $web the url to parse
 * @param string $text the text to search
 * @param string $regex the regular expression to apply
 * @param string $notfound the value to return in case of no match
 * @return string
 * @since 1.3
 */
function qibdip_get_rank($web, $text, $regex, $notfound = 101) {
    preg_match_all($regex, $web, $matches);
    $found = false;
    $rank = 0;
    $matches = $matches[0];
    $m = array_shift($matches);
    while (($m) && (!$found)):
//        echo "match:".print_r($m,true)."\nrank:".$rank."\nfound:".$found."\n\n";
        $found = !(stristr($m, $text) === FALSE);
        $rank+=1;
        $m = array_shift($matches);
    endwhile;
    if (!$found):
        $rank = $notfound;
    endif;
    return $rank;
}

/**
 * Verify that argument number is the expected and raise an error message when needed.
 * @param integer $num the num of expected arguments
 * @param string $message the message to show in case of error
 * @return boolean the argument number equals $num
 * @since 1.3
 */
function qibdip_verify_argument_number($num, $message = "Error!\n") {
    if ($_SERVER['argc'] == $num + 1):
        return true;
    else:
        echo $message;
        return false;
    endif;
}

/**
 * Verify that argument number is in the expected range and raise an error message when needed.
 * @param integer $num the minimal num of expected arguments
 * @param integer $max the max number of expected arguments
 * @param string $message the message to show in case of error
 * @return boolean the argument number equals $num
 * @since 1.5
 */
function qibdip_verify_argument_range($num, $max, $message = "Error!\n") {
    //echo "arguments: ".$_SERVER['argc']."\n";
    if (($_SERVER['argc'] >= $num + 1) and ($_SERVER['argc'] <= $max + 1)):
        return true;
    else:
        echo $message;
        return false;
    endif;
}

/**
 * Returns a command line argument
 * @param integer $num number of the argument to seek 1 for first (not 0).
 * @return mixed the argument value
 * @since 1.3
 */
function qibdip_argument($num) {
    if ($_SERVER['argc'] >= $num):
        return $_SERVER['argv'][$num];
    else:
        return null;
    endif;
}

/**
 * returns the regex required to identify the result count in a google SERP
 * @return string
 * @since 1.4
 */
function qibdip_regex_google_search_count() {
    return '/<div>results .*of [about ]*.([,0123456789]*).*from/i';
}

function qibdip_get_count($html, $regex) {
    if (preg_match($regex, $html, $matches)):
        $resultat = $matches[0];
    endif;
    //print_r($matches);
    return $resultat;
}

/**
 * gets the url to ask for likes at facebook
 * @param string $id page id uses to be a long number but also works with vanity name
 * @return string
 * @since 1.4
 */
function qibdip_facebook_graph_url($id) {
    return "http://graph.facebook.com/" . $id;
}

/**
 * returns the likes in a json object
 * @param mixed $json the json object
 * @return the value of likes
 */
function qibdip_facebook_likes($json) {
    return qibdip_facebook_json_parse($json, 'likes');
}

/**
 * gets the attribute described by attr from a json object
 * @param mixed $json the json object to parse
 * @param string $attr the attribute to search for
 * @return string
 * @deprecated
 * @since v1.4
 */
function qibdip_facebook_json_parse($json, $attr) {
    return qibdip_json_parse($json, $attr);
}

/**
 * gets the attribute described by attr from a json object
 * @param mixed $json the json object to parse
 * @param string $attr the attribute to search for
 * @return string
 * @since v1.6
 */
function qibdip_json_parse($json, $attr) {
    $decoded = json_decode($json, true);
    if (!isset($decoded[$attr])):
        return 0;
    endif;
    return $decoded[$attr];
}

/**
 * creates the twitter url for the user
 * @param string $user username without @ 
 * @return string
 * @since 1.6
 */
function qibdip_twitter_url($user) {
    return 'http://api.twitter.com/1/users/show.json?screen_name='.$user;
}
?>
