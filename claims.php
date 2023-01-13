<?php
   require_once('header.php'); ?>

   <div class="bidswrapper">
   	<p>
   	Whistleblowers post evidence and their donation instructions in a tweet with the hashtag they are claiming plus #factbidclaim.  Below are the tweets from whistleblowers.
   </p></div>

   <?php
   
	$current_hashtag = $_GET['claims'];

   $sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM hashtag WHERE `id_hashtag`='" . $current_hashtag . "' LIMIT 1;";
	$result_ht = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result_ht) > 0) { 
		$row_ht = $result_ht->fetch_assoc();
		// $id_claim = $row_ht['id_claim'];
		
		echo '<h1>#' . $row_ht['hashtag'] . ' claims</h1>';
		$sql1 = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM claim WHERE `id_hashtag`='" . $current_hashtag . "';";
		$claimResult = mysqli_query($conn, $sql1);
		  // Return the number of rows in result set
		  $rowcount=mysqli_num_rows($claimResult);

		echo '<div class="bid-bid"><span>'. $rowcount.' claims</span></div>';  
		
        
	?> 
	<section class="bidswrap claimwrap">
		<div class="fact_bidtable">
<table>
	<thead>
	 <tr>
    <th>Whistleblower</th>
    <th>Date</th>
</tr>
	</thead>
    
<?php while($row = $claimResult->fetch_assoc()) {  ?>
	
	<tr>
		<td>@<a href="https://twitter.com/<?php echo  $row['author_username']; ?>/status/<?php echo  $row['id_twitter']; ?>"><?php echo  $row['author_username']; ?></a></td>
		<td><?php echo '<script>var date = new Date(' . $row['created_int'] .' * 1000); document.write(date.toLocaleString());</script>';?></td>
	</tr>

	<?php } ?> 
	</table>
		</div>
	</section>

<?php  } 

	else {
	  echo "#" . $current_hashtag . " not found";
	}   
require_once('footer.php');
?>
