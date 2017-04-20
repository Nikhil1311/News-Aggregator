<?php
header('Access-Control-Allow-Origin: *');  
//get the q parameter from URL
/*$q=$_GET["q"];

//find out which feed was selected
if($q=="Google") {
  $xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
} elseif($q=="NBC") {
  $xml=("http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml");
}
*/
//http://feeds.feedburner.com/ndtvprofit-latest - rss business-working
//http://feeds.feedburner.com/ndtvnews-top-stories
//http://feeds.feedburner.com/ndtvsports-cricket              :cricket
//http://feeds.reuters.com/reuters/UKTennisNews                :tennis
//http://feeds.reuters.com/reuters/INsportsNews               :Sports General 
$xml=("http://feeds.feedburner.com/ndtvnews-top-stories");
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);
//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
/*echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");
*/
//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
$p =array();
for ($i=0; $i<=9; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
  /*echo ("<p><a href='" . $item_link
  . "'>" . $item_title . "</a>");
  echo ("<br>");
  echo ($item_desc . "</p>");
  */
  /*$r = array("title"=>array($i=>$item_title),
             "link"=>array($i=>$item_link),
             "desc"=>array($i=>$item_desc));
  $p += [$i=>$r];
  */
  array_push($p,$item_title,$item_link,$item_desc);
}
 $a = json_encode($p);
echo($a);
 
?>