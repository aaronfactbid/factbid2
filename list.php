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
		$claims = $row_ht['claims'];
		
		echo '<h1>#' . $row_ht['hashtag'] . '</h1>'; 
		echo '<div class="bid-bid";><span>'.$row_ht['bids'].' bids for the facts listed below totaling: $'.number_format($row_ht["total"]);
		if($claims>0)
		{
			echo '<br><a href="/claims.php?claims='. $row_ht['id_hashtag'] . '">' . $row_ht['claims']. ' claims to having provided the facts, donate if satisfied</a>';
		}
		echo '</span></div>';
		echo '<span>Created: <script>var date = new Date(' . $row_ht['created_int'] .' * 1000); document.write(date.toLocaleDateString());</script> by @<a href="https://twitter.com/' . $row_ht['author_username'] . '/status/' . $row_ht['id_twitter'] . '">' . $row_ht['author_username'] . '</a></span>';

		$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM bid WHERE `id_hashtag`=" . $id_hashtag . " ORDER BY `created_ts` DESC LIMIT 100;";
		$result = mysqli_query($conn, $sql);

	?>
   <div class="bidswrapper">
   <p>
   <?php echo '<h2>Facts being sought:</h2><br>' . $row_ht['title']; ?>
   </p>
   	<p>
	<a href="<?php echo tweet_bid($row_ht['hashtag'],$row_ht['id_twitter'],$row_ht['author_username'],$row_ht['template'],$row_ht['tweet_url']); ?>"><img src="/images/click-tweet.png"></a>
	</p>
	<p>
   	This page tracks all tweets containing <b>#<?php echo $row_ht['hashtag']; ?></b> plus an amount plus <b>#factbid</b>.  
	To add your own bid, or pledge to pay for whoever provides the requested facts, click the blue button to start a tweet with the hashtags.
	See <a href="/">all hashtags</a>, <a href="https://factbid.substack.com/about">how it works</a>, or if you can provide the facts tweet a <a href="<?php echo tweet_claim($row_ht['hashtag'],$row_ht['id_twitter'],$row_ht['author_username']); ?>">claim</a>.
	</p><p>
   </p></div>

	<section class="bidswrap">
		<p><b>100 most recent tweets with bids, or <a href="/export.php?hashtag=<?php echo $current_hashtag; ?>">download</a> the full list as a CSV spreadsheet.</b></p>
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
		<p><b>100 largest tweet bids</b></p>
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
