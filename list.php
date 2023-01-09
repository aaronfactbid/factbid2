<?php
   require_once('header.php'); ?>

   <div class="bidswrapper">
   	<p>
   	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
   	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
   	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
   	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
   	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
   	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
   </p></div>

   <?php

   $current_hashtag = $_GET['hashtag'];
 
 	$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM hashtag WHERE `hashtag`='" . $current_hashtag . "' LIMIT 1;";
	$result_ht = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result_ht) > 0) { 
		$row_ht = $result_ht->fetch_assoc();
		$id_hashtag = $row_ht['id_hashtag'];
		
echo '<h1>#' . $row_ht['hashtag'] . ' bids</h1>'; 
echo '<div class="bid-bid"><span>'.$row_ht['bids'].' bids.</span> <span>Total: $'.number_format($row_ht["total"]).' </span> <span>Hashtag created: <script>var date = new Date(' . $row_ht['created_int'] .' * 1000); document.write(date.toLocaleString());</script></span> </div>';

		$sql = "SELECT *,UNIX_TIMESTAMP(created_ts) AS created_int FROM bid WHERE `id_hashtag`=" . $id_hashtag . " ORDER BY `sort`;";
		$result = mysqli_query($conn, $sql);

	?>
	<section class="bidswrap">
		<div class="fact_bidtable">
			<table>
				<thead>
					     <tr>
    <th>Author</th>
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
