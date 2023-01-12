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
    <th>Author</th>
    <th>Date</th>
</tr>
	</thead>
    
<?php while($row = $claimResult->fetch_assoc()) {  ?>
	
	<tr>
		<td>@<a href="#"><?php echo  $row['author']; ?></a></td>
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
