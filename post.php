<?php
   require_once('header.php'); 
   $current_hashtag = $_GET['hashtag'];
   header("Location: " . tweet_bid($row_ht['hashtag'],$row_ht['id_twitter'],$row_ht['author_username'],$row_ht['template'],$row_ht['tweet_url']), true, 301);
   exit();
?>
