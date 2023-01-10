<?php

// Database Connection
require_once('config.php');

$current_hashtag = $_GET['hashtag'];

$sql = "SELECT id_hashtag FROM hashtag WHERE `hashtag`='" . $current_hashtag . "' LIMIT 1;";
$result_ht = mysqli_query($conn, $sql);

$id_hashtag = 0;
if(mysqli_num_rows($result_ht) > 0) { 
	$row_ht = $result_ht->fetch_assoc();
	$id_hashtag = $row_ht['id_hashtag'];
}

if($id_hashtag == 0 )
{
	echo "Invalid hashtag";
	exit(1);
}
	
// get bids
$query = "SELECT author_username,author_id,CONCAT('https://twitter.com/',author_username,'/status/',id_twitter) AS URL,created_ts,currency,amount,exclude FROM bid WHERE `id_hashtag`='" . $id_hashtag . "';";
if (!$result = mysqli_query($conn, $query)) {
    exit(mysqli_error($conn));
}

$bids = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bids[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=bids_' . $current_hashtag . '.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('author_username', 'author_id', 'URL', 'created','currency','amount','replaced'));

if (count($bids) > 0) {
    foreach ($bids as $row) {
        fputcsv($output, $row);
    }
}

?>
