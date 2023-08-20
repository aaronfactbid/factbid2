<?php
   require_once('header.php'); 
   $current_hashtag = $_GET['hashtag'];
$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM hashtag WHERE `hashtag`='" . $current_hashtag . "' LIMIT 1;";
$result_ht = mysqli_query($conn, $sql);

if(mysqli_num_rows($result_ht) > 0) { 
	$row_ht = $result_ht->fetch_assoc();
	$id_hashtag = $row_ht['id_hashtag'];
	header("Location: " . tweet_bid($row_ht['hashtag'],$row_ht['id_twitter'],$row_ht['author_username'],$row_ht['template'],$row_ht['tweet_url']), true, 301);
	exit();
}
?>
