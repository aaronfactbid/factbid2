<?php
   require_once('header.php');

	$current_hashtag = $_GET['hashtag'];
 
 	$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM hashtag WHERE `hashtag`='" . $current_hashtag . "' LIMIT 1;";
	$result_ht = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result_ht) > 0) { 
		$row_ht = $result_ht->fetch_assoc();
		$id_hashtag = $row_ht['id_hashtag'];
		
		echo '<p>' . $row_ht['hashtag'] . '</p>';
		echo '<p><?php echo  $row["bids"]; ?> bids.  Total: $<?php echo number_format($row["total"]); ?> Hashtag created: <script>var date = new Date(' . $row_ht['created_int'] .' * 1000); document.write(date.toLocaleString());</script></p>';

		$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM bid WHERE `id_hashtag`=" . $id_hashtag . " ORDER BY `sort`;";
		$result = mysqli_query($conn, $sql);

	?>
	
<table>
     <tr>
    <th>Author</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
<?php while($row = $result->fetch_assoc()) {  ?>
	
	<tr>
		<td>@<a href="https://twitter.com/<?php echo  $row['author_username']; ?>/status/<?php echo  $row['id_twitter']; ?>"><?php echo  $row['author_username']; ?></a></td>
		<td><?php echo '<script>var date = new Date(' . $row['created_int'] .' * 1000); document.write(date.toLocaleString());</script>';?></td>
		<td><?php echo $row['currency'] . number_format($row['amount']); ?></td>
	</tr>
	</table>
<?php } 
	} 
	else {
	  echo "#" . $current_hashtag . " not found";
	}   
require_once('footer.php');
?>
