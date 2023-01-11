<?php
   require_once('header.php'); 
   $current_hashtag = $_GET['hashtag'];
   ?>

   <?php
 
 	$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM hashtag WHERE `hashtag`='" . $current_hashtag . "' LIMIT 1;";
	$result_ht = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result_ht) > 0) { 
		$row_ht = $result_ht->fetch_assoc();
		$id_hashtag = $row_ht['id_hashtag'];
		
		echo '<h1>#' . $row_ht['hashtag'] . '</h1>'; 
		echo '<div class="bid-bid"><span>'.$row_ht['bids'].' bids</span> <span>Total: $'.number_format($row_ht["total"]).' </span> <span>Hashtag created: <script>var date = new Date(' . $row_ht['created_int'] .' * 1000); document.write(date.toLocaleString());</script> by @<a href="https://twitter.com/' . $row_ht['author_username'] . '/status/' . $row_ht['id_twitter'] . '">' . $row_ht['author_username'] . '</a></span> </div>';

		$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM bid WHERE `id_hashtag`=" . $id_hashtag . " ORDER BY `created_ts` DESC LIMIT 100;";
		$result = mysqli_query($conn, $sql);

	?>
   <div class="bidswrapper">
   	<p>
	Tweet your own <a href="<?php echo tweet_bid($row_ht['hashtag'],$row_ht['id_twitter'],$row_ht['author_username'],$row_ht['template']); ?>">bid</a>.
	Or if you are a whistleblower with the evidence being sought, tweet a <a href="<?php echo tweet_claim($row_ht['hashtag'],$row_ht['id_twitter'],$row_ht['author_username']); ?>">claim</a>
	</p><p>
   	Here are the 100 most recent and largest bids.  <a href="/export.php?hashtag=<?php echo $current_hashtag; ?>">Download</a> the full list as a CSV spreadsheet.
   </p></div>

	<section class="bidswrap">
		<p>100 most recent tweet bids</p>
		<div class="fact_bidtable">
			<table>
				<thead>
					     <tr>
    <th>Bidder</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
				</thead>

<?php while($row = $result->fetch_assoc()) {  ?>
	
		<tr>
		<td>@<a href="https://twitter.com/<?php echo  $row['author_username']; ?>/status/<?php echo  $row['id_twitter']; ?>"><?php echo  $row['author_username']; ?></a></td>
		<td><?php echo '<script>var date = new Date(' . $row['created_int'] .' * 1000); document.write(date.toLocaleString());</script>';?></td>
		<td><?php echo $row['currency'] . number_format($row['amount']); ?></td>
	</tr>
	
                                                                                                                           
<?php } ?> 
</table> 
		</div>
	</section>

   <?php	
		$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM bid WHERE `id_hashtag`=" . $id_hashtag . " ORDER BY `amount` DESC LIMIT 100;";
		$result = mysqli_query($conn, $sql);

	?>
	<section class="bidswrap">
		<p>100 largest tweet bids</p>
		<div class="fact_bidtable">
			<table>
				<thead>
					     <tr>
    <th>Bidder</th>
    <th>Date</th>
    <th>Amount</th>
</tr>
				</thead>

<?php while($row = $result->fetch_assoc()) {  ?>
	
		<tr>
		<td>@<a href="https://twitter.com/<?php echo  $row['author_username']; ?>/status/<?php echo  $row['id_twitter']; ?>"><?php echo  $row['author_username']; ?></a></td>
		<td><?php echo '<script>var date = new Date(' . $row['created_int'] .' * 1000); document.write(date.toLocaleString());</script>';?></td>
		<td><?php echo $row['currency'] . number_format($row['amount']); ?></td>
	</tr>
	
                                                                                                                           
<?php } ?> 
</table> 
		</div>
	</section>



<?php	} 
	else {
	  echo "#" . $current_hashtag . " not found";
	}   
require_once('footer.php');
?>
