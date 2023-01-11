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

$directory = "/var/www/html/download/";
$filename = date('Y-d-m_h-i-s', time()) . '_' . $current_hashtag;
	
// get bids
$query = "SELECT 'author_username', 'author_id', 'url', 'created_at','currency','amount','bid_outdated' UNION ALL " .
		"SELECT IFNULL(author_username,''),IFNULL(author_id,''),CONCAT('https://twitter.com/',IFNULL(author_username,''),'/status/',IFNULL(id_twitter,'')) AS URL,IFNULL(created_ts,''),IFNULL(currency,''),IFNULL(amount,''),IFNULL(exclude,'') FROM bid WHERE `id_hashtag`='" . $id_hashtag . "' INTO OUTFILE '" . $directory . $filename . ".csv' FIELDS ENCLOSED BY '\"' TERMINATED BY ',' ESCAPED BY '\"' LINES TERMINATED BY '\r\n';";
echo $query;
if (!$result = mysqli_query($conn, $query)) {
	echo "Database error outputing CSV file";
    exit(mysqli_error($conn));
}

$zip_command = "zip -j " . $directory . $filename . ".zip " . $directory . $filename . ".csv ; rm " . $directory . $filename;
$download_path = "/download/" . $filename . ".zip";

shell_exec($zip_command);

$full_path = $directory . $filename . ".zip ";

/*if(file_exists($full_path)){ */
	header('Content-Type: application/zip');
	header('Content-Disposition: attachment; filename=" . $download_path . "');
	header('Content-Length: ' . filesize($directory . $filename . '.zip'));
	header('Location: '.$download_path);
/*}
else
{
	echo "error generating file";
}
*/

/*
This overflows php's memory with 1 million records, so I switched to redirecting to the file above
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=bids_' . $current_hashtag . '.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('author_username', 'author_id', 'URL', 'created','currency','amount','replaced'));

if (count($bids) > 0) {
    foreach ($bids as $row) {
        fputcsv($output, $row);
    }
}
*/

?>
