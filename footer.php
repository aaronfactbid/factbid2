<p class="footer-text">
<?php	
$sql = "SELECT id_process,UNIX_TIMESTAMP(finished_ts) AS finished_int,UNIX_TIMESTAMP(tweet_last_ts) AS tweet_last_int FROM `process` WHERE finished_ts IS NOT NULL ORDER BY id_process DESC LIMIT 1;";
$result_footer = mysqli_query($conn, $sql);
if(mysqli_num_rows($result_footer) > 0) {
	$row_footer = $result_footer->fetch_assoc();
	echo 'cached id: ' . $row_footer['id_process'] . ' ';
	echo '<script>var date_generated = new Date(' . time() * 1000 .' ); var date_polled = new Date(' . $row_footer['finished_int'] * 1000 .' ); var date_last = new Date(' . $row_footer['tweet_last_int'] * 1000 .' ); ';
	echo 'document.write("Generated: " + date_generated.toLocaleString()); document.write(" Last polled: " + date_polled.toLocaleString()); document.write(" Last tweet: " + date_last.toLocaleString());</script>';
}
?>
</p>
</div>
</body>
</html>